<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Invitation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Redirect;
use App\Jobs\SendMailInvitationTeamMember;
use App\Http\Requests\RequestAdminUpdateUser;
use Laravel\Jetstream\Contracts\DeletesUsers;
use App\Http\Requests\RequestCreateInvitation;
use App\Http\Requests\RequestUpdateTeammember;

class UserController extends Controller
{
    // =================
    // APPLICATION ADMIN
    // =================

    public function admin_user_index()
    {
        $users = User::select(
            'users.id as id',
            'users.first_name as first_name',
            'users.last_name as last_name',
            'users.email as email',
            'users.is_admin as is_admin',
            'users.is_employee as is_employee',
            'users.is_customer as is_customer',
            'users.last_login_at as last_login_at'
        )
            ->orderBy('users.last_name')
            ->orderBy('users.first_name')
            ->filterUser(Request::only('search'))
            ->paginate(10);
        //
        return Inertia::render('Application/Admin/UserList', [
            'filters' => Request::all('search'),
            'users' => $users,
        ]);
    }
    //
    public function admin_user_show(User $appuser)
    {
        return Inertia::render('Application/Admin/UserShow', [
            'appuser' => $appuser,
        ]);
    }
    //
    public function admin_user_edit(User $appuser)
    {
        return Inertia::render('Application/Admin/UserForm', [
            'appuser' => $appuser,
        ]);
    }
    //
    public function admin_user_update(User $appuser, RequestAdminUpdateUser $request)
    {
        $appuser->first_name = $request->first_name;
        $appuser->last_name = $request->last_name;
        $appuser->email = $request->email;
        $appuser->is_admin = $request->is_admin;
        $appuser->is_employee = $request->is_employee;
        $appuser->is_customer = $request->is_customer;
        $appuser->save();
        //
        return Redirect::route('admin.user.edit', $appuser->id)
            ->with(['success' => 'Die Daten des Anwenders wurden erfolgreich gespeichert.']);
    }
    //
    public function admin_user_delete(User $appuser)
    {
        app(DeletesUsers::class)->delete($appuser->fresh());
        //
        return Redirect::route('admin.user.index')
            ->with(['success' => 'Die Daten des Anwenders wurden erfolgreich gelöscht.']);
    }
    //
    public function admin_teammember_index()
    {
        $user = Auth::user();
        //
        $admin_id = $user->admin_id;
        //
        $admin_users = User::select(
            'users.id as id',
            'users.first_name as first_name',
            'users.last_name as last_name',
            'users.email as email'
        )
            ->filterUser(Request::only('search'))
            ->where('users.admin_id', '=', $admin_id)
            ->where('users.is_admin', '=', true)
            ->orderBy('last_name', 'asc')
            ->orderBy('first_name', 'asc')
            ->paginate(10)
            ->withQueryString();
        //
        return Inertia::render('Application/Admin/TeamMemberList', [
            'filters' => Request::all('search'),
            'admin_users' => $admin_users,
        ]);
    }
    //
    public function admin_teammember_create()
    {
        $invitation = new Invitation;
        //
        return Inertia::render('Application/Admin/TeamMemberCreate', [
            'invitation' => $invitation,
        ]);
    }
    //
    public function admin_teammember_store(RequestCreateInvitation $request)
    {
        $user = Auth::user();
        //
        $person_company_id = $user->admin_id;
        //
        $person_company = $user->administration->person_company;
        //
        $application = Invitation::APPLICATION_ADMIN;
        //
        $invitation = Invitation::Create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'application' => $application,
            'person_company_id' => $person_company_id,
        ]);
        //
        // Ermittle die invitation_values
        $invitation_values = collect();
        //
        $invitation_values->first_name = $request->first_name;
        $invitation_values->last_name = $request->last_name;
        $invitation_values->email = $request->email;
        $invitation_values->application = $application;
        //
        $invitation_values->company_name = $person_company->name;
        $invitation_values->company_street = $person_company->street;
        $invitation_values->company_postcode = $person_company->postcode;
        $invitation_values->company_city = $person_company->city;
        //
        $invitation_values->accept_invitation_link_url = config('app.url') . '/invitation/accept/' . $invitation->uuid;
        $invitation_values->accept_invitation_link_text = "Hiermit nehme ich die Einladung an";
        //
        dispatch(new SendMailInvitationTeamMember($invitation_values));
        //
        return Redirect::route('admin.dashboard')
            ->with(['success' => 'Das Teammitglied wurde erfolgreich eingeladen. Eine Einladungsmail wird in Kürze an das Teammitglied versendet.']);
    }
    //
    public function admin_teammember_edit(User $user)
    {
        //
        return Inertia::render('Application/Admin/TeamMemberEdit', [
            'user' => $user,
        ]);
    }
    //
    public function admin_teammember_update(User $user, RequestUpdateTeammember $request)
    {
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->save();
        //
        return Redirect::route('admin.teammember.edit', $user->id)
            ->with(['success' => 'Die Daten des Teammitglieds wurden erfolgreich geändert.']);
    }
    //
    public function admin_teammember_delete(User $user)
    {
        $user->admin_id = null;
        $user->is_admin = false;
        $user->save();
        //
        return Redirect::route('admin.teammember.index')
            ->with(['success' => 'Das Teammitglied wurde erfolgreich entfernt.']);
    }

    // ====================
    // APPLICATION EMPLOYEE
    // ====================
    public function employee_teammember_index()
    {
        $user = Auth::user();
        //
        $company_id = $user->company_id;
        //
        $company_users = User::select(
            'users.id as id',
            'users.first_name as first_name',
            'users.last_name as last_name',
            'users.email as email'
        )
            ->filterUser(Request::only('search'))
            ->where('users.company_id', '=', $company_id)
            ->where('users.is_employee', '=', true)
            ->orderBy('last_name', 'asc')
            ->orderBy('first_name', 'asc')
            ->paginate(10)
            ->withQueryString();
        //
        return Inertia::render('Application/Employee/TeamMemberList', [
            'filters' => Request::all('search'),
            'company_users' => $company_users,
        ]);
    }
    //
    public function employee_teammember_create()
    {
        $invitation = new Invitation;
        //
        return Inertia::render('Application/Employee/TeamMemberCreate', [
            'invitation' => $invitation,
        ]);
    }
    //
    public function employee_teammember_store(RequestCreateInvitation $request)
    {
        $user = Auth::user();
        //
        $person_company_id = $user->company_id;
        //
        $person_company = $user->company->person_company;
        //
        $application = Invitation::APPLICATION_COMPANY;
        //
        $invitation = Invitation::Create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'application' => $application,
            'person_company_id' => $person_company_id,
        ]);
        //
        // Ermittle die invitation_values
        $invitation_values = collect();
        //
        $invitation_values->first_name = $request->first_name;
        $invitation_values->last_name = $request->last_name;
        $invitation_values->email = $request->email;
        $invitation_values->application = $application;
        //
        $invitation_values->company_name = $person_company->name;
        $invitation_values->company_street = $person_company->street;
        $invitation_values->company_postcode = $person_company->postcode;
        $invitation_values->company_city = $person_company->city;
        //
        $invitation_values->accept_invitation_link_url = config('app.url') . '/invitation/accept/' . $invitation->uuid;
        $invitation_values->accept_invitation_link_text = "Hiermit nehme ich die Einladung an";
        //
        dispatch(new SendMailInvitationTeamMember($invitation_values));
        //
        return Redirect::route('employee.dashboard')
            ->with(['success' => 'Das Teammitglied wurde erfolgreich eingeladen. Eine Einladungsmail wird in Kürze an das Teammitglied versendet.']);
    }
    //
    public function employee_teammember_edit(User $user)
    {
        //
        return Inertia::render('Application/Employee/TeamMemberEdit', [
            'user' => $user,
        ]);
    }
    //
    public function employee_teammember_update(User $user, RequestUpdateTeammember $request)
    {
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->save();
        //
        return Redirect::route('employee.teammember.edit', $user->id)
            ->with(['success' => 'Die Daten des Teammitglieds wurden erfolgreich geändert.']);
    }
    //
    public function employee_teammember_delete(User $user)
    {
        $user->company_id = null;
        $user->is_employee = false;
        $user->save();
        //
        return Redirect::route('employee.teammember.index')
            ->with(['success' => 'Das Teammitglied wurde erfolgreich entfernt.']);
    }

    // ====================
    // APPLICATION CUSTOMER
    // ====================
    public function customer_teammember_index()
    {
        $user = Auth::user();
        //
        $customer_id = $user->customer_id;
        //
        $customer_users = User::select(
            'users.id as id',
            'users.first_name as first_name',
            'users.last_name as last_name',
            'users.email as email'
        )
            ->filterUser(Request::only('search'))
            ->where('users.customer_id', '=', $customer_id)
            ->where('users.is_customer', '=', true)
            ->orderBy('last_name', 'asc')
            ->orderBy('first_name', 'asc')
            ->paginate(10)
            ->withQueryString();
        //
        return Inertia::render('Application/Customer/TeamMemberList', [
            'filters' => Request::all('search'),
            'customer_users' => $customer_users,
        ]);
    }
    //
    public function customer_teammember_create()
    {
        $invitation = new Invitation;
        //
        return Inertia::render('Application/Customer/TeamMemberCreate', [
            'invitation' => $invitation,
        ]);
    }
    //
    public function customer_teammember_store(RequestCreateInvitation $request)
    {
        $user = Auth::user();
        //
        $person_company_id = $user->customer_id;
        //
        $person_company = $user->customer->person_company;
        //
        $application = Invitation::APPLICATION_CUSTOMER;
        //
        $invitation = Invitation::Create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'application' => $application,
            'person_company_id' => $person_company_id,
        ]);
        //
        // Ermittle die invitation_values
        $invitation_values = collect();
        //
        $invitation_values->first_name = $request->first_name;
        $invitation_values->last_name = $request->last_name;
        $invitation_values->email = $request->email;
        $invitation_values->application = $application;
        //
        $invitation_values->company_name = $person_company->name;
        $invitation_values->company_street = $person_company->street;
        $invitation_values->company_postcode = $person_company->postcode;
        $invitation_values->company_city = $person_company->city;
        //
        $invitation_values->accept_invitation_link_url = config('app.url') . '/invitation/accept/' . $invitation->uuid;
        $invitation_values->accept_invitation_link_text = "Hiermit nehme ich die Einladung an";
        //
        dispatch(new SendMailInvitationTeamMember($invitation_values));
        //
        return Redirect::route('customer.dashboard')
            ->with(['success' => 'Das Teammitglied wurde erfolgreich eingeladen. Eine Einladungsmail wird in Kürze an das Teammitglied versendet.']);
    }
    //
    public function customer_teammember_edit(User $user)
    {
        //
        return Inertia::render('Application/Customer/TeamMemberEdit', [
            'user' => $user,
        ]);
    }
    //
    public function customer_teammember_update(User $user, RequestUpdateTeammember $request)
    {
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->save();
        //
        return Redirect::route('customer.teammember.edit', $user->id)
            ->with(['success' => 'Die Daten des Teammitglieds wurden erfolgreich geändert.']);
    }
    //
    public function customer_teammember_delete(User $user)
    {
        $user->ustomer_id = null;
        $user->is_customer = false;
        $user->save();
        //
        return Redirect::route('customer.teammember.index')
            ->with(['success' => 'Das Teammitglied wurde erfolgreich entfernt.']);
    }
}
