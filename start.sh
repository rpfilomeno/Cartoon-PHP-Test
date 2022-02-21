#!/bin/bash
cd ./test-app
composer update
php artisan db:create
php artisan migrate
php artisan db:seed --class=UserSeeder
php artisan serve