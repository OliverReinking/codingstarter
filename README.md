# CodingStarter

## Bestandteile
Die Plattform **CodingStarter** besteht aus:
- Laravel 9
- Vue.js 3
- Inertia
- Jetstream
- Tailwind CSS 3
- Homepage
- Anwendung für "Administratoren"
- Anwendung für "Mitarbeiter"
- Anwendung für "Kunden"
   
## Datenmodell

- blogs

- blog_authors

- blog_categories

- blog_images

- chats

- chat_types

- chat_user_types

- companies

- countries

- customers
  
- invitations

- newsletters

- newsletter_members

- person_companies

- salutations

- users
  - user.admin_id = person_companies.id
  - user.company_id = person_companies.id
  - user.customer_id = person_companies.id

- webinars

- webinar_images

- webinar_orders

## Installation

### 1
```
git clone https://github.com/OliverReinking/codingstarter.git
code .
```

### 2
Erstelle die .env-Datei.  
Als Vorlage kann die Datei .env.example dienen.  
Anzupassen sind u.a. die Datenbank sowie die Mail-Anbindung.  

### 3
Benenne die Datei codingstarter.php um und verwende für den Dateinamen den Projektnamen.
Anschließend passe diese projektspezifische Konfigurationsdatei an.

### 4
```
composer install
npm install
php artisan key:generate
php artisan migrate
valet link
npm run dev
```

Jetzt kann man die Anwendung im Browser öffnen.

## License

The Package **CodingStarter** is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
