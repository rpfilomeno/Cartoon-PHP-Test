#!/bin/bash

echo "╔═════════════════════════════════════════════════════════╗"
echo "║ Starting installation of custom package local/bear-claw ║"
echo "╚═════════════════════════════════════════════════════════╝"
cd /workspace/packages/cartoon
composer install
composer dump-autoload

echo "╔═════════════════════════════════════════════════════════╗"
echo "║ Running code analysis for local/bear-claw               ║"
echo "╚═════════════════════════════════════════════════════════╝"
./vendor/bin/phpstan analyse -l 5 src tests

echo "╔═════════════════════════════════════════════════════════╗"
echo "║ Running unit tests for local/bear-claw"                 ║
echo "╚═════════════════════════════════════════════════════════╝"
./vendor/bin/phpunit --testdox tests

echo "╔═════════════════════════════════════════════════════════╗"
echo "║ Starting intallation of Laravel test-app                ║"
echo "╚═════════════════════════════════════════════════════════╝"
cd /workspace/test-app
composer install
php artisan clear-compiled 
composer dump-autoload
php artisan optimize

echo "╔═════════════════════════════════════════════════════════╗"
echo "║ Setting database of Laravel test-app                    ║"
echo "╚═════════════════════════════════════════════════════════╝"
php artisan db:create
php artisan migrate
php artisan db:seed --class=UserSeeder

echo "╔═════════════════════════════════════════════════════════╗"
echo "║ Running unit tests for Laravel test-app                 ║"
echo "╚═════════════════════════════════════════════════════════╝"
./vendor/bin/phpunit --testdox tests


echo "╔═════════════════════════════════════════════════════════╗"
echo "║ Starting wewbserver of Laravel test-app                 ║"
echo "║ Press CRTL+C to stop                                    ║"
echo "╚═════════════════════════════════════════════════════════╝"
php artisan serve