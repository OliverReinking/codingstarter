<?php

namespace App\Http\Controllers;

use App\Models\NewsletterMember;
use Illuminate\Support\Facades\Redirect;

class NewsletterMemberController extends Controller
{
    // =================
    // APPLICATION ADMIN
    // =================
    public function admin_newsletter_member_delete(NewsletterMember $newsletter_member)
    {
        $newsletter_id = $newsletter_member->newsletter_id;
        //
        $newsletter_member->delete();
        //
        return Redirect::route('admin.newsletter.edit', $newsletter_id)
            ->with(['success' => 'Der Newsletter-Abonnement wurde erfolgreich abgemeldet.']);
    }
}
