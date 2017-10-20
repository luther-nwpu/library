Computer Environment:
backend PHP LAVAREL     frontend vue webpack   database mysql

Computer Software
php7.7 composer mysql node

start the mysql-qli
delete ; before mysql-qli in the php.ini
delete ; before file in the php.ini

Use cmd

configuration frontend
switch the frontend
Enter the frontend:  cd frontend
Install packages:  npm install
Test: npm run dev
Build:  npm run build

configuration backend
switch the backend
Enter the backend: cd backend
Install packages: composer install
Create key: php artisan key:generate

configuration database
use mysql workbench 

edit the /backend/config/database.php
****
    'mysql' => [
            'driver' => 'mysql',
        **  'host' => env('DB_HOST', '127.0.0.1'),
        ** 'port' => env('DB_PORT', '3306'),
        **    'database' => env('DB_DATABASE', 'mylibrary'),
        **    'username' => env('DB_USERNAME', 'root'),
        **    'password' => env('DB_PASSWORD', 'root'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => true,
            'engine' => null,
****
edit /backend/.env
****
        DB_CONNECTION=mysql
        DB_HOST=127.0.0.1
        DB_PORT=3306
      **  DB_DATABASE=mylibrary
      **  DB_USERNAME=root
      **  DB_PASSWORD=root
****

create the sql Database mylibrary
create the user account: root password: root;



switch backend category:  cd backend
create sql datasheet: php artisan migrate
run the backend: php artisan serve

