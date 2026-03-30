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
 && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd zip

# Install Node.js 20.x via NodeSource (ES2020 compatible)
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
 && apt-get install -y nodejs

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copiamos sólo archivos esenciales para composer antes para cachear capas
COPY composer.json composer.lock artisan ./

# Instalar dependencias sin ejecutar scripts (que dependen de artisan aún no copiado completamente)
RUN composer install --no-interaction --prefer-dist --optimize-autoloader --no-dev --no-scripts

# Copiamos el resto del proyecto
COPY . .

# Ejecutamos scripts ahora que todo el proyecto está presente
RUN composer run-script post-autoload-dump || true
# npm/laravel assets (fall back to npm install cuando no hay package-lock.json)
RUN if [ -f package-lock.json ]; then npm ci --silent; else npm install --silent; fi \
 && npm run build --silent

# Generar caches de laravel
RUN php artisan config:cache && php artisan route:cache && php artisan view:cache

# Permisos
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 9000
CMD ["php-fpm"]
