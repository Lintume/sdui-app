## SDUI app

### On Board:

- Laravel framework v9
- SQLite
- CRUD for news
- ORM and relationships/associations
- Request validation
- Migrations, factories, tests, events, CRON jobs
- PSR-2 compliant source code

### What you need for running:
- PHP 8+
- npm

### Installation instructions:
- `git clone git@github.com:Lintume/sdui-app.git`
- `cd sdui-app`
- `cp .env.example .env`
- `touch database/database.sqlite file`
- Set up absolute path to database/database.sqlite file in .env file (DB_DATABASE)
- `composer install`
- `php artisan serve`
- open new terminal window
- `php artisan migrate`
- `npm install`
- `npm run dev`
- open new terminal window
- `php artisan test`
- Enjoy!

