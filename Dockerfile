# Usa imagen oficial PHP con Apache
FROM php:8.2-apache

# Instala dependencias del sistema y extensiones de PHP
RUN apt-get update && apt-get install -y \
    unzip \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql pdo_mysql mbstring exif pcntl bcmath gd \
    && a2enmod rewrite

# Copia solo archivos de Composer primero
WORKDIR /var/www/html
COPY composer.json composer.lock ./

# Ejecuta Composer sin dev y con optimización
# Forzando memoria ilimitada y emulated prepares
RUN php -d memory_limit=-1 /usr/bin/composer install --no-dev --optimize-autoloader --prefer-dist

# Copia el resto del proyecto
COPY . /var/www/html

# Configura permisos
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage \
    && chmod -R 755 /var/www/html/bootstrap/cache

# Expone el puerto 80
EXPOSE 80

# Apache ya se inicia automáticamente en php:8.2-apache
CMD ["apache2-foreground"]