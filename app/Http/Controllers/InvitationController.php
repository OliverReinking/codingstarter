<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Invitation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class InvitationController extends Controller
{
    // =================
    // APPLICATION ADMIN
    // =================
    public function admin_invitation_index()
    {
        $user = Auth::user();
        //
        $admin_id = $user->admin_id;
        //
        $invitations = Invitation::select(
            'invitations.id as id',
            'invitations.first_name as first_name',
            'invitations.last_name as last_name',
            'invitations.email as email',
            'invitations.application as application',
            'invitations.status as status',
            'invitations.created_at as created_at',
        )
            ->orderBy('invitations.first_name')
            ->orderBy('invitations.last_name')
            ->where('person_company_id', '=', $admin_id)
            ->where('application', '=', Invitation::APPLICATION_ADMIN)
            ->get();
        //
        return Inertia::render('Application/Admin/InvitationList', [
            'invitations' => $invitations,
        ]);
    }
    //
    public function admin_invitation_delete(Invitation $invitation)
    {
        if ($invitation->status != Invitation::STATUS_NOT_YET_ACCEPTED) {
            return Redirect::route('admin.invitation.index')
                ->with(['error' => 'Diese Einladung kann nicht widerrufen werden, da sie schon angenommen wurde.']);
        }
        //
        $invitation->delete();
        //
        return Redirect::route('admin.invitation.index')
            ->with(['success' => 'Die Einladung wurde widerrufen.']);
    }

    // ====================
    // APPLICATION EMPLOYEE
    // ====================
    public function employee_invitation_index()
    {
        $user = Auth::user();
        //
        $company_id = $user->company_id;
        //
        $invitations = Invitation::select(
            'invitations.id as id',
            'invitations.first_name as first_name',
            'invitations.last_name as last_name',
            'invitations.email as email',
            'invitations.application as application',
            'invitations.status as status',
            'invitations.created_at as created_at',
        )
            ->orderBy('invitations.first_name')
            ->orderBy('invitations.last_name')
            ->where('person_company_id', '=', $company_id)
            ->where('application', '=', Invitation::APPLICATION_COMPANY)
            ->get();
        //
        return Inertia::render('Application/Employee/InvitationList', [
            'invitations' => $invitations,
        ]);
    }
    //
    public function employee_invitation_delete(Invitation $invitation)
    {
        if ($invitation->status != Invitation::STATUS_NOT_YET_ACCEPTED) {
            return Redirect::route('employee.invitation.index')
                ->with(['error' => 'Diese Einladung kann nicht widerrufen werden, da sie schon angenommen wurde.']);
        }
        //
        $invitation->delete();
        //
        return Redirect::route('employee.invitation.index')
            ->with(['success' => 'Die Einladung wurde widerrufen.']);
    }

    // ====================
    // APPLICATION CUSTOMER
    // ====================
    public function customer_invitation_index()
    {
        $user = Auth::user();
        //
        $customer_id = $user->customer_id;
        //
        $invitations = Invitation::select(
            'invitations.id as id',
            'invitations.first_name as first_name',
            'invitations.last_name as last_name',
            'invitations.email as email',
            'invitations.application as application',
            'invitations.status as status',
            'invitations.created_at as created_at',
        )
            ->orderBy('invitations.first_name')
            ->orderBy('invitations.last_name')
            ->where('person_company_id', '=', $customer_id)
            ->where('application', '=', Invitation::APPLICATION_CUSTOMER)
            ->get();
        //
        return Inertia::render('Application/Customer/InvitationList', [
            'invitations' => $invitations,
        ]);
    }
    //
    public function customer_invitation_delete(Invitation $invitation)
    {
        if ($invitation->status != Invitation::STATUS_NOT_YET_ACCEPTED) {
            return Redirect::route('customer.invitation.index')
                ->with(['error' => 'Diese Einladung kann nicht widerrufen werden, da sie schon angenommen wurde.']);
        }
        //
        $invitation->delete();
        //
        return Redirect::route('customer.invitation.index')
            ->with(['success' => 'Die Einladung wurde widerrufen.']);
    }
}
