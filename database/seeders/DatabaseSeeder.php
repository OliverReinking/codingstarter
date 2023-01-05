<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Blog;
use App\Models\Chat;
use App\Models\User;
use App\Models\Company;
use App\Models\Country;
use App\Models\Webinar;
use App\Models\ChatType;
use App\Models\Customer;
use App\Models\BlogImage;
use App\Models\BlogAuthor;
use App\Models\Newsletter;
use App\Models\Salutation;
use App\Models\BlogCategory;
use App\Models\ChatUserType;
use App\Models\WebinarImage;
use App\Models\PersonCompany;
use App\Models\Administration;
use Illuminate\Database\Seeder;
use App\Models\NewsletterMember;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AdminSeeder::class);
        // nur in der Testumgebung
        $this->call(TestData::class);
        // nur einmal pro Anwendung mit truncate
        $this->call(CreateWebinarImages::class);
        $this->call(WebinarData::class);
        $this->call(CreateBlogCategories::class);
        $this->call(CreateBlogImages::class);
        $this->call(CreateBlogAuthors::class);
        $this->call(CreateBlogWithMarkdownFormat::class);
        $this->call(CreateChatTypes::class);
        $this->call(CreateChatUserTypes::class);
        $this->call(CreateCountries::class);
        $this->call(CreateSalutations::class);
        $this->call(NewsletterData::class);
    }
}

class AdminSeeder extends Seeder
{
    public function run()
    {
        // Create Administrator
        $user = User::create([
            'first_name' => 'Oliver',
            'last_name' => 'Reinking',
            'email' => 'admin@codingstarter.de',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('12345678'),
            'is_admin' => true,
            'is_employee' => true,
            'is_customer' => true,
        ]);
        //
        $person_company = PersonCompany::factory()->create([
            'is_natural_person' => false,
            'name' => 'Codingjungle',
            'contactperson_salutation_id' => 1,
            'contactperson_last_name' => 'Oliver',
            'contactperson_first_name' => 'Reinking',
            'contactperson_email' => 'oliver@codingjungle.de',
        ]);
        // Create Administration
        Administration::create([
            'admin_id' => $person_company->id,
        ]);
        // Create Company
        Company::create([
            'company_id' => $person_company->id,
        ]);
        // Create Customer
        Customer::create([
            'customer_id' => $person_company->id,
            'company_id' => $person_company->id,
        ]);
        //
        $user->admin_id = $person_company->id;
        $user->company_id = $person_company->id;
        $user->customer_id = $person_company->id;
        $user->save();
    }
}

class CreateSalutations extends Seeder
{
    public function run()
    {
        Salutation::truncate();
        // Create Salutation
        Salutation::create([
            'id' => 1,
            'name' => 'Herr',
        ]);
        // Create Salutation
        Salutation::create([
            'id' => 2,
            'name' => 'Frau',
        ]);
        // Create Salutation
        Salutation::create([
            'id' => 3,
            'name' => 'Weitere',
        ]);
    }
}

class CreateCountries extends Seeder
{
    public function run()
    {
        Country::truncate();
        // Create Country
        Country::create([
            'id' => 1,
            'name' => 'Deutschland',
        ]);
        // Create Country
        Country::create([
            'id' => 2,
            'name' => 'Frankreich',
        ]);
        // Create Country
        Country::create([
            'id' => 3,
            'name' => 'Schweiz',
        ]);
        // Create Country
        Country::create([
            'id' => 4,
            'name' => 'Dänemark',
        ]);
        // Create Country
        Country::create([
            'id' => 5,
            'name' => 'Niederlande',
        ]);
        // Create Country
        Country::create([
            'id' => 6,
            'name' => 'Belgien',
        ]);
        // Create Country
        Country::create([
            'id' => 7,
            'name' => 'Italien',
        ]);
        // Create Country
        Country::create([
            'id' => 8,
            'name' => 'Polen',
        ]);
        // Create Country
        Country::create([
            'id' => 9,
            'name' => 'Spanien',
        ]);
        // Create Country
        Country::create([
            'id' => 10,
            'name' => 'Portugal',
        ]);
        // Create Country
        Country::create([
            'id' => 11,
            'name' => 'Monaco',
        ]);
        // Create Country
        Country::create([
            'id' => 12,
            'name' => 'Österreich',
        ]);
        // Create Country
        Country::create([
            'id' => 13,
            'name' => 'Griechenland',
        ]);
        // Create Country
        Country::create([
            'id' => 14,
            'name' => 'Finnland',
        ]);
        // Create Country
        Country::create([
            'id' => 15,
            'name' => 'Luxemburg',
        ]);
        // Create Country
        Country::create([
            'id' => 16,
            'name' => 'Liechtenstein',
        ]);
        // Create Country
        Country::create([
            'id' => 17,
            'name' => 'Vereinigtes Königreich',
        ]);
        // Create Country
        Country::create([
            'id' => 18,
            'name' => 'Irland',
        ]);
        // Create Country
        Country::create([
            'id' => 19,
            'name' => 'Tschechien',
        ]);
        // Create Country
        Country::create([
            'id' => 20,
            'name' => 'Türkei',
        ]);
    }
}

class CreateWebinarImages extends Seeder
{
    public function run()
    {
        WebinarImage::truncate();
        // Create WebinarImage
        WebinarImage::create([
            'id' => 1,
            'name' => 'Mann am Schreibtisch',
            'url' => '/images/webinarimages/Webinar_Mann_Schreibtisch.jpg'
        ]);
        // Create WebinarImage
        WebinarImage::create([
            'id' => 2,
            'name' => 'Laptops',
            'url' => '/images/webinarimages/Webinar_Laptops.jpg'
        ]);
        // Create WebinarImage
        WebinarImage::create([
            'id' => 3,
            'name' => 'Laptop A',
            'url' => '/images/webinarimages/Webinar_Laptop_A.jpg'
        ]);
        // Create WebinarImage
        WebinarImage::create([
            'id' => 4,
            'name' => 'Laptop B',
            'url' => '/images/webinarimages/Webinar_Laptop_B.jpg'
        ]);
        // Create WebinarImage
        WebinarImage::create([
            'id' => 5,
            'name' => 'Laptop C',
            'url' => '/images/webinarimages/Webinar_Laptop_C.jpg'
        ]);
        // Create WebinarImage
        WebinarImage::create([
            'id' => 6,
            'name' => 'Laptop D',
            'url' => '/images/webinarimages/Webinar_Laptop_D.jpg'
        ]);
    }
}

class CreateBlogCategories extends Seeder
{
    public function run()
    {
        BlogCategory::truncate();
        // Create BlogCategory
        BlogCategory::create([
            'id' => 1,
            'name' => 'Vue-Komponenten',
        ]);
        // Create BlogCategory
        BlogCategory::create([
            'id' => 2,
            'name' => 'Datenmodell',
        ]);
        // Create BlogCategory
        BlogCategory::create([
            'id' => 3,
            'name' => 'Anwendungen',
        ]);
    }
}

class CreateBlogImages extends Seeder
{
    public function run()
    {
        BlogImage::truncate();
        // Create BlogImage
        BlogImage::create([
            'id' => 1,
            'name' => 'moderne Bibliothek',
            'url' => '/images/blogimages/Blog_Bibliothek_480x360.jpg'
        ]);
        // Create BlogImage
        BlogImage::create([
            'id' => 2,
            'name' => 'Karteikartenschrank',
            'url' => '/images/blogimages/Blog_Karteikartenschrank_480x360.jpg'
        ]);
        // Create BlogImage
        BlogImage::create([
            'id' => 3,
            'name' => 'Plan',
            'url' => '/images/blogimages/Blog_Plan_480x360.jpg'
        ]);
        // Create BlogImage
        BlogImage::create([
            'id' => 4,
            'name' => 'Computerbildschirm mit Code',
            'url' => '/images/blogimages/Blog_Screen_480x360.jpg'
        ]);
        // Create BlogImage
        BlogImage::create([
            'id' => 5,
            'name' => 'Sonne',
            'url' => '/images/blogimages/Blog_Sonne_480x360.jpg'
        ]);
        // Create BlogImage
        BlogImage::create([
            'id' => 6,
            'name' => 'Autobahnkreuz',
            'url' => '/images/blogimages/Blog_Autobahnkreuz_480x360.jpg'
        ]);
        // Create BlogImage
        BlogImage::create([
            'id' => 7,
            'name' => 'Containerhafen',
            'url' => '/images/blogimages/Blog_Containerhafen_480x360.jpg'
        ]);
        // Create BlogImage
        BlogImage::create([
            'id' => 8,
            'name' => 'Idee',
            'url' => '/images/blogimages/Blog_Idee_480x360.jpg'
        ]);
        // Create BlogImage
        BlogImage::create([
            'id' => 9,
            'name' => 'Posts',
            'url' => '/images/blogimages/Blog_Posts_480x360.jpg'
        ]);
        // Create BlogImage
        BlogImage::create([
            'id' => 10,
            'name' => 'Schrankwand',
            'url' => '/images/blogimages/Blog_Schrankwand_480x360.jpg'
        ]);
        // Create BlogImage
        BlogImage::create([
            'id' => 11,
            'name' => 'Tasse',
            'url' => '/images/blogimages/Blog_Tasse_480x360.jpg'
        ]);
        // Create BlogImage
        BlogImage::create([
            'id' => 12,
            'name' => 'Warenlager',
            'url' => '/images/blogimages/Blog_Warenlager_480x360.jpg'
        ]);
    }
}

class CreateBlogAuthors extends Seeder
{
    public function run()
    {
        BlogAuthor::truncate();
        // Create BlogAuthor
        BlogAuthor::create([
            'id' => 1,
            'name' => 'Oliver Reinking',
            'info' => 'Oliver ist Mathematiker und begann seine berufliche Laufbahn 1990 bei der Victoria AG.
            Dort war er u.a. als Projektleiter für das Projekt "Wiederanlage ablaufender Lebensversicherungen" tätig.
            <br />
            Im Jahr 1998 gründete er gemeinsam mit Michael Becker die MilesTec Software GmbH.
            Hier entwickelte er das erste internetbasierte Bestandsverwaltungssystem für Versicherungen.
            <br />
            Heute ist Oliver CTO bei der CFgO GmbH.
            '
        ]);
    }
}

class CreateChatTypes extends Seeder
{
    public function run()
    {
        ChatType::truncate();
        // Create ChatType
        ChatType::create([
            'id' => ChatType::ChatType_normaleNachricht,
            'name' => 'normale Chat-Nachricht',
        ]);
    }
}

class CreateChatUserTypes extends Seeder
{
    public function run()
    {
        ChatUserType::truncate();
        // Create ChatUserType
        ChatUserType::create([
            'id' => ChatUserType::ChatUserType_Customer,
            'name' => 'Kunde',
        ]);
        // Create ChatUserType
        ChatUserType::create([
            'id' => ChatUserType::ChatUserType_Company,
            'name' => 'Unternehmen',
        ]);
        // Create ChatUserType
        ChatUserType::create([
            'id' => ChatUserType::ChatUserType_Administrator,
            'name' => 'Administrator',
        ]);
    }
}

// Blogartikel im Markdown-Format
class CreateBlogWithMarkdownFormat extends Seeder
{
    public function run()
    {
        // für den ersten Artikel setze markdown_on auf true
        $blog_author_id = 1;
        $blog_image_id = 4;
        $blog_category_id = 1;
        $title = "Die Vue-Komponenten";
        $summary = "Im CodingStarter sind bereits eine Vielzahl von Vue-Komponenten enthalten, in diesem Artikel möchte ich euch diese Vue-Komponenten im Detail vorstellen.";
        $blog_date = Carbon::now()->subDays(21);
        $reading_time = 10;
        //
        Blog::create([
            'blog_author_id' => $blog_author_id,
            'blog_image_id' => $blog_image_id,
            'blog_category_id' => $blog_category_id,
            'title' => $title,
            'summary' => $summary,
            'blog_date' => $blog_date,
            'content' => null,
            'reading_time' => $reading_time,
            'markdown_on' => true,
        ]);
        // für den zweiten Artikel setze markdown_on auf true
        $blog_author_id = 1;
        $blog_image_id = 6;
        $blog_category_id = 3;
        $title = "Die Anwendungen und Funktionen im CodingStarter";
        $summary = "Im CodingStarter sind insgesamt vier Anwendungen enthalten. Eine Webseite, eine Anwendung für Administratoren, eine für Mitarbeiter und die dritte für Kunden. In diesem Blogartikel werden die Funktionen dieser Anwendungen beschrieben.";
        $blog_date = Carbon::now()->subDays(14);
        $reading_time = 10;
        //
        Blog::create([
            'blog_author_id' => $blog_author_id,
            'blog_image_id' => $blog_image_id,
            'blog_category_id' => $blog_category_id,
            'title' => $title,
            'summary' => $summary,
            'blog_date' => $blog_date,
            'content' => null,
            'reading_time' => $reading_time,
            'markdown_on' => true,
        ]);
        // für den dritten Artikel setze markdown_on auf true
        $blog_author_id = 1;
        $blog_image_id = 1;
        $blog_category_id = 2;
        $title = "Das Datenmodell";
        $summary = "Im CodingStarter verwenden wir eine SQL-Datenbank. In diesem Artikel möchte ich die verwendeten Tabellen und deren Attribute vorstellen.";
        $blog_date = Carbon::now()->subDays(7);
        $reading_time = 10;
        //
        Blog::create([
            'blog_author_id' => $blog_author_id,
            'blog_image_id' => $blog_image_id,
            'blog_category_id' => $blog_category_id,
            'title' => $title,
            'summary' => $summary,
            'blog_date' => $blog_date,
            'content' => null,
            'reading_time' => $reading_time,
            'markdown_on' => true,
        ]);
    }
}

class WebinarData extends Seeder
{
    public function run()
    {
        // Lege 1 Webinar an
        $event_date = Carbon::now()->addMinutes(rand(1000, 1000000));
        $event_start = "16:00 Uhr";
        $webinar_image_id = rand(1, 6);
        //
        $description = "In diesem 30-minütigen Webinar wird das Laravel-Starterpaket <b>CodingStarter</b> ausführlich vorgestellt.<br />";
        $description .= "Wir beginnen mit der Installation der Plattform <b>CodingStarter</b>.<br />";
        $description .= "Anschließend erstellen wir die Datenbank und erläutern das verwendete Datenbankmodell.<br />";
        $description .= "Schließlich stellen wir die wichtigsten Code-Dateien und deren grundlegenden Aufbau vor.<br />";
        //
        Webinar::create([
            'company_id' => Administration::ADMIN_CODINGSTARTER_ID,
            'webinar_image_id' => $webinar_image_id,
            'event_date' => $event_date,
            'event_start' => $event_start,
            'title' => 'Einführung in das Laravel-Starterpaket CodingStarter',
            'description' => $description,
            'access' => config('app.url') . '/webinar/1',
        ]);
    }
}

class NewsletterData extends Seeder
{
    public function run()
    {
        Newsletter::truncate();
        // Create Newsletter
        Newsletter::create([
            'id' => Newsletter::Newsletter_Platform,
            'name' => 'Plattform ' . config('codingstarter.platform.name'),
            'description' => 'In diesem Newsletter berichten wir über die Plattform ' . config('codingstarter.platform.name') . '.'
        ]);
        //
        NewsletterMember::factory()->times(200)->create(
            [
                'newsletter_id' => Newsletter::Newsletter_Platform,
            ]
        );
    }
}

class TestData extends Seeder
{
    public function run()
    {
        // Lege 1500 Anwender an
        User::factory()->times(1500)->create();
        // --------------------
        // durchlaufe alle User
        // --------------------
        // Der Anwender sollte kein Administrator sein!
        $users = User::where('is_admin', false)->get();
        //
        foreach ($users as $user) {
            // -------------------------------------
            // Ist User einer Company zugeordnet?
            // Ist User also ein Mitarbeiter
            // -------------------------------------
            $zufall_company = random_int(1, 1000);
            //
            if ($zufall_company > 990) {
                //
                $person_company = PersonCompany::factory()->create([
                    'is_natural_person' => false,
                    'contactperson_salutation_id' => 1,
                    'contactperson_last_name' => $user->first_name,
                    'contactperson_first_name' => $user->last_name,
                    'contactperson_email' => $user->email,
                ]);
                //
                $user->is_employee = true;
                $user->company_id = $person_company->id;
                $user->save();
                //
                Company::create([
                    'company_id' => $person_company->id
                ]);
            }
            // -------------------------------------
            // Ist User einer Person zugeordnet?
            // Ist User also ein Kunde
            // -------------------------------------
            $zufall_person = random_int(1, 100);
            //
            if ($zufall_person < 96) {
                //
                $person_company = PersonCompany::factory()->create([
                    'is_natural_person' => false,
                    'name' => $user->full_name,
                    'contactperson_salutation_id' => 1,
                    'contactperson_last_name' => $user->last_name,
                    'contactperson_first_name' => $user->first_name,
                    'contactperson_phone' => null,
                    'contactperson_email' => $user->email,
                ]);
                //
                $user->is_customer = true;
                $user->customer_id = $person_company->id;
                $user->save();
            }
        }
        // ---------------------------------
        // Ordne alle Kunden eine Company zu
        // ---------------------------------
        $companyCount = Company::count();
        $companyList = Company::get()->pluck('company_id')->toArray();
        //
        $customerList =  User::where('is_customer', true)->get();
        //
        foreach ($customerList as $user) {
            $zufall_company = random_int(0, $companyCount - 1);
            //
            //Log::info('DatabaseSeeder TestData', [
            //    'companyCount' => $companyCount,
            //    'zufall_company' => $zufall_company,
            //]);
            //
            Customer::create([
                'customer_id' => $user->customer_id,
                'company_id' => $companyList[$zufall_company],
            ]);
        }
        // Lege 2000 Chatnachrichten an
        Chat::factory()->times(2000)->create();
    }
}
