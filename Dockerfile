# Use an official PHP image with required extensions
FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    curl zip unzip git \
    libpq-dev libpng-dev libjpeg-dev libfreetype6-dev \
    && docker-php-ext-install pdo_mysql gd

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy Laravel files
COPY . .

# Ensure .env file exists
RUN cp .env.example .env  # This step copies .env.example to .env during the build process

# Set permissions for storage and cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Install dependencies
RUN composer install --no-dev --optimize-autoloader

# Generate the app key
RUN php artisan key:generate

# Expose the application port
EXPOSE 8000

# Start Laravel using PHP’s built-in server
CMD php artisan serve --host=0.0.0.0 --port=8000
