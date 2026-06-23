# Synthesis Project OFPPT

Synthesis Project OFPPT is a Laravel 12 web application for managing public projects and localized subprojects. It is designed around a role-based workflow where administrators manage users, gestionnaires manage reference data and operational entries, financiers update cost information, and directeurs consult a dashboard with summary indicators.

The application centralizes the full project chain from domain and chantier definition to programme, projet, and sous-projet follow-up. It also links projects to provinces and communes so the data can be viewed from both an administrative and territorial perspective.

## Functional Overview

This application covers two main needs:

- Administrative management of reference data such as provinces, communes, domaines, chantiers, and programmes.
- Operational monitoring of projects and sousprojets, including progress, localization, beneficiaries, financing, and comments.

## Main Features

- Authentication with login/logout flow.
- Role-based access control using `spatie/laravel-permission`.
- Management of provinces and communes.
- Management of domaines, chantiers, and programmes.
- Management of projets with physical and financial progress.
- Management of localized sousprojets linked to communes and projets.
- Financial follow-up for sousprojets through the `couts` module.
- Director dashboard with totals, averages, and grouped project statistics.
- User management for admin accounts.
- Profile update page for authenticated users.

## Roles and Access

| Role | Main access |
| --- | --- |
| `admin` | User management, reference data, projects, sousprojets |
| `gestionnaire` | Provinces, communes, domaines, chantiers, programmes, projects, sousprojets |
| `directeur` | Projects, sousprojets, dashboard consultation |
| `financier` | Projects, sousprojets, financial cost tracking |

## Business Modules

### 1. Reference Data

These modules define the structure used by the rest of the application:

- `province`
- `commune`
- `domaine`
- `chantier`
- `programme`

### 2. Project Management

The `projet` module stores high-level project information such as:

- project code and name
- programme and province
- planned years
- CRO and total cost
- physical and financial progress
- comments
- linked communes

### 3. Localized Subproject Management

The `sousprojet` module stores detailed field information such as:

- sousprojet code and name
- related projet and commune
- sector, site, center, surface, and linear data
- served douars and beneficiaries
- financing source
- intervention details
- initial estimate
- physical and financial progress
- locality and comments

### 4. Financial Tracking

The `couts` module is intended for the financier role and focuses on:

- assigning an initial estimate to a sousprojet
- updating financial progress
- filtering financial entries by project

### 5. Dashboard

The director dashboard provides:

- total number of projets
- total number of sousprojets
- average physical progress
- average financial progress
- grouped project counts by start year
- grouped project counts by province

## Core Data Relationships

The application follows this general structure:

- `Domaine` -> `Chantier` -> `Programme` -> `Projet`
- `Province` -> `Commune`
- `Projet` -> many `SousProjetLocalise`
- `Projet` -> many `Commune` through `commune_projet`

This makes it possible to track both the program hierarchy and the territorial distribution of each project.

## Tech Stack

- PHP 8.2+
- Laravel 12
- Blade templates
- Vite
- Bootstrap 5
- SQLite or MySQL
- Spatie Laravel Permission
- PHPUnit

## Seeded Demo Data

The project seeder creates sample reference data and demo users. After running `php artisan migrate:fresh --seed`, you can log in with these accounts:

| Role | Email | Password |
| --- | --- | --- |
| Admin | `admin@example.com` | `password` |
| Gestionnaire | `gestionnaire@example.com` | `password` |
| Directeur | `directeur@example.com` | `password` |
| Financier | `financier@example.com` | `password` |

The seeder also inserts sample domaines, provinces, communes, projets, and sousprojets so the application can be explored immediately.

## Local Setup

### 1. Install dependencies

```powershell
composer install
npm install
```

### 2. Create the environment file

```powershell
Copy-Item .env.example .env
php artisan key:generate
```

### 3. Configure the database

For a quick local setup, SQLite is the simplest option:

```powershell
New-Item -ItemType File -Force database\database.sqlite
```

Then update `.env` with a local database configuration. Recommended minimum values:

```env
DB_CONNECTION=sqlite
SESSION_DRIVER=file
CACHE_STORE=file
QUEUE_CONNECTION=sync
```

If your environment requires it, set `DB_DATABASE` to the full path of `database/database.sqlite`.

You can also use MySQL by setting:

- `DB_CONNECTION=mysql`
- `DB_HOST`
- `DB_PORT`
- `DB_DATABASE`
- `DB_USERNAME`
- `DB_PASSWORD`

### 4. Run migrations and seeders

```powershell
php artisan migrate:fresh --seed
```

### 5. Start the application

Use the full development stack:

```powershell
composer dev
```

Or run the app and frontend separately:

```powershell
php artisan serve
npm run dev
```

## Useful Commands

```powershell
php artisan test
npm run build
php artisan route:list
php artisan migrate:fresh --seed
```

## Project Structure

- `app/Http/Controllers` contains the application logic for each module.
- `app/Models` contains the main Eloquent models.
- `database/migrations` defines the database schema.
- `database/seeders` inserts demo users and sample business data.
- `resources/views` contains the Blade templates.
- `public/css` contains the current custom styling.
- `routes/web.php` defines the web routes and role-based access.

## Current Scope

This project is focused on internal project monitoring and data entry. It is best suited for:

- tracking regional public projects
- following project progress over time
- organizing projects by administrative geography
- separating responsibilities by user role

## Testing

The current test suite can be executed with:

```powershell
php artisan test
```

## License

This project is distributed under the MIT license.
