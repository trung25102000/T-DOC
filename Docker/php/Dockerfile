FROM php:8.4-fpm

#working directory
WORKDIR /var/www/html

# Install dependencies
RUN apt-get update && apt-get install -y \
    libpq-dev \
    libzip-dev \
    bash \
    && docker-php-ext-install pdo_mysql pdo_pgsql zip \
    && docker-php-ext-enable pdo_mysql pdo_pgsql zip \
    && rm -rf /var/lib/apt/lists/*

# Expose PHP-FPM port
EXPOSE 9000

CMD ["php-fpm"]
