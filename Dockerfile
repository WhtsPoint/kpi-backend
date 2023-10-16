FROM php:8.1-fpm

RUN apt-get update && apt-get install -y --no-install-recommends \
    git \
    zlib1g-dev \
    libxml2-dev \
    libpng-dev \
    libzip-dev \
    vim curl debconf subversion git apt-transport-https apt-utils \
    build-essential locales acl mailutils wget nodejs zip unzip \
    gnupg gnupg1 gnupg2  \
    sudo  \
    ssh  \
    && docker-php-ext-install pdo_mysql soap zip opcache gd intl

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

RUN chown www-data:www-data /var/www
COPY --chown=www-data:www-data ./ /var/www/app

WORKDIR /var/www/app

RUN composer i --no-dev --no-interaction --no-progress --no-scripts --optimize-autoloader

CMD ["php-fpm"]