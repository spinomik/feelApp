FROM php:8.2-cli

# Instalacja zależności
RUN apt-get update && apt-get install -y \
    git unzip zip libzip-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql zip

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Kopiowanie aplikacji 
COPY . /var/www/html

WORKDIR /var/www/html

COPY composer.json composer.lock ./
RUN composer install