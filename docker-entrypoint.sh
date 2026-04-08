#!/bin/sh

# Use Railway's dynamic PORT (defaults to 80 locally)
PORT=${PORT:-80}

# Inject the port into nginx config
sed -i "s/listen 80;/listen ${PORT};/" /etc/nginx/sites-available/default

# Run Laravel setup commands
php artisan config:clear
php artisan config:cache
php artisan migrate --force
php artisan storage:link

# Start nginx in background, then php-fpm in foreground
service nginx start
php-fpm