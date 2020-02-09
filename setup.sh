#!/bin/bash
php composer.phar install --no-scripts;
mkdir bootstrap/cache;
php composer.phar install;
php artisan migrate;
php artisan db:seed;
php artisan key:generate;
php artisan config:cache;
php artisan config:clear;
git submodule update --init --recursive
cd laradock || exit; cp env-example .env
docker-compose down
docker-compose up -d nginx mysql