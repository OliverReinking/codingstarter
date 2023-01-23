<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\DashboardCustomerController;
use App\Http\Controllers\DashboardEmployeeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\NewsletterMemberController;
use App\Http\Controllers\PersonCompanyController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WebinarController;
use App\Http\Controllers\WebinarOrderController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// --------
// Homepage
// --------
// Startseite
Route::get('/', [HomeController::class, 'home_index'])->name('home');
// Über uns
Route::get('/about', [HomeController::class, 'home_about'])->name('about');
// Unsere Mission
Route::get('/mission', [HomeController::class, 'home_mission'])->name('mission');
// Kontaktformular
Route::get('/contact', [HomeController::class, 'home_contact'])->name('contact');
// Impressum
Route::get('/imprint', [HomeController::class, 'home_imprint'])->name('imprint');
// Datenschutzerklärung
Route::get('/privacy', [HomeController::class, 'home_privacy'])->name('privacy');
// Nutzungsbedingungen
Route::get('/terms', [HomeController::class, 'home_terms'])->name('terms');

// Liste der Blogartikel
Route::get('/blogs', [HomeController::class, 'home_blog_index'])->name('home.blog.index')->middleware('remember');
// Display Blogartikel
Route::get('/blogs/show/{slug}', [HomeController::class, 'home_blog_show'])->name('home.blog.show');

// Liste der Webinare
Route::get('/webinars', [HomeController::class, 'home_webinar_index'])->name('home.webinar.index')->middleware('remember');
// Display Webinar
Route::get('/webinars/show/{webinar}', [HomeController::class, 'home_webinar_show'])->name('home.webinar.show');
// Webinaranmeldung Formular
Route::get('/webinar_order/{webinar}', [HomeController::class, 'home_webinar_order'])->name('home.webinar.order');
// Webinaranmeldung jetzt durchführen
Route::post('/webinar_order/send/{webinar}', [HomeController::class, 'home_webinar_order_send'])
    ->name('home.webinar.order.send');

// Newsletter Register
Route::get('/newsletter_register/{newsletter}', [HomeController::class, 'home_newsletter_register'])->name('home.newsletter.register');
// Newsletter jetzt abonnieren
Route::post('/newsletter_register/send/{newsletter}', [HomeController::class, 'home_newsletter_send'])
    ->name('home.newsletter.send');
// Newsletter-Abo jetzt bestätigen
Route::get('/newsletter_register/subscription/verified/{slug}', [HomeController::class, 'home_newsletter_subscription_verified'])
    ->name('home.newsletter.subscription.verified');
// Newsletter-Abo jetzt abbestellen
Route::get('/newsletter_register/subscription/cancelled/{slug}', [HomeController::class, 'home_newsletter_subscription_cancelled'])
    ->name('home.newsletter.subscription.cancelled');

// Bewerbungsformular
Route::get('/job_application', [HomeController::class, 'home_job_application'])->name('job_application');
// Bewerbungsformular Send
Route::post('/job_application/send', [HomeController::class, 'home_job_application_send'])
    ->name('home.job_application.send');

// Anwender nimmt Einladung (invitations) an
Route::get('/invitation/accept/{slug}', [HomeController::class, 'home_invitation_accept'])
    ->name('home.invitation.accept');
// Anwender gibt sein Kennwort ein (Fall Einladung eines Teammitglieds, und Mailadresse ist noch nicht in Tabelle users vorhanden)
Route::post('/invitation/register/{slug}', [HomeController::class, 'home_invitation_register'])
    ->name('home.invitation.register');

// Anwender ist kein Administrator
Route::get(
    '/user_is_no_admin',
    [HomeController::class, 'user_is_no_admin']
)->name('user_is_no_admin');
// Anwender ist kein Mitarbeiter
Route::get('/user_is_no_employee', [HomeController::class, 'user_is_no_employee'])->name('user_is_no_employee');
// Anwender ist kein Kunde
Route::get('/user_is_no_customer', [HomeController::class, 'user_is_no_customer'])->name('user_is_no_customer');

// Anwendung konnte nicht gefunden werden
Route::get('/no_application_found', [HomeController::class, 'no_application_found'])
    ->name('no_application_found');

// ------------------------------
// Routen für angemeldete Anwender
// -------------------------------
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    // =================
    // APPLICATIONSWITCH
    // =================
    Route::get('/applicationswitch', [ApplicationController::class, 'index'])->name('applicationswitch');

    // =================
    // APPLICATION ADMIN
    // =================
    Route::middleware(['is_admin'])->group(function () {
        // Dashboard
        Route::get(
            '/admin/dashboard',
            [DashboardAdminController::class, 'admin_index']
        )->name('admin.dashboard');
        // ===============
        // PersonCompanies
        // ===============
        // Liste der Personen/Unternehmen (person_companies)
        Route::get('/admin/person_companies/index', [PersonCompanyController::class, 'admin_person_company_index'])
            ->name('admin.person_company.index')->middleware('remember');
        // Display Unternehmen
        Route::get('/admin/person_companies/show/{person_company}', [PersonCompanyController::class, 'admin_person_company_show'])
            ->name('admin.person_company.show');
        // Edit der Unternehmensdaten
        Route::get('/admin/person_companies/{person_company}/edit', [PersonCompanyController::class, 'admin_person_company_edit'])
            ->name('admin.person_company.edit');
        // Update der Unternehmensdaten
        Route::put('/admin/person_companies/{person_company}', [PersonCompanyController::class, 'admin_person_company_update'])
            ->name('admin.person_company.update');
        // Delete Unternehmensdaten
        Route::delete('/admin/person_companies/{person_company}', [PersonCompanyController::class, 'admin_person_company_delete'])
            ->name('admin.person_company.delete');
        // ==========
        // Teammember
        // ==========
        // Liste der Anwender des Consultants
        Route::get('/admin/teammember/index', [UserController::class, 'admin_teammember_index'])
            ->name('admin.teammember.index')->middleware('remember');
        // Create a new teammember
        Route::get('/admin/teammember/create', [UserController::class, 'admin_teammember_create'])
            ->name('admin.teammember.create');
        // Store new teammember
        Route::post('/admin/teammember/store', [UserController::class, 'admin_teammember_store'])
            ->name('admin.teammember.store');
        // Edit des Anwenders
        Route::get('/admin/teammember/{user}/edit', [UserController::class, 'admin_teammember_edit'])
            ->name('admin.teammember.edit');
        // Update des Anwenders
        Route::put('/admin/teammember/{user}', [UserController::class, 'admin_teammember_update'])
            ->name('admin.teammember.update');
        // Delete Anwenders
        Route::delete('/admin/teammember/{user}', [UserController::class, 'admin_teammember_delete'])
            ->name('admin.teammember.delete');
        // ===========
        // Invitations
        // ===========
        // Liste der Teammitglieder-Einladeungen
        Route::get('/admin/invitation/index', [InvitationController::class, 'admin_invitation_index'])
            ->name('admin.invitation.index');
        // Delete Anwenders
        Route::delete('/admin/invitation/{invitation}', [InvitationController::class, 'admin_invitation_delete'])
            ->name('admin.invitation.delete');
        // ===========
        // Posteingang
        // ===========
        // Liste der Chat-Nachrichten Posteingang
        Route::get('/admin/chat/inbox/index/{filter_read?}', [ChatController::class, 'admin_chat_inbox_index'])
            ->name('admin.chat.inbox.index')->middleware('remember');
        // Display der Nachricht (Posteingang)
        Route::get('/admin/chat/inbox/show/{chat}', [ChatController::class, 'admin_chat_inbox_show'])
            ->name('admin.chat.inbox.show');
        // ===========
        // Postausgang
        // ===========
        // Liste der Chat-Nachrichten Postausgang
        Route::get('/admin/chat/outbox', [ChatController::class, 'admin_chat_outbox_index'])
            ->name('admin.chat.outbox.index')->middleware('remember');
        // Display der Nachricht (Postausgang)
        Route::get('/admin/chat/outbox/show/{chat}', [ChatController::class, 'admin_chat_outbox_show'])
            ->name('admin.chat.outbox.show');
        // ---------
        // Processes
        // ---------
        Route::get(
            '/admin/processes',
            [DashboardAdminController::class, 'admin_processes']
        )->name('admin.processes');
        // -----------------------------------------------------
        // Content (Blogs, Webinare, Newsletter, Contentplanung)
        // -----------------------------------------------------
        Route::get(
            '/admin/contents',
            [DashboardAdminController::class, 'admin_content_index']
        )->name('admin.content.index');
        // -----
        // Blogs
        // -----
        // Liste der Blogartikel (blogs)
        Route::get('/admin/blogs/index', [BlogController::class, 'admin_blog_index'])
            ->name('admin.blog.index')->middleware('remember');
        // Create a new Blogartikel
        Route::get('/admin/blogs/create', [BlogController::class, 'admin_blog_create'])
            ->name('admin.blog.create');
        // Store Blogartikel
        Route::post('/admin/blogs/store', [BlogController::class, 'admin_blog_store'])
            ->name('admin.blog.store');
        // Edit des Blogartikels
        Route::get('/admin/blogs/{blog}/edit', [BlogController::class, 'admin_blog_edit'])
            ->name('admin.blog.edit');
        // Update des Blogartikels
        Route::put('/admin/blogs/{blog}', [BlogController::class, 'admin_blog_update'])
            ->name('admin.blog.update');
        // Blogartikel Delete
        Route::delete('/admin/blogs/{blog}', [BlogController::class, 'admin_blog_delete'])
            ->name('admin.blog.delete');
        // --------
        // Webinars
        // --------
        Route::get('/admin/webinar/index', [WebinarController::class, 'admin_webinar_index'])
            ->name('admin.webinar.index')->middleware('remember');
        // Create a new Webinar
        Route::get('/admin/webinar/create', [WebinarController::class, 'admin_webinar_create'])
            ->name('admin.webinar.create');
        // Store Webinar
        Route::post('/admin/webinar/store', [WebinarController::class, 'admin_webinar_store'])
            ->name('admin.webinar.store');
        // Edit des Webinars
        Route::get('/admin/webinar/{webinar}/edit', [WebinarController::class, 'admin_webinar_edit'])
            ->name('admin.webinar.edit');
        // Update des Webinar
        Route::put('/admin/webinar/{webinar}', [WebinarController::class, 'admin_webinar_update'])
            ->name('admin.webinar.update');
        // Delete Webinar
        Route::delete('/admin/webinar/{webinar}', [WebinarController::class, 'admin_webinar_delete'])
            ->name('admin.webinar.delete');
        // Send Reminder
        Route::put('/admin/webinar/reminder/{webinar}', [WebinarController::class, 'admin_webinar_reminder'])
            ->name('admin.webinar.reminder');
        // -------------
        // Webinarorders
        // -------------
        Route::get('/admin/webinarorder/index', [WebinarOrderController::class, 'admin_webinarorder_index'])
            ->name('admin.webinarorder.index')->middleware('remember');
        // Edit der Webinarorder
        Route::get('/admin/webinarorder/{webinar_order}/edit', [WebinarOrderController::class, 'admin_webinarorder_edit'])
            ->name('admin.webinarorder.edit');
        // Update der Webinarorder
        Route::put('/admin/webinarorder/{webinar_order}', [WebinarOrderController::class, 'admin_webinarorder_update'])
            ->name('admin.webinarorder.update');
        // Delete der Webinarorder
        Route::delete('/admin/webinarorder/{webinar_order}', [WebinarOrderController::class, 'admin_webinarorder_delete'])
            ->name('admin.webinarorder.delete');
        // Anmeldebestätigung per Mail
        Route::put('/admin/webinarorder/{webinar_order}/send/registration/info', [WebinarOrderController::class, 'admin_webinarorder_send_mail_registration_info'])
            ->name('admin.webinarorder.send.mail.registration.info');
        // ----------
        // Newsletter
        // ----------
        // Liste der Newsletter (newsletters)
        Route::get('/admin/newsletters/index', [NewsletterController::class, 'admin_newsletter_index'])
            ->name('admin.newsletter.index')->middleware('remember');
        // Edit des Newsletters
        Route::get('/admin/newsletters/{newsletter}/edit', [NewsletterController::class, 'admin_newsletter_edit'])
            ->name('admin.newsletter.edit');
        // Update des Newsletters
        Route::put('/admin/newsletters/{newsletter}', [NewsletterController::class, 'admin_newsletter_update'])
            ->name('admin.newsletter.update');
        // Newsletter Delete
        Route::delete('/admin/newsletters/{newsletter}', [NewsletterController::class, 'admin_newsletter_delete'])
            ->name('admin.newsletter.delete');
        // -----------------
        // Newsletter-Member
        // -----------------
        // Newsletter-Member Delete
        Route::delete('/admin/newslettermembers/{newsletter_member}', [NewsletterMemberController::class, 'admin_newsletter_member_delete'])
            ->name('admin.newsletter.member.delete');
        // ----------
        // Statistics
        // ----------
        Route::get(
            '/admin/statistics',
            [DashboardAdminController::class, 'admin_statistics']
        )->name('admin.statistics');
        // -----
        // Users
        // -----
        // Liste der Anwender
        Route::get('/admin/users/index', [UserController::class, 'admin_user_index'])
            ->name('admin.user.index')->middleware('remember');
        // Display der Anwender
        Route::get('/admin/users/show/{appuser}', [UserController::class, 'admin_user_show'])
            ->name('admin.user.show');
        // Edit der Anwenderdaten
        Route::get('/admin/users/{appuser}/edit', [UserController::class, 'admin_user_edit'])
            ->name('admin.user.edit');
        // Update der Anwenderdaten
        Route::put('/admin/users/{appuser}', [UserController::class, 'admin_user_update'])
            ->name('admin.user.update');
        // User Delete
        Route::delete('/admin/users/{appuser}', [UserController::class, 'admin_user_delete'])
            ->name('admin.user.delete');
        // -------------
        // Documentation
        // -------------
        // Übersicht Dokumentation
        Route::get('/admin/documentation', [DashboardAdminController::class, 'admin_documentation'])
            ->name('admin.documentation');
        // -------
        // Version
        // -------
        // Übersicht Versions-Dokumentation
        Route::get('/admin/version', [DashboardAdminController::class, 'admin_version'])
            ->name('admin.version');
        // =======
        // Profile
        // =======
        Route::get('/admin/profile', [DashboardAdminController::class, 'admin_profile'])
            ->name('admin.profile');
        // =======
        // Api-Tokens
        // =======
        Route::get('/admin/api_tokens', [DashboardAdminController::class, 'admin_api_tokens_index'])
            ->name('admin.api_tokens.index');
    });

    // ====================
    // APPLICATION EMPLOYEE
    // ====================
    Route::middleware(['is_employee'])->group(function () {
        // Dashboard
        Route::get('/employee/dashboard', [DashboardEmployeeController::class, 'employee_index'])
            ->name('employee.dashboard');
        // No permission
        Route::get('/employee/no_permission/{message?}', [DashboardEmployeeController::class, 'employee_no_permission'])->name('employee.no.permission');
        // ===============
        // PersonCompanies
        // ===============
        // Anzeige der Unternehmensdaten
        Route::get('/employee/person_companies/show/{person_company}', [PersonCompanyController::class, 'employee_person_company_show'])
            ->name('employee.person_company.show');
        // Edit der Unternehmensdaten
        Route::get('/employee/person_companies/{person_company}/edit', [PersonCompanyController::class, 'employee_person_company_edit'])
            ->name('employee.person_company.edit');
        // Update der Unternehmensdaten
        Route::put('/employee/person_companies/{person_company}', [PersonCompanyController::class, 'employee_person_company_update'])
            ->name('employee.person_company.update');
        // ==========
        // Teammember
        // ==========
        // Liste der Anwender des Consultants
        Route::get('/employee/teammember/index', [UserController::class, 'employee_teammember_index'])
            ->name('employee.teammember.index')->middleware('remember');
        // Create a new teammember
        Route::get('/employee/teammember/create', [UserController::class, 'employee_teammember_create'])
            ->name('employee.teammember.create');
        // Store new teammember
        Route::post('/employee/teammember/store', [UserController::class, 'employee_teammember_store'])
            ->name('employee.teammember.store');
        // Edit des Anwenders
        Route::get('/employee/teammember/{user}/edit', [UserController::class, 'employee_teammember_edit'])
            ->name('employee.teammember.edit');
        // Update des Anwenders
        Route::put('/employee/teammember/{user}', [UserController::class, 'employee_teammember_update'])
            ->name('employee.teammember.update');
        // Delete Anwenders
        Route::delete('/employee/teammember/{user}', [UserController::class, 'employee_teammember_delete'])
            ->name('employee.teammember.delete');
        // ===========
        // Invitations
        // ===========
        // Liste der Teammitglieder-Einladeungen
        Route::get('/employee/invitation/index', [InvitationController::class, 'employee_invitation_index'])
            ->name('employee.invitation.index');
        // Delete Anwenders
        Route::delete('/employee/invitation/{invitation}', [InvitationController::class, 'employee_invitation_delete'])
            ->name('employee.invitation.delete');
        // ===========
        // Posteingang
        // ===========
        // Liste der Chat-Nachrichten Posteingang
        Route::get('/employee/chat/inbox/index/{filter_read?}', [ChatController::class, 'employee_chat_inbox_index'])
            ->name('employee.chat.inbox.index')->middleware('remember');
        // Display der Nachricht (Posteingang)
        Route::get('/employee/chat/inbox/show/{chat}', [ChatController::class, 'employee_chat_inbox_show'])
            ->name('employee.chat.inbox.show');
        // ===========
        // Postausgang
        // ===========
        // Liste der Chat-Nachrichten Postausgang
        Route::get('/employee/chat/outbox', [ChatController::class, 'employee_chat_outbox_index'])
            ->name('employee.chat.outbox.index')->middleware('remember');
        // Display der Nachricht (Postausgang)
        Route::get('/employee/chat/outbox/show/{chat}', [ChatController::class, 'employee_chat_outbox_show'])
            ->name('employee.chat.outbox.show');
        // =======
        // Profile
        // =======
        Route::get('/employee/profile', [DashboardEmployeeController::class, 'employee_profile'])
            ->name('employee.profile');
        // =======
        // Api-Tokens
        // =======
        Route::get('/employee/api_tokens', [DashboardEmployeeController::class, 'employee_api_tokens_index'])
            ->name('employee.api_tokens.index');
    });

    // ====================
    // APPLICATION CUSTOMER
    // ====================
    Route::middleware(['is_customer'])->group(function () {
        // Dashboard
        Route::get('/customer/dashboard', [DashboardCustomerController::class, 'customer_index'])
            ->name('customer.dashboard');
        // No permission
        Route::get('/customer/no_permission/{message?}', [DashboardCustomerController::class, 'customer_no_permission'])->name('customer.no.permission');
        // ===============
        // PersonCompanies
        // ===============
        // Anzeige der Unternehmensdaten
        Route::get('/customer/person_companies/show/{person_company}', [PersonCompanyController::class, 'customer_person_company_show'])
            ->name('customer.person_company.show');
        // Edit der Unternehmensdaten
        Route::get('/customer/person_companies/{person_company}/edit', [PersonCompanyController::class, 'customer_person_company_edit'])
            ->name('customer.person_company.edit');
        // Update der Unternehmensdaten
        Route::put('/customer/person_companies/{person_company}', [PersonCompanyController::class, 'customer_person_company_update'])
            ->name('customer.person_company.update');
        // ==========
        // Teammember
        // ==========
        // Liste der Anwender des Consultants
        Route::get('/customer/teammember/index', [UserController::class, 'customer_teammember_index'])
            ->name('customer.teammember.index')->middleware('remember');
        // Create a new teammember
        Route::get('/customer/teammember/create', [UserController::class, 'customer_teammember_create'])
            ->name('customer.teammember.create');
        // Store new teammember
        Route::post('/customer/teammember/store', [UserController::class, 'customer_teammember_store'])
            ->name('customer.teammember.store');
        // Edit des Anwenders
        Route::get('/customer/teammember/{user}/edit', [UserController::class, 'customer_teammember_edit'])
            ->name('customer.teammember.edit');
        // Update des Anwenders
        Route::put('/customer/teammember/{user}', [UserController::class, 'customer_teammember_update'])
            ->name('customer.teammember.update');
        // Delete Anwenders
        Route::delete('/customer/teammember/{user}', [UserController::class, 'customer_teammember_delete'])
            ->name('customer.teammember.delete');
        // ===========
        // Invitations
        // ===========
        // Liste der Teammitglieder-Einladeungen
        Route::get('/customer/invitation/index', [InvitationController::class, 'customer_invitation_index'])
            ->name('customer.invitation.index');
        // Delete Anwenders
        Route::delete('/customer/invitation/{invitation}', [InvitationController::class, 'customer_invitation_delete'])
            ->name('customer.invitation.delete');
        // ===========
        // Posteingang
        // ===========
        // Liste der Chat-Nachrichten Posteingang
        Route::get('/customer/chat/inbox/index/{filter_read?}', [ChatController::class, 'customer_chat_inbox_index'])
            ->name('customer.chat.inbox.index')->middleware('remember');
        // Display der Nachricht (Posteingang)
        Route::get('/customer/chat/inbox/show/{chat}', [ChatController::class, 'customer_chat_inbox_show'])
            ->name('customer.chat.inbox.show');
        // ===========
        // Postausgang
        // ===========
        // Liste der Chat-Nachrichten Postausgang
        Route::get('/customer/chat/outbox', [ChatController::class, 'customer_chat_outbox_index'])
            ->name('customer.chat.outbox.index')->middleware('remember');
        // Display der Nachricht (Postausgang)
        Route::get('/customer/chat/outbox/show/{chat}', [ChatController::class, 'customer_chat_outbox_show'])
            ->name('customer.chat.outbox.show');
        // =======
        // Profile
        // =======
        Route::get('/customer/profile', [DashboardCustomerController::class, 'customer_profile'])
            ->name('customer.profile');
        // =======
        // Api-Tokens
        // =======
        Route::get('/customer/api_tokens', [DashboardCustomerController::class, 'customer_api_tokens_index'])
            ->name('customer.api_tokens.index');
    });
});

// --------------
// Fallback-Route
// --------------
Route::fallback(function () {
    return Inertia::render('Application/Homepage/NoPageFound');
});
