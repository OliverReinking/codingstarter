<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Inertia\Inertia;
use App\Models\Webinar;
use App\Models\WebinarImage;
use Illuminate\Support\Facades\Auth;
use App\Jobs\SendMailWebinarReminder;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\AdminStoreAndUpdateWebinarRequest;

class WebinarController extends Controller
{
    // =================
    // APPLICATION ADMIN
    // =================
    public function admin_webinar_index()
    {
        $user = Auth::user();
        //
        $webinars = Webinar::select(
            'webinars.id as id',
            'webinars.title as title',
            'webinars.event_date as event_date',
            'webinars.event_start as event_start',
            'webinars.active as active',
        )
            ->filterWebinar(Request::only('search'))
            ->where('company_id', '=', $user->admin_id)
            ->orderBy('event_date', 'asc')
            ->paginate(10);
        //
        return Inertia::render('Application/Admin/WebinarList', [
            'filters' => Request::all('search'),
            'webinars' => $webinars,
        ]);
    }
    //
    public function admin_webinar_create()
    {
        $user = Auth::user();
        //
        $webinar = new Webinar;
        $webinar->id = 0;
        $webinar->company_id = $user->admin_id;
        $webinar->webinar_image_id = 1;
        $webinar->event_date = Carbon::now()->addDays(1);
        $webinar->event_start = "16:00";
        $webinar->active = true;
        //
        $webinar_images = WebinarImage::select('id', 'name', 'url')
            ->orderBy('name')
            ->get();
        //
        return Inertia::render('Application/Admin/WebinarForm', [
            'webinar' => $webinar,
            'webinar_images' => $webinar_images,
        ]);
    }
    //
    public function admin_webinar_store(AdminStoreAndUpdateWebinarRequest $request)
    {
        $webinar = Webinar::Create([
            'company_id' => $request->company_id,
            'webinar_image_id' => $request->webinar_image_id,
            'title' => $request->title,
            'description' => $request->description,
            'access' => $request->access,
            'event_date' => $request->event_date,
            'event_start' => $request->event_start,
            'active' => $request->active,
        ]);
        //
        return Redirect::route('admin.webinar.edit', $webinar->id)
            ->with(['success' => 'Die Daten des neuen Webinar wurden erfolgreich abgespeichert.']);
    }
    //
    public function admin_webinar_edit(Webinar $webinar)
    {
        $webinar_orders = $webinar->orders;
        //
        $webinar_images = WebinarImage::select('id', 'name', 'url')
            ->orderBy('name')
            ->get();
        //
        return Inertia::render('Application/Admin/WebinarForm', [
            'webinar' => $webinar,
            'webinar_images' => $webinar_images,
            'webinar_orders' => $webinar_orders,
        ]);
    }
    //
    public function admin_webinar_update(Webinar $webinar, AdminStoreAndUpdateWebinarRequest $request)
    {
        $webinar->webinar_image_id = $request->webinar_image_id;
        $webinar->title = $request->title;
        $webinar->description = $request->description;
        $webinar->access = $request->access;
        $webinar->event_date = $request->event_date;
        $webinar->event_start = $request->event_start;
        $webinar->active = $request->active;
        $webinar->save();
        //
        return Redirect::route('admin.webinar.edit', $webinar->id)
            ->with(['success' => 'Die Daten des Webinars wurden erfolgreich geändert.']);
    }
    //
    public function admin_webinar_delete(Webinar $webinar)
    {
        // lösche alle Webinarregistrierungen
        $webinar->orders()->delete();
        // lösche das Webinar
        $webinar->delete();
        //
        return Redirect::route('admin.webinar.index')
            ->with(['success' => 'Das Webinar wurde erfolgreich gelöscht.']);
    }
    //
    public function admin_webinar_reminder(Webinar $webinar)
    {
        // prüfe, ob Webinar heute stattfindet
        $Zeitpunkt = Carbon::now()->format('Y-m-d');
        $WebinarDate = Carbon::createFromFormat('Y-m-d', $webinar->event_date)->format('Y-m-d');
        //
        if ($Zeitpunkt != $WebinarDate) {
            $messagetext = 'Das Webinar findet heute nicht statt, die Erinnerungsmail an die Teilnehmer kann daher nicht versendet werden.';
            return Redirect::route('admin.webinar.edit', $webinar->id)->with(['error' => $messagetext]);
        }
        // ermittle alle Webinarteilnehmer
        $webinar_orders = $webinar->orders;
        if ($webinar_orders->count() == 0) {
            $messagetext = 'Für das Webinar hat sich keiner angemeldet, die Erinnerungsmail an die Teilnehmer kann daher nicht versendet werden.';
            return Redirect::route('admin.webinar.edit', $webinar->id)->with(['error' => $messagetext]);
        }
        //
        $documentation = null;
        //
        $history = 'Am ' . formatDateTimeLocale(Carbon::now()) . ' wurde für diese Webinaranmeldung die Funktion "Erinnerungsmail an Teilnehmer versenden" ausgeführt.<br />';
        // durchlaufe alle Webinarteilnehmer
        foreach ($webinar_orders as $order) {
            $remindervalues = collect();
            //
            $remindervalues->title = $webinar->title;
            //
            $remindervalues->salutation_name = $order->salutation->name;
            $remindervalues->first_name = $order->first_name;
            $remindervalues->last_name = $order->last_name;
            $remindervalues->email = $order->email;
            $remindervalues->phone = $order->phone;
            //
            $remindervalues->access = $webinar->access;
            $remindervalues->event_date = $webinar->event_date;
            $remindervalues->event_start = $webinar->event_start;
            // Versand der Erinnerungsmail an alle Webinar-Teilnehmer des Webinars
            dispatch(new SendMailWebinarReminder($remindervalues));
            //
            $order->history .= $history;
            $order->save();
            // Dokumentation
            $documentation .= "Erinnerungsmail an " . $order->email . '<br />';
        }
        //
        $messagetext = 'Die Funktion "Erinnerungsmail an Teilnehmer versenden" wurde ausgeführt.<br />';
        $messagetext .= $documentation;
        return Redirect::route('admin.webinar.edit', $webinar->id)
            ->with(['success' => $messagetext]);
    }
}
