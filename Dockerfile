FROM php:8.1-fpm

RUN apt-get update && apt-get install -y --no-install-recommends \
    curl git wget zip unzip libzip-dev libxml2-dev libpng-dev \
    && docker-php-ext-install pdo_mysql soap zip opcache gd intl

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

RUN chown www-data:www-data /var/www
COPY --chown=www-data:www-data ./ /var/www/app

WORKDIR /var/www/app

RUN composer i --no-dev --no-interaction --no-progress --no-scripts --optimize-autoloader
