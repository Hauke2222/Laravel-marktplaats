```
Project setup:

composer install

mysql -u root
run: create database database_name;

cp .env.example .env
code .env

edit if needed: DB_PORT=, DB_DATABASE=, DB_USERNAME=, DB_PASSWORD=

php artisan key:generate
php artisan migrate:fresh --seed


Run project:

php artisan serve
```
