#!/bin/bash
path=`pwd`
echo "App path: $path"
cp ./.env.example ./.env
echo "make .env success"
#rm -rf storage/framework
cd storage && mkdir framework && cd framework && mkdir views sessions cache
echo "make storage framework success"
cd "$path"
composer install
php artisan vendor:publish --all
php artisan key:generate
php artisan migrate
cd public && rm storage
cd "$path"
php artisan storage:link
chmod -R o+w storage/
php artisan passport:keys
echo "End deploy or begin write code ^^"
