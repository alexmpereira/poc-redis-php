FROM php:8.2-apache

# Instala a extensão phpredis
RUN pecl install redis && docker-php-ext-enable redis

WORKDIR /var/www/html