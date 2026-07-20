FROM php:8.3-apache

RUN apt-get update && apt-get install -y \
    unzip git libzip-dev \
    && docker-php-ext-install mysqli pdo pdo_mysql zip

COPY . /var/www/html/

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

RUN cd /var/www/html && composer install --no-dev --optimize-autoloader

RUN a2enmod rewrite

EXPOSE 80
# Cấp quyền sở hữu thư mục web cho user www-data của Apache
RUN chown -R www-data:www-data /var/www/html

