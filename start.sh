#!/bin/bash

echo "==> Starting installation of custom package local/bear-claw"
cd /workspace/packages/cartoon
composer install
composer dump-autoload


echo "==> Running code analysis for local/bear-claw"
./vendor/bin/phpstan analyse -l 5 src tests

echo "==> Running unit tests for local/bear-claw"
./vendor/bin/phpunit tests

echo "==> Starting intallation of Laravel test-app"
cd /workspace/test-app
composer install
php artisan clear-compiled 
composer dump-autoload
php artisan optimize

echo "==> Setting database of Laravel test-app"
php artisan db:create
php artisan migrate
php artisan db:seed --class=UserSeeder

echo "==> Starting wewbserver of Laravel test-app"
php artisan serve