FROM php:8.1-apache

# Instalar dependencias necesarias para PostgreSQL, herramientas, libxml2 y Composer
RUN apt-get update && apt-get install -y \
    libpq-dev \
    libxml2-dev \
    unzip \
    git \
    && docker-php-ext-install pdo pgsql pdo_pgsql \
    && docker-php-ext-install xml \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copiar el archivo de configuración de Composer y ejecutar la instalación de dependencias
COPY composer.json composer.lock /var/www/html/
RUN cd /var/www/html && composer install

# Copiar el resto del contenido de la aplicación en el contenedor
COPY . /var/www/html/

# Configurar autoload en el index.php de tu aplicación
RUN echo "<?php\nrequire '/var/www/html/vendor/autoload.php';\nrequire '/usr/src/php/libraries/FPDF/fpdf.php';\n" >> /var/www/html/index.php

# Exponer el puerto 80
EXPOSE 80
