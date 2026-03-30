# Dockerfile para Laravel con PHP 8.2 y Node
# Basado en tus logs necesitábamos obligar PHP 8.2 y paquete compatibles
FROM php:8.2-fpm-bullseye

# install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    nodejs \
    npm \
 && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd zip

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copiamos y instalamos composer primero para cachear capas
COPY composer.json composer.lock ./
RUN composer install --no-interaction --prefer-dist --optimize-autoloader --no-dev

# Copiamos el resto del proyecto
COPY . .

# npm/laravel assets
RUN npm ci --silent && npm run build --silent

# Generar caches de laravel
RUN php artisan config:cache && php artisan route:cache && php artisan view:cache

# Permisos
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 9000
CMD ["php-fpm"]
