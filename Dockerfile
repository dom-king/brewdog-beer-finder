# Stage 1: Build the Vue.js frontend
FROM node:14 as frontend

WORKDIR /app

COPY package*.json ./
RUN npm install
COPY . .
RUN npm run build

# Stage 2: Build the Laravel backend
FROM php:8.2-apache

WORKDIR /var/www/html

# Copy Laravel files
COPY . .

# Copy custom Apache configuration
COPY .docker/apache.conf /etc/apache2/sites-available/apache.conf

# Install dependencies
RUN apt-get update \
    && apt-get install -y libzip-dev zip \
    && docker-php-ext-install pdo_mysql zip

# Enable Apache modules
RUN a2enmod rewrite
RUN a2enmod ssl

# Adjust ownership
RUN chmod -R 755 storage bootstrap/cache
RUN chown -R www-data:www-data /var/www/html

# Enable the custom Apache configuration
RUN a2ensite apache.conf

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install Laravel Sanctum and other dependencies
RUN composer install --no-interaction --verbose

# Copy Vite build files from the first stage
COPY --from=frontend /app/public/build/ /var/www/html/public/build/

CMD ["apache2-foreground"]
