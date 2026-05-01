# PHP_Laravel12_Short_Schedular

## Project Introduction

PHP_Laravel12_Short_Schedular is a Laravel 12 demonstration project that shows how to execute scheduled tasks every second using the spatie/laravel-short-schedule package.

Laravel’s default scheduler runs tasks at a minimum interval of one minute. This project extends that functionality to support second-level execution, making it suitable for real-time applications such as live dashboards, monitoring systems, and high-frequency logging.

The project demonstrates how to create a custom Artisan command, configure short scheduling in Laravel 12, and store execution logs in the database for verification.

---

## Project Overview

This project implements a real-time task execution system in Laravel 12 using the following workflow:

- A custom Artisan command demo:every-second is created.

- The command inserts a timestamp entry into the logs table.

- The Spatie Short Schedule package is configured in routes/console.php.

- The short scheduler is started using:

```bash
php artisan short-schedule:run
```
- The command executes every second and continuously inserts new log records into the database.

---

## STEP 1: Create Laravel 12 Project

Open terminal and run:

```bash
composer create-project laravel/laravel PHP_Laravel12_Short_Schedular "12.*"
```

Move into project:

```bash
cd PHP_Laravel12_Short_Schedular
```

Check Laravel version:

```bash
php artisan --version
```

---

## STEP 2: Configure Environment

Open `.env` file and set database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=short_schedular_db
DB_USERNAME=root
DB_PASSWORD=
```

Create database manually in MySQL:

```sql
CREATE DATABASE short_schedular_db;
```

Run migration:

```bash
php artisan migrate
```

---

## STEP 3: Install Laravel Short Schedule

Install package:

```bash
composer require spatie/laravel-short-schedule
```

---

## STEP 4: Create Demo Log Table

Create migration:

```bash
php artisan make:migration create_logs_table
```

Edit migration file:

```php
public function up(): void
{
    Schema::create('logs', function (Blueprint $table) {
        $table->id();
        $table->string('message');
        $table->timestamps();
    });
}
```

Run migration:

```bash
php artisan migrate
```

---

## STEP 5: Create Log Model

```bash
php artisan make:model Log
```

app/Models/Log.php

```php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $fillable = ['message'];
}
```

---

## STEP 6: Create Command That Runs Every Second

Create custom command:

```bash
php artisan make:command EverySecondCommand
```

app/Console/Commands/EverySecondCommand.php

```php
<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Log;

class EverySecondCommand extends Command
{
    protected $signature = 'demo:every-second';
    protected $description = 'Run task every second';

    public function handle()
    {
        Log::create([
            'message' => 'Executed at ' . now()
        ]);

        $this->info('Command executed at ' . now());
    }
}
```

---

## STEP 7: Configure Short Scheduler

Open:

```
routes/console.php
```

Add this:

```php
<?php

use Spatie\ShortSchedule\ShortSchedule;

/*
|--------------------------------------------------------------------------
| Short Schedule
|--------------------------------------------------------------------------
*/

app()->booted(function () {
    app(ShortSchedule::class)
        ->command('demo:every-second')
        ->everySecond();
});
```

---

## STEP 8: Run Short Scheduler

Instead of default scheduler, run:

```bash
php artisan short-schedule:run
```

Check database:

```sql
SELECT * FROM logs;
```

You will see new row inserted every second.

Manual command:

```bash
php artisan demo:every-second
```

---

## Final Testing Steps

1. Run migration
2. Run short scheduler
3. Check database records

---

## Output

<img width="1911" height="125" alt="Screenshot 2026-03-02 122231" src="https://github.com/user-attachments/assets/971fbaa6-bcc0-4803-af1a-f200b0c76e35" />

---

## Project Structure

```
PHP_Laravel12_Short_Schedular
│
├── app
│   ├── Console
│   │   └── Commands
│   │       └── EverySecondCommand.php
│   ├── Models
│   │   └── Log.php
│
├── database
│   └── migrations
│       └── create_logs_table.php
│
├── routes
│   ├── web.php
│   └── console.php   ← Scheduling happens here (Laravel 12)
│
├── .env              ← Environment configuration file
├── artisan
├── composer.json
```

---

Your PHP_Laravel12_Short_Schedular Project is now ready!
<<<<<<< HEAD


=======
>>>>>>> development
