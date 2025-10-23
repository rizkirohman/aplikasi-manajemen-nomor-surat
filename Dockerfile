# Gunakan PHP 8.2 dengan Apache
FROM php:8.2-apache

# Install dependency dasar
RUN apt-get update && apt-get install -y \
    git unzip libicu-dev libzip-dev zip \
    && docker-php-ext-install intl pdo pdo_mysql zip opcache

# Install Composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# Salin seluruh file project ke container
COPY . /var/www/html

# Set working directory
WORKDIR /var/www/html

# Install dependency Laravel
RUN composer install --no-dev --optimize-autoloader

# Jalankan permission storage & cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Expose port 8000
EXPOSE 8000

# Jalankan Laravel
CMD php artisan serve --host=0.0.0.0 --port=8080