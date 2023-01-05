<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Newsletter;
use App\Models\NewsletterMember;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\AdminUpdateNewsletterRequest;

class NewsletterController extends Controller
{
    // =================
    // APPLICATION ADMIN
    // =================
    public function admin_newsletter_index()
    {
        $newsletters = Newsletter::select(
            'newsletters.id as id',
            'newsletters.name as name',
            'newsletters.description as description',
        )
            ->selectRaw('count(newsletter_members.id) as members_count')
            ->join('newsletter_members', 'newsletter_members.newsletter_id', '=', 'newsletters.id')
            ->filterNewsletter(Request::only('search'))
            ->groupBy('newsletters.id', 'newsletters.name', 'newsletters.description')
            ->orderBy('newsletters.name', 'asc')
            ->paginate(10)
            ->withQueryString();
        //
        return Inertia::render('Application/Admin/NewsletterList', [
            'filters' => Request::all('search'),
            'newsletters' => $newsletters,
        ]);
    }
    //
    public function admin_newsletter_edit(Newsletter $newsletter)
    {
        $newsletter_members = NewsletterMember::select('id', 'name', 'email', 'uuid')
            ->where('newsletter_id', '=', $newsletter->id)
            ->orderBy('email')
            ->get();
        //
        return Inertia::render('Application/Admin/NewsletterForm', [
            'newsletter' => $newsletter,
            'newsletter_members' => $newsletter_members,
        ]);
    }
    //
    public function admin_newsletter_update(Newsletter $newsletter, AdminUpdateNewsletterRequest $request)
    {
        $newsletter->name = $request->name;
        $newsletter->description = $request->description;
        $newsletter->save();
        //
        return Redirect::route('admin.newsletter.edit', $newsletter->id)
            ->with(['success' => 'Die Daten des Newsletters wurden erfolgreich geändert.']);
    }
    //
    public function admin_newsletter_delete(Newsletter $newsletter)
    {
        $newsletter->delete();
        //
        $newsletter->newsletter_members()->delete();
        //
        return Redirect::route('admin.newsletter.index')
            ->with(['success' => 'Der Newletter wurde erfolgreich gelöscht.']);
    }
}
