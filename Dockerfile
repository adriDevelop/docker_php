FROM php:8.3-apache

# Actualizar paquetes e instalar dependencias necesarias
RUN apt-get update && apt-get install -y libpq-dev

# Copiar archivos de configuración de Virtual Hosts
COPY ./vhosts/* /etc/apache2/sites-available/

# Instalar extensiones de PHP necesarias
RUN docker-php-ext-install mysqli pdo_mysql pgsql pdo_pgsql

# Instalar y habilitar Xdebug
RUN pecl install xdebug && docker-php-ext-enable xdebug

# Instalación de Redis
RUN pecl install redis

# Habilito redis
docker-php-ext-enable redis

# Habilitar mod_rewrite
RUN a2enmod rewrite

# Habilitar sitios de Apache
RUN a2ensite dwes.conf && a2ensite examen.conf

# Exponer los puertos necesarios
EXPOSE 80
EXPOSE 9003

