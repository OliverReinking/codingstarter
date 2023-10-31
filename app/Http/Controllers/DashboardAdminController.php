<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Laravel\Jetstream\Jetstream;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardAdminController extends Controller
{
    //
    public function admin_index()
    {
        //
        $counts = DB::table('users')
            ->selectRaw('count(*) as users')
            ->selectRaw("count(case when is_admin = 1 then 1 end) as admins")
            ->selectRaw("count(case when is_employee = 1 then 1 end) as employees")
            ->selectRaw("count(case when is_customer = 1 then 1 end) as customers")
            ->first();

        return Inertia::render('Application/Admin/Dashboard', [
            'counts' => $counts,
        ]);
    }
    public function admin_version()
    {
        $versionFile = Jetstream::localizedMarkdownPath('version.md');
        $version_documentation = Str::markdown(file_get_contents($versionFile));
        //
        return Inertia::render('Application/Admin/Version', [
            'version_documentation' => $version_documentation,
        ]);
    }
    //
    public function admin_processes()
    {
        //
        return Inertia::render('Application/Admin/Processes');
    }
    //
    public function admin_statistics()
    {
        //
        return Inertia::render('Application/Admin/Statistics');
    }
    //
    public function admin_documentation(Request $request)
    {
        $documentationFile = Jetstream::localizedMarkdownPath('documentation.md');
        $documentation = Str::markdown(file_get_contents($documentationFile));
        //
        return Inertia::render('Application/Admin/Documentation', [
            'documentation' => $documentation,
        ]);
    }
    //
    public function admin_content_index()
    {
        //
        return Inertia::render('Application/Admin/ContentDashboard');
    }
    //
    public function admin_profile(Request $request)
    {
        return Inertia::render('Application/Admin/Profile', [
            'sessions' => ApplicationController::sessions($request)->all(),
        ]);
    }
    //
    public function admin_api_tokens_index(Request $request)
    {
        $user = Auth::user();
        $availablePermissions = [];
        $defaultPermissions = [];
        //
        if ($user->is_admin) {
            $defaultPermissions = ['admin_dashboard'];
            $availablePermissions = ['admin_dashboard'];
        }
        //
        return Jetstream::inertia()->render($request, 'Application/Admin/ApiTokenManager', [
            'tokens' => $request->user()->tokens->map(function ($token) {
                return $token->toArray() + [
                    'last_used_ago' => optional($token->last_used_at)->diffForHumans(),
                ];
            }),
            'availablePermissions' => $availablePermissions,
            'defaultPermissions' => $defaultPermissions,
        ]);
    }
}
