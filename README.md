# Local Setup Guide

This project is a Laravel 13 application with Vite/Tailwind frontend assets.

## Features

- User authentication (register, login, logout)
- Password recovery and reset flow
- Email verification workflow for account activation
- Protected dashboard route for authenticated and verified users
- User profile management (edit profile, update password, delete account)
- Responsive frontend powered by Blade, Vite, and Tailwind CSS

## Software and Programs Required

Install these before running the project:

- Git (for cloning and pulling updates)
- PHP 8.3 or newer
- Composer 2.x
- Node.js 20+ (includes npm)
- MySQL or MariaDB server (SQLite is also supported)
- A web browser (Chrome, Edge, Firefox, etc.)

## Recommended for Windows

- Laragon (recommended all-in-one local environment for PHP, MySQL, and service management)
- Visual Studio Code (recommended editor)
- MySQL Workbench or phpMyAdmin (optional database GUI)

## PHP Extensions

Make sure common Laravel extensions are enabled:

- BCMath
- Ctype
- Fileinfo
- JSON
- Mbstring
- OpenSSL
- PDO and pdo_mysql
- Tokenizer
- XML

If you are using Laragon on Windows, start Laragon first so PHP and database services are available.

## 1. Clone and Open Project

Clone the repository, then open the project folder:

- c:/laragon/www/sad-final

## Get Latest Commits from development Branch

If you are already on the development branch:

	git checkout development
	git pull origin development

If you are on another branch and only want to update local tracking info:

	git fetch origin development

If you want to merge latest development into your current branch:

	git fetch origin
	git merge origin/development

Optional (view latest commits on development):

	git log origin/development --oneline -n 10

## 2. Install Dependencies and Initial App Setup

Run this in the project root:

	composer run setup

What this script does:

- Installs PHP dependencies
- Creates .env from .env.example (if missing)
- Generates APP_KEY
- Runs migrations
- Installs Node dependencies
- Builds frontend assets

## 3. Configure Environment

Open .env and set your database credentials.

Example for MySQL:

	DB_CONNECTION=mysql
	DB_HOST=127.0.0.1
	DB_PORT=3306
	DB_DATABASE=sad_final
	DB_USERNAME=root
	DB_PASSWORD=

If you changed DB settings after the first setup run, apply migrations again:

	php artisan migrate

## 4. Run in Development Mode

Use the combined dev script:

	composer run dev

This starts:

- Laravel app server
- Queue listener
- Vite dev server

Default app URL:

- http://127.0.0.1:8000

To stop all services, press Ctrl+C.

## Optional: Run Services Separately

If you prefer separate terminals:

Terminal 1:

	php artisan serve

Terminal 2:

	npm run dev

Terminal 3 (optional queue worker):

	php artisan queue:listen --tries=1

## Running Tests

Run test suite:

	composer run test

Or:

	php artisan test

## Production Build of Assets

To build frontend assets for production:

	npm run build

## Common Issues

- APP_KEY missing: run php artisan key:generate
- Storage permission issues: run php artisan storage:link
- Config cache issues after .env changes:

	  php artisan config:clear
	  php artisan cache:clear

## Quick Start (All-in-One)

From a fresh clone:

	composer run setup
	composer run dev

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

In addition, [Laracasts](https://laracasts.com) contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

You can also watch bite-sized lessons with real-world projects on [Laravel Learn](https://laravel.com/learn), where you will be guided through building a Laravel application from scratch while learning PHP fundamentals.

## Agentic Development

Laravel's predictable structure and conventions make it ideal for AI coding agents like Claude Code, Cursor, and GitHub Copilot. Install [Laravel Boost](https://laravel.com/docs/ai) to supercharge your AI workflow:

```bash
composer require laravel/boost --dev

php artisan boost:install
```

Boost provides your agent 15+ tools and skills that help agents build Laravel applications while following best practices.

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
"# lnf"  git init git add README.md git commit -m "first commit" git branch -M main git remote add origin https://github.com/rodriguezreign/lnf.git git push -u origin main
