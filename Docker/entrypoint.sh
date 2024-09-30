#!/bin/bash

if [ ! -f "vendor/autoload.php" ]; then
    echo "installing composer"
    composer install --optimize-autoloader --no-progress --no-interaction
else
    echo "composer already installed"
fi

if [ ! -f ".env" ]; then
    echo "Creating env file for env $APP_ENV"
    cp .env.example .env
else
    echo "env file exists."
fi
    

php artisan key:generate
php artisan migrate --seed
php artisan cache:clear
php artisan config:clear
php artisan route:clear

php artisan serve --port=$PORT --host=0.0.0.0 --env=.env
exec docker-php-entrypoint "$@"