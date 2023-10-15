PART 1: Laravel & Supabase (postgresql) Tutorial

Install:
1. Xampp or PHP https://www.apachefriends.org/download.html
2. Composer https://getcomposer.org/download/

1. php.ini file
- Remove semicolon:

extension=pdo_pgsql
extension=pdo_sqlite
extension=pgsql

2. Create laravel project (Laravel Doc: https://lara vel.com/docs/10.x)
- go to cmd

Type in cmd:
- composer create-project laravel/laravel [APP NAME]
- open project in ide

In Laravel ProjectZ:
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

- To create controller. In Terminal, type: php artisan make:controller TestController

- In TestController, add function:
public function testConnection()
{
    try {
        \DB::connection()->getPdo();
        return response()->json(["message" => "Database connection is working."], 200);
    } catch (\Exception $e) {
        return response()->json(["message" => "Could not connect to the database. Error: " . $e->getMessage()], 500);
    }
}

- To run project locally. In Terminal, type: php artisan serve. "Server running on [http://127.0.0.1:8000]" should show, click to see the project.

- in URL add: /test-db to test db connection. For exp: http://127.0.0.1:8000/test-db


3.Create simple database table
- In Terminal, Type: php artisan make:migration create_adina_table, put your name to test it out. This will create a new migration file in the database/migrations directory. You can edit table columns here. 
- In Terminal, Type: php artisan migrate, the table should show up in supabase ;)

Part 2: GitHub and Laravel Tutorial

This part is to get the TestApp from GitHub and do simple Laravel CRUD in your own git branch.

1. Clone TestApp from Github
- got to cmd
- cmd into a folder you want the project to be in.

Type: 
git clone https://github.com/adinalna/TestApp.git
now the app should be in cloned to your local

2. Create your own Git branch

In terminal of cloned project, Type:
- git branch

You will see all the branches available, to create your own branch type: 
- git checkout -b ＜type-new-branch-name＞
- git push or git push --set-upstream origin ＜type-new-branch-name＞


You are now in your own git branch yay

3. CRUD Tutorial with MVC

npm create vite
cd react
npm i
npm install react-router-dom -s
npm install axios
composer require fruitcake/laravel-cors