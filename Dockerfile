FROM php:8.5-fpm

# (Conserva todo tu bloque de apt-get e instalación de extensiones idéntico...)
RUN apt-get update && apt-get upgrade -y && apt-get install -y \
    git curl libpng-dev libwebp-dev libjpeg62-turbo-dev libfreetype6-dev \
    libonig-dev libxml2-dev libzip-dev libicu-dev zip unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip intl \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

RUN useradd -G www-data -u 1000 -d /home/laravel -m laravel \
    && mkdir -p storage bootstrap/cache \
    && chown -R laravel:www-data /var/www \
    && chmod -R 775 storage bootstrap/cache

COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

USER laravel

ENTRYPOINT ["entrypoint.sh"]
CMD ["php-fpm"]
