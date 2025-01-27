#!/usr/bin/env bash
set -o errexit  # Exit on error

# Install PHP and required extensions
apt-get update && apt-get install -y \
    php-cli php-mbstring php-xml php-bcmath php-zip unzip curl \
    php-curl php-tokenizer php-mysql git

# Install Composer
curl -sS https://getcomposer.org/installer | php
mv composer.phar /usr/local/bin/composer

# Install dependencies
composer install --no-dev --optimize-autoloader

# Set application key
php artisan key:generate

# Run migrations
php artisan migrate --force
