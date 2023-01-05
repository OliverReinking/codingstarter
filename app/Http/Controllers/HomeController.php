<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Blog;
use App\Models\User;
use Inertia\Inertia;
use App\Models\Webinar;
use App\Models\Invitation;
use App\Models\Newsletter;
use App\Models\Salutation;
use Illuminate\Support\Str;
use App\Models\WebinarOrder;
use App\Models\Administration;
use App\Models\NewsletterMember;
use Laravel\Jetstream\Jetstream;
use Illuminate\Support\Facades\Log;
use App\Jobs\SendMailJobApplication;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\RegisterUserRequest;
use App\Http\Requests\RequestJobApplication;
use App\Http\Requests\RequestWebinarRegister;
use App\Jobs\SendMailNewsletterWasSubscribed;
use App\Http\Requests\RequestNewsletterRegister;
use App\Jobs\SendMailWebinarRegistrationConfirmation;

class HomeController extends Controller
{
    public function home_index()
    {
        $blog = Blog::select(
            'blogs.id as id',
            'blogs.blog_date as blog_date',
            'blogs.title as title',
            'blogs.slug as slug',
            'blogs.summary as summary',
            'blogs.reading_time as reading_time',
            'blog_authors.name as author_name',
            'blog_images.url as url',
            'blog_images.name as name',
            'blog_categories.name as category_name',
        )
            ->join('blog_authors', 'blog_authors.id', '=', 'blogs.blog_author_id')
            ->join('blog_images', 'blog_images.id', '=', 'blogs.blog_image_id')
            ->join('blog_categories', 'blog_categories.id', '=', 'blogs.blog_category_id')
            //
            ->orderBy('blogs.blog_date', 'desc')
            ->orderBy('blogs.id', 'desc')
            ->first();
        //
        $Zeitpunkt = Carbon::now();
        //
        $webinar = Webinar::select(
            'webinars.id as id',
            'webinars.event_date as event_date',
            'webinars.event_start as event_start',
            'webinars.title as title',
            'webinars.description as description',
            'webinar_images.url as url',
            'webinar_images.name as name'
        )
            ->join('webinar_images', 'webinar_images.id', '=', 'webinars.webinar_image_id')
            //
            ->orderBy('webinars.event_date', 'asc')
            ->where('webinars.active', '=', true)
            ->whereDate('event_date', '>', $Zeitpunkt)
            ->first();

        //
        return Inertia::render('Application/Homepage/Home', [
            'blog' => $blog,
            'webinar' => $webinar,
        ]);
    }

    public function home_about()
    {
        return Inertia::render('Application/Homepage/About');
    }

    public function home_mission()
    {
        return Inertia::render('Application/Homepage/Mission');
    }

    public function home_contact()
    {
        return Inertia::render('Application/Homepage/Contact');
    }

    public function home_imprint()
    {
        $imprintFile = Jetstream::localizedMarkdownPath('imprint.md');
        $imprint = Str::markdown(file_get_contents($imprintFile));
        //
        return Inertia::render('Application/Homepage/Imprint', [
            'imprint' => $imprint,
        ]);
    }

    public function home_privacy()
    {
        $policyFile = Jetstream::localizedMarkdownPath('policy.md');
        $policy = Str::markdown(file_get_contents($policyFile));
        //
        return Inertia::render('Application/Homepage/Privacy', [
            'policy' => $policy,
        ]);
    }

    public function home_terms()
    {
        $termsFile = Jetstream::localizedMarkdownPath('terms.md');
        $terms = Str::markdown(file_get_contents($termsFile));
        //
        return Inertia::render('Application/Homepage/Terms', [
            'terms' => $terms,
        ]);
    }

    public function home_job_application()
    {
        return Inertia::render('Application/Homepage/JobApplication');
    }

    public function home_job_application_send(RequestJobApplication $request)
    {
        // Ermittle die job_application_values
        $job_application_values = collect();
        //
        $job_application_values->first_name = $request->first_name;
        $job_application_values->last_name = $request->last_name;
        $job_application_values->email = $request->email;
        $job_application_values->phone = $request->phone;
        //
        $job_application_values->gender = "weiblich";
        if ($request->gender == "male") {
            $job_application_values->gender = "männlich";
        }
        //
        $job_application_values->continent = trans($request->continent);
        //
        //Log::info('home_job_application_send', [
        //    'request->continent' => $request->continent,
        //    'request->languages' => $request->languages
        //]);
        //
        $count_languages = 0;
        foreach ($request->languages as $key => $value) {
            //
            //Log::info('home_job_application_send', [
            //    'key' => $key,
            //    'value' => $value,
            //]);
            //
            if ($value == "true") {
                $count_languages += 1;
            }
        }
        //
        if ($count_languages < 2) {
            return Redirect::route('job_application')
                ->with([
                    'error' => 'Die Bewerbungsdaten konnten nicht verarbeitet werden.
                  Du solltest mindestens zwei Sprachen beherrschen.'
                ]);
        }
        //
        if (Request::file('fileCurriculumVitae')) {
            //
            $file = Request::file('fileCurriculumVitae');
            //
            $mimetype = $file->getMimeType();
            //
            //Log::info('home_job_application_send', [
            //    'mimetype' => $mimetype
            //]);
            //
            if ($mimetype !== 'application/pdf') {
                return Redirect::route('job_application')
                    ->with([
                        'error' => 'Die Bewerbungsdaten konnten nicht verarbeitet werden.
                          Der Lebenslauf muss im PDF-Format hochgeladen werden.'
                    ]);
            }
            //
            $FileName = Str::random(60) . '.pdf';
            //
            Storage::disk('lebenslauf')->put(
                $FileName,
                file_get_contents($file),
                'private'
            );
        }
        //
        dispatch(new SendMailJobApplication($job_application_values));
        //
        return Redirect::route('job_application')
            ->with([
                'success' => 'Die Bewerbungsdaten wurden erfolgreich übermittelt.
                          Wir werden uns schnellstmöglich mit Dir in Verbindung setzen.'
            ]);
    }

    public function home_blog_index()
    {
        $blogs = Blog::select(
            'blogs.id as id',
            'blogs.blog_date as blog_date',
            'blogs.title as title',
            'blogs.slug as slug',
            'blogs.summary as summary',
            'blogs.reading_time as reading_time',
            'blog_authors.name as author_name',
            'blog_images.url as url',
            'blog_images.name as name',
            'blog_categories.name as category_name',
        )
            ->join('blog_authors', 'blog_authors.id', '=', 'blogs.blog_author_id')
            ->join('blog_images', 'blog_images.id', '=', 'blogs.blog_image_id')
            ->join('blog_categories', 'blog_categories.id', '=', 'blogs.blog_category_id')
            //
            ->filterBlog(Request::only('search'))
            ->orderBy('blogs.blog_date', 'desc')
            ->orderBy('blogs.id', 'desc')
            ->paginate(100)
            ->withQueryString();
        //
        return Inertia::render('Application/Homepage/BlogList', [
            'blogs' => $blogs,
        ]);
    }

    public function home_blog_show($slug)
    {
        $blog = Blog::where('slug', $slug)->first();
        //
        $blog->blog_author;
        $blog->blog_image;
        $blog->blog_category;
        $blogarticle = null;
        //
        if ($blog->markdown_on) {
            $filePathName = 'blogs/blog_' . $blog->id . '.md';
            $blogarticleFile = Jetstream::localizedMarkdownPath($filePathName);
            $blogarticle = Str::markdown(file_get_contents($blogarticleFile));
        }
        //
        return Inertia::render('Application/Homepage/BlogShow', [
            'blog' => $blog,
            'blogarticle' => $blogarticle
        ]);
    }

    public function home_webinar_index()
    {
        $Zeitpunkt = Carbon::now();
        //
        $webinars = Webinar::select(
            'webinars.id as id',
            'webinars.title as title',
            'webinars.description as description',
            'webinars.event_date as event_date',
            'webinars.event_start as event_start',
            'webinar_images.url as url',
            'webinar_images.name as name'
        )
            ->join('webinar_images', 'webinar_images.id', '=', 'webinars.webinar_image_id')
            //
            ->filterWebinar(Request::only('search'))
            ->where('company_id', '=', Administration::ADMIN_CODINGSTARTER_ID)
            ->where('active', '=', true)
            ->whereDate('event_date', '>', $Zeitpunkt)
            ->orderBy('webinars.event_date', 'asc')
            ->paginate(100)
            ->withQueryString();
        //
        return Inertia::render('Application/Homepage/WebinarList', [
            'webinars' => $webinars,
        ]);
    }

    public function home_webinar_order(Webinar $webinar)
    {
        $policyFile = Jetstream::localizedMarkdownPath('privacy_policy_webinar.md');
        $policy = Str::markdown(file_get_contents($policyFile));
        //
        $salutations = Salutation::select('id', 'name')
            ->orderBy('name')
            ->pluck('name', 'id');
        //
        return Inertia::render('Application/Homepage/WebinarRegister', [
            'webinar' => $webinar,
            'salutations' => $salutations,
            'policy' => $policy
        ]);
    }

    public function home_webinar_order_send(Webinar $webinar, RequestWebinarRegister $request)
    {
        // Speichere Webinaranmeldedaten in webinar_orders
        $webinar_order = WebinarOrder::create([
            'webinar_id' => $webinar->id,
            'salutation_id' => $request->salutation_id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);
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
        $message = 'Die Webinaranmeldung ist erfolgreich eingegangen.<br />';
        $message .= 'Wir senden dir in den nächsten Minuten eine Mail mit den notwendigen Informationen zum Webinar.<br />';
        return Redirect::route('home.webinar.order', $webinar->id)
            ->with([
                'success' => $message
            ]);
    }

    public function home_newsletter_register(Newsletter $newsletter)
    {
        $policyFile = Jetstream::localizedMarkdownPath('privacy_policy_newsletter.md');
        $policy = Str::markdown(file_get_contents($policyFile));
        //
        return Inertia::render('Application/Homepage/NewsletterRegister', [
            'newsletter' => $newsletter,
            'policy' => $policy
        ]);
    }

    public function home_newsletter_send(Newsletter $newsletter, RequestNewsletterRegister $request)
    {
        // prüfe, ob die vorgegebene Mailadresse diesen Newsletter bereits bestellt hat
        $count = NewsletterMember::where('newsletter_id', '=', $newsletter->id)
            ->where('email', '=', $request->email)->count();
        if ($count > 0) {
            $error = "Der Newsletter konnte nicht bestellt werden, da du diesen Newsletter bereits bestellt hast.<br />";
            return Redirect::route('home.newsletter.register', $newsletter->id)->with(['error' => $error]);
        }
        // Speichere Bestellung in newsletter_members
        $newsletter_member = NewsletterMember::create([
            'newsletter_id' => $newsletter->id,
            'name' => $request->name,
            'email' => $request->email,
        ]);
        // Ermittle die newsletter_values
        $newsletter_values = collect();
        //
        $newsletter_values->email = $request->email;
        $newsletter_values->newsletter_name = $newsletter->name;
        $newsletter_values->verified_subscription_link_url = config('app.url') . '/newsletter_register/subscription/verified/' . $newsletter_member->uuid;
        $newsletter_values->verified_subscription_link_text = "Hiermit bestätige ich das Abonnement des Newsletters";
        $newsletter_values->cancelled_subscription_link_url = config('app.url') . '/newsletter_register/subscription/cancelled/' . $newsletter_member->uuid;
        $newsletter_values->cancelled_subscription_link_text = "Ich möchte diesen Newsletter abbestellen";
        //
        dispatch(new SendMailNewsletterWasSubscribed($newsletter_values));
        //
        $message = 'Der Newsletter wurde erfolgreich bestellt.<br />';
        $message .= 'Wir senden dir in den nächsten Minuten eine Mail, hier kannst du das Abonnement des Newsletters bestätigen.<br />';
        return Redirect::route('home.newsletter.register', $newsletter->id)
            ->with([
                'success' => $message
            ]);
    }

    public function home_newsletter_subscription_verified($slug)
    {
        //Log::info('home_newsletter_subscription_verified', [
        //    'slug' => $slug,
        //]);
        //
        $newsletter_member = NewsletterMember::where('uuid', '=', $slug)->first();
        //
        $contact_info = config('codingstarter.contact.info');
        //
        if (!$newsletter_member) {
            $title = "Bestätigung Abonnement";
            $message = "Wir konnten keinen passenden Eintrag in unserer Datenbank finden. Eine Bestätigung für dein Newsletter-Abonnement konnten wir leider nicht verifizieren.";
            $contact_show = true;
        }
        //
        if ($newsletter_member) {
            if ($newsletter_member->email_verified_at) {
                $title = "Bestätigung Abonnement";
                $message = "Du hast bereits dieses Newsletter-Abonnement bestätigt.";
                $contact_show = true;
            }
            //
            if (!$newsletter_member->email_verified_at) {
                $newsletter_member->email_verified_at = Carbon::now();
                $newsletter_member->save();
                //
                $title = "Bestätigung Abonnement";
                $message = "Herzlichen Dank für deine Bestätigung des Newsletters-Abonnements.";
                $contact_show = false;
            }
        }
        //
        return Inertia::render('Application/Homepage/UserActionConfirmation', [
            'title' => $title,
            'message' => $message,
            'contact_show' => $contact_show,
            'contact_info' => $contact_info,
        ]);
    }

    public function home_newsletter_subscription_cancelled($slug)
    {
        //Log::info('home_newsletter_subscription_cancelled', [
        //    'slug' => $slug,
        //]);
        //
        $newsletter_member = NewsletterMember::where('uuid', '=', $slug)->first();
        //
        $contact_info = config('codingstarter.contact.info');
        //
        if (!$newsletter_member) {
            $title = "Abmeldung vom Newsletter";
            $message = "Wir konnten keinen passenden Eintrag in unserer Datenbank finden. Eine Abmelduung für den Newsletter konnte leider nicht erfolgen.";
            $contact_show = true;
        }
        //
        if ($newsletter_member) {
            $newsletter_member->delete();
            //
            $title = "Abmeldung vom Newsletter";
            $message = "Du wurdest erfogreich vom Newsletter abgemeldet.";
            $contact_show = false;
        }
        //
        return Inertia::render('Application/Homepage/UserActionConfirmation', [
            'title' => $title,
            'message' => $message,
            'contact_show' => $contact_show,
            'contact_info' => $contact_info,
        ]);
    }

    public function home_invitation_accept($slug)
    {
        //Log::info('home_invitation_accept', [
        //    'slug' => $slug,
        //]);
        //
        $invitation = Invitation::where('uuid', '=', $slug)->first();
        //
        $contact_info = config('codingstarter.contact.info');
        //
        if (!$invitation) {
            $title = "Einladung zu einer Teammitgliedschaft";
            $message = "Wir konnten keinen passenden Eintrag in unserer Datenbank finden. Die Einladung zu einer Teammitgliedschaft konnte daher nicht erfolgreich durchgeführt werden.";
            $contact_show = true;
            //
            return Inertia::render('Application/Homepage/UserActionConfirmation', [
                'title' => $title,
                'message' => $message,
                'contact_show' => $contact_show,
                'contact_info' => $contact_info,
            ]);
        }
        // prüfe, ob für die Einladung (invitations.email) bereits ein Anwender (users.email) existiert
        $user = User::where('email', '=', $invitation->email)->first();
        //
        if (!$user) {
            // springe in das Eingabeformular RegisterUser
            //Log::info('home_invitation_accept: kein User vorhanden');
            //
            return Inertia::render('Application/Homepage/RegisterUser', [
                'slug' => $slug,
                'first_name' => $invitation->first_name,
                'last_name' => $invitation->last_name,
                'email' => $invitation->email,
            ]);
        }
        //
        //Log::info('home_invitation_accept: User vorhanden');
        //
        $values = Invitation::carryOutInvitation($slug, null);
        if ($values->errorOn) {
            $title = "Einladung zu einer Teammitgliedschaft";
            $message = $values->errorMessage;
            $contact_show = true;
            //
            return Inertia::render('Application/Homepage/UserActionConfirmation', [
                'title' => $title,
                'message' => $message,
                'contact_show' => $contact_show,
                'contact_info' => $contact_info,
            ]);
        }
        //
        return Redirect::route('home')
            ->with(['success' => 'Die Einladung wurde verarbeitet. Du kannst dich jetzt anmelden.']);
    }

    public function home_invitation_register(RegisterUserRequest $request, $slug)
    {
        //
        //Log::info('home_invitation_register', [
        //    'request->first_name' => $request->first_name,
        //    'slug' => $slug,
        //]);
        //
        $contact_info = config('codingstarter.contact.info');
        // führe Einladung durch und springe dann in die Login-Seite
        $values = Invitation::carryOutInvitation($slug, $request->password);
        //
        if ($values->errorOn) {
            $title = "Einladung zu einer Teammitgliedschaft";
            $message = $values->errorMessage;
            $contact_show = true;
            //
            return Inertia::render('Application/Homepage/UserActionConfirmation', [
                'title' => $title,
                'message' => $message,
                'contact_show' => $contact_show,
                'contact_info' => $contact_info,
            ]);
        }
        //
        return Redirect::route('home')
            ->with(['success' => 'Die Einladung wurde verarbeitet. Du kannst dich jetzt anmelden.']);
    }

    public function user_is_no_admin()
    {
        return Inertia::render('Application/Homepage/UserIsNoAdmin');
    }

    public function user_is_no_employee()
    {
        return Inertia::render('Application/Homepage/UserIsNoEmployee');
    }

    public function user_is_no_customer()
    {
        return Inertia::render('Application/Homepage/UserIsNoCustomer');
    }

    public function no_application_found()
    {
        return Inertia::render('Application/Homepage/NoApplicationFound');
    }
}
