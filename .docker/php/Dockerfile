FROM php:8.3-apache

RUN apt-get update && apt-get install -y \
    && docker-php-ext-install mysqli pdo pdo_mysql


RUN chown -R www-data:www-data /var/www/html

EXPOSE 80
