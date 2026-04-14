# SADS - Local Setup Guide

This project is a Laravel 13 application with a Vite + Tailwind CSS frontend.

## Features

- User authentication (register, login, logout)
- Password recovery and reset flow
- Email verification workflow for account activation
- Protected dashboard route for authenticated and verified users
- User profile management (edit profile, update password, delete account)
- Admin role support
- Item management
- Responsive frontend powered by Blade, Vite, and Tailwind CSS

## Prerequisites

Install the following software before running the project.

### Required

| Software             | Version   | Purpose                        | Download                                      |
|----------------------|-----------|--------------------------------|-----------------------------------------------|
| Git                  | latest    | Clone and manage source code   | https://git-scm.com/downloads                 |
| PHP                  | >= 8.3    | Backend runtime                | https://www.php.net/downloads                  |
| Composer             | >= 2.x    | PHP dependency manager         | https://getcomposer.org/download               |
| Node.js (includes npm) | >= 20  | Frontend build tooling         | https://nodejs.org/                            |
| MySQL or MariaDB     | latest    | Database server                | https://dev.mysql.com/downloads/               |

### Recommended (Windows)

| Software             | Purpose                                              | Download                                 |
|----------------------|------------------------------------------------------|------------------------------------------|
| Laragon              | All-in-one local environment (PHP, MySQL, Apache)    | https://laragon.org/download             |
| Visual Studio Code   | Code editor                                          | https://code.visualstudio.com/           |

> If you are using **Laragon**, start it first so that PHP and MySQL services are available in your terminal.

### Required PHP Extensions

Verify these are enabled in your `php.ini` (Laragon enables them by default):

- BCMath
- Ctype
- Fileinfo
- JSON
- Mbstring
- OpenSSL
- PDO + pdo_mysql
- Tokenizer
- XML

You can check enabled extensions by running:

```bash
php -m
```

## Dependencies

### PHP Dependencies (via Composer)

| Package                        | Version    | Type |
|--------------------------------|------------|------|
| laravel/framework              | ^13.0      | prod |
| laravel/tinker                 | ^3.0       | prod |
| fakerphp/faker                 | ^1.23      | dev  |
| laravel/boost                  | *          | dev  |
| laravel/pail                   | ^1.2.5     | dev  |
| laravel/pint                   | ^1.27      | dev  |
| mockery/mockery                | ^1.6       | dev  |
| nunomaduro/collision           | ^8.6       | dev  |
| pestphp/pest                   | ^4.5       | dev  |
| pestphp/pest-plugin-laravel    | ^4.1       | dev  |

### Node Dependencies (via npm)

| Package              | Version              | Type |
|----------------------|----------------------|------|
| tailwindcss          | ^4.0.0               | dev  |
| @tailwindcss/vite    | ^4.0.0               | dev  |
| vite                 | ^8.0.0               | dev  |
| laravel-vite-plugin  | ^3.0.0               | dev  |
| axios                | >=1.11.0 <=1.14.0   | dev  |
| concurrently         | ^9.0.1               | dev  |

## Installation

### 1. Clone the Repository

```bash
git clone <repository-url> sads
cd sads
```

### 2. One-Command Setup

Run the setup script from the project root:

```bash
composer run setup
```

This single command will:

1. Install all PHP dependencies (`composer install`)
2. Copy `.env.example` to `.env` if `.env` does not exist
3. Generate the `APP_KEY`
4. Run database migrations
5. Install all Node dependencies (`npm install`)
6. Build frontend assets (`npm run build`)

### 3. Configure the Database

Open the `.env` file and set your database credentials:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sads
DB_USERNAME=root
DB_PASSWORD=
```

> Make sure the database `sads` exists on your MySQL server before running migrations. You can create it with:
>
> ```sql
> CREATE DATABASE sads;
> ```

If you changed database settings after the initial setup, re-run migrations:

```bash
php artisan migrate
```

### 4. Start the Development Server

```bash
composer run dev
```

This starts three services concurrently:

| Service         | Command                            | Default URL              |
|-----------------|------------------------------------|--------------------------|
| Laravel server  | `php artisan serve`                | http://127.0.0.1:8000   |
| Queue worker    | `php artisan queue:listen --tries=1` | —                      |
| Vite dev server | `npm run dev`                      | handled by Vite HMR     |

Open http://127.0.0.1:8000 in your browser. Press `Ctrl+C` to stop all services.

### Alternative: Run Services Separately

If you prefer running each service in its own terminal:

**Terminal 1** - Laravel server:
```bash
php artisan serve
```

**Terminal 2** - Vite dev server (hot reload):
```bash
npm run dev
```

**Terminal 3** - Queue worker (optional, needed for queued jobs/emails):
```bash
php artisan queue:listen --tries=1
```

## Staying Up to Date

Pull the latest changes from the `dev` branch:

```bash
git checkout dev
git pull origin dev
```

After pulling, install any new dependencies and run migrations:

```bash
composer install
npm install
php artisan migrate
```

## Running Tests

```bash
composer run test
```

Or directly:

```bash
php artisan test
```

## Production Build

Build optimized frontend assets for production:

```bash
npm run build
```

## Troubleshooting

| Problem                              | Solution                                            |
|--------------------------------------|-----------------------------------------------------|
| `APP_KEY` missing                    | `php artisan key:generate`                          |
| Storage/symlink errors               | `php artisan storage:link`                          |
| Config not reflecting `.env` changes | `php artisan config:clear && php artisan cache:clear` |
| Migration errors after DB change     | Verify `.env` DB credentials, then `php artisan migrate` |
| Node modules issues                  | Delete `node_modules` and run `npm install`         |
| Composer lock conflict               | `composer install --no-cache`                       |

## Quick Start (TL;DR)

```bash
git clone <repository-url> sads
cd sads
composer run setup        # install everything + migrate + build
composer run dev          # start dev server at http://127.0.0.1:8000
```
