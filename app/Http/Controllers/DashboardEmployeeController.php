<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use Laravel\Jetstream\Jetstream;

class DashboardEmployeeController extends Controller
{
    public function employee_index()
    {
        return Inertia::render('Application/Employee/Dashboard');
    }
    //
    public function employee_no_permission($message)
    {
        return Inertia::render('Application/Employee/NoPermission', [
            'message' => $message
        ]);
    }
    //
    public function employee_profile(Request $request)
    {
        return Inertia::render('Application/Employee/Profile', [
            'sessions' => ApplicationController::sessions($request)->all(),
        ]);
    }
    //
    public function employee_api_tokens_index(Request $request)
    {
        return Jetstream::inertia()->render($request, 'Application/Employee/ApiTokenManager', [
            'tokens' => $request->user()->tokens->map(function ($token) {
                return $token->toArray() + [
                    'last_used_ago' => optional($token->last_used_at)->diffForHumans(),
                ];
            }),
            'availablePermissions' => Jetstream::$permissions,
            'defaultPermissions' => Jetstream::$defaultPermissions,
        ]);
    }
}
