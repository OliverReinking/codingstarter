<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Inertia\Inertia;
use App\Models\WebinarOrder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Redirect;
use App\Jobs\SendMailWebinarRegistrationConfirmation;

class WebinarOrderController extends Controller
{
    // =================
    // APPLICATION ADMIN
    // =================
    public function admin_webinarorder_index()
    {
        $user = Auth::user();
        //
        $webinar_orders = WebinarOrder::select(
            'webinar_orders.id',
            'webinar_orders.first_name',
            'webinar_orders.last_name',
            'webinar_orders.email',
            'webinar_orders.phone',
            'webinar_orders.created_at',
            'webinars.title'
        )
            ->join('webinars', 'webinars.id', '=', 'webinar_orders.webinar_id')
            ->where('webinars.company_id', '=', $user->admin_id)
            ->orderBy('webinar_orders.created_at', 'desc')
            ->filterWebinarOrder(Request::only('search'))
            ->paginate(50);
        //
        return Inertia::render('Application/Admin/WebinarOrderList', [
            'filters' => Request::all('search'),
            'webinar_orders' => $webinar_orders,
        ]);
    }
    //
    public function admin_webinarorder_edit(WebinarOrder $webinar_order)
    {
        $webinar_order->webinar;
        //
        return Inertia::render('Application/Admin/WebinarOrderForm', [
            'webinar_order' => $webinar_order,
        ]);
    }
    //
    public function admin_webinarorder_delete(Webinarorder $webinar_order)
    {
        // lösche die Webinar-Anmeldung
        $webinar_order->delete();
        //
        return Redirect::route('admin.webinarorder.index')->with(['success' => 'Die Webinar-Anmeldung wurde gelöscht.']);
    }
    //
    public function admin_webinarorder_send_mail_registration_info(Webinarorder $webinar_order)
    {
        $webinar = $webinar_order->webinar;
        //
        $registrationvalues = collect();
        //
        $registrationvalues->title = $webinar->title;
        //
        $registrationvalues->salutation_name = $webinar_order->salutation->name;
        $registrationvalues->first_name = $webinar_order->first_name;
        $registrationvalues->last_name = $webinar_order->last_name;
        $registrationvalues->email = $webinar_order->email;
        $registrationvalues->phone = $webinar_order->phone;
        //
        $registrationvalues->description = $webinar->description;
        $registrationvalues->access = $webinar->access;
        $registrationvalues->event_date = $webinar->event_date;
        $registrationvalues->event_start = $webinar->event_start;
        // versende Teilnahmebestätigung per Mail an den Webinar-Teilnehmer
        dispatch(new SendMailWebinarRegistrationConfirmation($registrationvalues));
        //
        $history = 'Am ' . formatDateTimeLocale(Carbon::now()) . ' wurde für diese Webinaranmeldung die Funktion "Anmeldebestätigung per Mail an den Webinar-Teilnehmer" ausgeführt.<br />';
        $webinar_order->history .= $history;
        $webinar_order->save();
        //
        return Redirect::route('admin.webinarorder.edit', $webinar_order->id)->with(['success' => 'Die Teilnahmebestätigung wurde per Mail an den Webinar-Teilnehmer versendet.']);
    }
}
