FROM php:8.2-cli

# Install dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    libpng-dev libjpeg-dev libfreetype6-dev zip unzip git \
    && docker-php-ext-install pdo pdo_mysql

WORKDIR /var/www

COPY . .

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install --no-dev --optimize-autoloader

# Storage link and permissions
RUN php artisan storage:link || true
RUN chmod -R 777 storage bootstrap/cache

EXPOSE 8000

CMD php artisan serve --host 0.0.0.0 --port ${PORT:-8000}
