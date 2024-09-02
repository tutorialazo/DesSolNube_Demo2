FROM php:8.1-apache

# Instalar dependencias necesarias para PostgreSQL, herramientas y libxml2
RUN apt-get update && apt-get install -y \
    libpq-dev \
    libxml2-dev \
    unzip \
    git \
    && docker-php-ext-install pdo pgsql pdo_pgsql \
    && docker-php-ext-install xml

# Instalar las bibliotecas FPDF y PhpSpreadsheet
RUN mkdir -p /usr/src/php/libraries \
    && cd /usr/src/php/libraries \
    && curl -o PhpSpreadsheet.zip -L https://github.com/PHPOffice/PhpSpreadsheet/archive/refs/heads/master.zip \
    && unzip PhpSpreadsheet.zip \
    && rm PhpSpreadsheet.zip \
    && mv PhpSpreadsheet-* PhpSpreadsheet \
    && curl -o FPDF.zip -L https://github.com/Setasign/FPDF/archive/refs/heads/master.zip \
    && unzip FPDF.zip \
    && rm FPDF.zip \
    && mv FPDF-* FPDF

# Copiar contenido de toda la app en el contenedor
COPY . /var/www/html/

# Configurar autoload en el index.php de tu aplicación
RUN echo "<?php\nrequire '/usr/src/php/libraries/PhpSpreadsheet/vendor/autoload.php';\nrequire '/usr/src/php/libraries/FPDF/fpdf.php';\n" >> /var/www/html/index.php

# Exponer el puerto 80
EXPOSE 80
