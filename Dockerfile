FROM php:8.2-cli

# Install dependencies and PHP extensions (including SQLite)
RUN apt-get update && apt-get install -y \
    libpng-dev libjpeg-dev libfreetype6-dev zip unzip git sqlite3 libsqlite3-dev \
    && docker-php-ext-install pdo pdo_mysql pdo_sqlite

WORKDIR /var/www

COPY . .

# Copy .env.example to .env
RUN cp .env.example .env

# Create SQLite database file as fallback
RUN touch database/database.sqlite

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install --no-dev --optimize-autoloader

# Generate Encryption Key
RUN php artisan key:generate

# Storage link and full permissions
RUN php artisan storage:link || true
RUN chmod -R 777 storage bootstrap/cache database/database.sqlite

# Enable SQLite in .env for instant out-of-the-box working
RUN sed -i 's/DB_CONNECTION=.*/DB_CONNECTION=sqlite/' .env

EXPOSE 8000

CMD php artisan migrate --force && php artisan db:seed --force && php artisan serve --host 0.0.0.0 --port ${PORT:-8000}
