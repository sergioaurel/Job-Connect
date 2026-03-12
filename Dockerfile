FROM php:8.4-apache

RUN apt-get update && apt-get install -y \
    git unzip libzip-dev libonig-dev libpng-dev libicu-dev \
    && docker-php-ext-install pdo_mysql mbstring zip gd intl opcache

RUN a2enmod rewrite

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

RUN composer install --optimize-autoloader --no-dev

RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|g' \
    /etc/apache2/sites-available/000-default.conf

RUN sed -i 's|AllowOverride None|AllowOverride All|g' \
    /etc/apache2/apache2.conf

EXPOSE 80

COPY ca.pem /etc/ssl/certs/aiven-ca.pem
CMD bash -c "php artisan config:cache && php artisan route:cache && php artisan migrate --force && apache2-foreground"

