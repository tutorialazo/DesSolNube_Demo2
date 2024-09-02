FROM php:8.1-apache

# Instalar dependencias necesarias para PostgreSQL y Composer
RUN apt-get update && apt-get install -y \
    libpq-dev \
    unzip \
    git \
    && docker-php-ext-install pdo pgsql pdo_pgsql \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copiar el archivo composer.json y composer.lock para instalar dependencias
COPY composer.json composer.lock /var/www/html/

# Instalar dependencias de PHP (PhpSpreadsheet, FPDF, etc.)
RUN composer install --no-scripts --no-autoloader

# Copiar el resto de la aplicación al contenedor
COPY . /var/www/html/

# Ejecutar Composer autoload
RUN composer dump-autoload --optimize

# Cambiar permisos de los archivos si es necesario (opcional)
RUN chown -R www-data:www-data /var/www/html

# Expone el puerto 80
EXPOSE 80

# Iniciar Apache
CMD ["apache2-foreground"]
