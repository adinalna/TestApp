To clone this repo, follow this: https://docs.github.com/en/repositories/creating-and-managing-repositories/cloning-a-repository

**Laravel & Supabase (postgresql) Tutorial**

Install:
1. Xampp or PHP https://www.apachefriends.org/download.html
2. Composer https://getcomposer.org/download/

1. php.ini file
- Remove semicolon:

extension=pdo_pgsql
extension=pdo_sqlite
extension=pgsql

2. Create laravel project (Laravel Doc: https://laravel.com/docs/9.x)
- go to cmd
- composer create-project laravel/laravel [APP NAME]
- open project in ide
- database.php file:
 'default' => env('DB_CONNECTION', 'pgsql'),

- env file: (contents from settings/database of supabase database):

DB_CONNECTION=pgsql
DATABASE_URL=postgresql://postgres:fowlboysandgirls@db.jfwqifoaqzbxtjsffxhz.supabase.co:5432/postgres
DB_HOST=db.jfwqifoaqzbxtjsffxhz.supabase.co
DB_PORT=5432
DB_DATABASE=postgres
DB_USERNAME=postgres
DB_PASSWORD=fowlboysandgirls

2. Test Database connection using route
- in web.php, create test route: 
Route::get('/test-db', [App\Http\Controllers\TestController::class, 'testConnection']);

- In Terminal, create controller. Type:php artisan make:controller TestController

- In TestControlle, add function:
public function testConnection()
{
    try {
        \DB::connection()->getPdo();
        return response()->json(["message" => "Database connection is working."], 200);
    } catch (\Exception $e) {
        return response()->json(["message" => "Could not connect to the database. Error: " . $e->getMessage()], 500);
    }
}

- In Terminal, run project locally. Type:php artisan serve

- in URL add: /test-db to test db connection


3.Create simple database table
- In the database/migrations directory, delete the default create_users_table file migration
- In Terminal, Type: php artisan make:migration create_users_table. This will create a new migration file in the database/migrations directory. You can edit table columns here.
- In Terminal, Type: php artisan migrate, the table should show up in supabase ;)



