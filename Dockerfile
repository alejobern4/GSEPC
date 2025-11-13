# Imagen base con PHP 8.2 y Apache
FROM php:8.2-apache

# Variables de entorno necesarias
ENV COMPOSER_ALLOW_SUPERUSER=1

# Directorio de trabajo dentro del contenedor
WORKDIR /var/www/html

# Instalar dependencias necesarias
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    libonig-dev \
    npm \
    nodejs \
    curl \
    libpq-dev \
    && docker-php-ext-install zip pdo pdo_mysql mbstring pdo_pgsql


# Instalar Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copiar todo el proyecto al contenedor
COPY . .

# Instalar dependencias de PHP
RUN composer install --no-interaction --optimize-autoloader

# Instalar dependencias de Node y compilar assets
RUN npm install
RUN npm run build

# Exponer el puerto que usa Laravel
EXPOSE 8000

# Comando para iniciar Laravel
CMD ["php", "artisan", "serve", "--host", "0.0.0.0", "--port", "8000"]
