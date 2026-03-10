FROM php:8.4-apache

# 1. Instalar dependencias del sistema
RUN apt-get update && apt-get install -y \
    unzip \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql pdo_mysql mbstring exif pcntl bcmath gd

# 2. Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 3. Directorio de trabajo
WORKDIR /var/www/html

# 4. Copiar composer
COPY composer.json composer.lock ./

# 5. Instalar dependencias
RUN composer install --no-dev --optimize-autoloader --no-interaction --no-scripts

# 6. Copiar el resto del proyecto
COPY . .

# 7. Permisos
RUN chown -R www-www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage \
    && chmod -R 775 /var/www/html/bootstrap/cache

# 8. Habilitar mod_rewrite
RUN a2enmod rewrite

EXPOSE 80

# Define el comando de inicio
CMD ["php", "-S", "0.0.0.0:80", "-t", "public"]