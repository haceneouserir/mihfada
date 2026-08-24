# Use the official PHP image with Apache
FROM php:8.5-apache
# Install system packages and PHP extensions
RUN apt-get update && apt-get install -y \
    unzip \
    libzip-dev \
    && docker-php-ext-install zip \
    && rm -rf /var/lib/apt/lists/*
# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
# Enable Apache modules required by your .htaccess
RUN a2enmod \
    rewrite \
    headers \
    mime \
    deflate
# Set the working directory
WORKDIR /var/www/html
# Copy Composer files first for Docker layer caching
COPY composer.json composer.lock ./
# Install production PHP dependencies
RUN composer install \
    --no-dev \
    --optimize-autoloader \
    --no-interaction \
    --prefer-dist
# Copy the rest of the application
COPY . .
# Set ownership
RUN chown -R www-data:www-data /var/www/html
# Apache listens on port 80
EXPOSE 80
