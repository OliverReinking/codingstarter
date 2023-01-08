<?php

namespace App\Http\Middleware;

use App\Models\Chat;
use Inertia\Middleware;
use App\Models\ChatUserType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request): array
    {
        return array_merge(parent::share($request), [
            'flash' => function () use ($request) {
                return [
                    'success' => $request->session()->get('success'),
                    'error' => $request->session()->get('error'),
                ];
            },
            // version
            'version' => function () {
                return [
                    'versionnr' => config('codingstarter.version.versionnr'),
                    'versionsdatum' => config('codingstarter.version.versionsdatum'),
                ];
            },
            // navtype
            'navtype' => function () {
                return [
                    'nav_header' => 'header',
                    'nav_sidebar' => 'sidebar',
                ];
            },
            // applications
            'applications' => function () {
                return [
                    'app_admin' => 'admin',
                    'app_employee' => 'employee',
                    'app_customer' => 'customer',
                    'app_admin_name' => 'Administrator-Anwendung',
                    'app_employee_name' => 'Mitarbeiter-Anwendung',
                    'app_customer_name' => 'Kunden-Anwendung',
                ];
            },
            // Userdaten
            'userdata' => function () {
                //
                $user_id = null;
                $first_name = null;
                $last_name = null;
                $email = null;
                //
                $profile_photo_path = null;
                //
                $is_admin = false;
                $is_employee = false;
                $is_customer = false;
                //
                $admin_id = 0;
                $company_id = 0;
                $customer_id = 0;
                //
                $unreadAdminChats = null;
                $unreadCompanyChats = null;
                $unreadCustomerChats = null;
                //
                $user = Auth::user();
                //
                if ($user) {
                    $user_id = $user->id;
                    $first_name = $user->first_name;
                    $last_name = $user->last_name;
                    $email = $user->email;
                    //
                    if ($user->profile_photo_url) {
                        $profile_photo_path = $user->profile_photo_url;
                    }
                    //
                    $is_admin = $user->is_admin;
                    $is_employee = $user->is_employee;
                    $is_customer = $user->is_customer;
                    //
                    $admin_id = $user->admin_id;
                    $company_id = $user->company_id;
                    $customer_id = $user->customer_id;
                    // Admin-Daten
                    if ($is_admin && $admin_id > 0) {
                        // Anzahl der ungelesenen Chat-Nachrichten an die Administrierung
                        $unreadAdminChats = Chat::where('receiver_person_company_id', '=', $admin_id)
                            ->where('receiver_user_type_id', '=', ChatUserType::ChatUserType_Administrator)
                            ->where('read_status', '=', false)
                            ->count();
                    }
                    // Company-Daten
                    if ($is_employee && $company_id > 0) {
                        // Anzahl der ungelesenen Chat-Nachrichten an das Unternehmen
                        $unreadCompanyChats = Chat::where('receiver_person_company_id', '=', $company_id)
                            ->where('receiver_user_type_id', '=', ChatUserType::ChatUserType_Company)
                            ->where('read_status', '=', false)
                            ->count();
                    }
                    // Customer-Daten
                    if ($is_customer && $customer_id > 0) {
                        // Anzahl der ungelesenen Chat-Nachrichten an den Kunden
                        $unreadCustomerChats = Chat::where('receiver_person_company_id', '=', $customer_id)
                            ->where('receiver_user_type_id', '=', ChatUserType::ChatUserType_Customer)
                            ->where('read_status', '=', false)
                            ->count();
                    }
                }
                //
                return [
                    'user_id' => $user_id,
                    'first_name' => $first_name,
                    'last_name' => $last_name,
                    'email' => $email,
                    //
                    'profile_photo_path' => $profile_photo_path,
                    //
                    'is_admin' => $is_admin,
                    'is_employee' => $is_employee,
                    'is_customer' => $is_customer,
                    //
                    'admin_id' => $admin_id,
                    'company_id' => $company_id,
                    'customer_id' => $customer_id,
                    //
                    'unreadAdminChats' => $unreadAdminChats,
                    'unreadCompanyChats' => $unreadCompanyChats,
                    'unreadCustomerChats' => $unreadCustomerChats,
                ];
            }
        ]);
    }
}
