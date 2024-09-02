FROM php:8.1-apache

# Instalar dependencias necesarias para PostgreSQL
RUN apt-get update && apt-get install -y \
    libpq-dev \
    git \
    unzip \
    && docker-php-ext-install pdo pgsql pdo_pgsql

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copiar el contenido de la aplicación al contenedor
COPY . /var/www/html/

# Instalar las dependencias PHP (PhpSpreadsheet y FPDF)
RUN composer require phpoffice/phpspreadsheet
RUN composer require fpdf/fpdf

# Exponer el puerto 80
EXPOSE 80
