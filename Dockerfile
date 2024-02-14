# Utilizo la imagen oficial de PHP como base
FROM php:8.2-apache

# Dependencias Laravel
RUN apt-get update \
    && apt-get install -y \
        libzip-dev \
        zip \
        unzip \
        git \
    && docker-php-ext-install zip \
    && a2enmod rewrite

# Copio los archivos del proyecto al contenedor
COPY . /var/www/html/

WORKDIR /var/www/html

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Instalo las dependencias de PHP
RUN composer install

# Establezco los permisos adecuados en el directorio de almacenamiento
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

RUN php artisan migrate --force && php artisan passport:install --force

EXPOSE 80

CMD ["apache2-foreground"]
