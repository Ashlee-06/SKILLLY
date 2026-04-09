#!/bin/sh

PORT=${PORT:-8000}

echo "==> Using PORT: $PORT"

# Remove old listen line and replace cleanly
sed -i "s/listen [0-9]*;/listen ${PORT};/" /etc/nginx/sites-available/default

echo "==> Nginx listen config:"
grep "listen" /etc/nginx/sites-available/default

php artisan config:clear
php artisan migrate --force
php artisan db:seed --force
php artisan config:cache
php artisan storage:link
php artisan tinker --execute="App\Models\User::where('email','ashy06tv@gmail.com')->update(['is_admin'=>1]);"

echo "==> Starting nginx..."
service nginx start

echo "==> Starting php-fpm..."
php-fpm