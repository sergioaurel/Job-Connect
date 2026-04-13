FROM php:8.4-apache

RUN apt-get update && apt-get install -y \
    git unzip libzip-dev libonig-dev libpng-dev libicu-dev curl ca-certificates \
    && docker-php-ext-install pdo_mysql mbstring zip gd intl opcache

RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

RUN a2enmod rewrite

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

RUN composer install --optimize-autoloader --no-dev

RUN node --version && npm --version

RUN npm install --include=dev && npm run build

RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|g' \
    /etc/apache2/sites-available/000-default.conf

RUN sed -i 's|AllowOverride None|AllowOverride All|g' \
    /etc/apache2/apache2.conf

EXPOSE 80

CMD bash -c "php artisan config:cache && php artisan route:cache && php artisan migrate --force && apache2-foreground"
