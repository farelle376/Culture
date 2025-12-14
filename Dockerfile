# Base image PHP avec Apache
FROM php:8.2-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
    zip unzip git curl libpng-dev libonig-dev libxml2-dev \
    libzip-dev && \
    apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy application
COPY . .

# Configurer Apache pour pointer vers /public
RUN sed -i 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf
RUN sed -i 's!/var/www!/var/www/html/public!g' /etc/apache2/apache2.conf

# Install dependencies
RUN composer install --no-dev --optimize-autoloader

# Créer .env et générer la clé
RUN if [ ! -f .env ]; then cp .env.example .env; fi && \
    php artisan key:generate --force || \
    echo "APP_KEY=base64:$(head -c 32 /dev/urandom | base64)" >> .env

# Permissions
RUN chown -R www-data:www-data storage bootstrap/cache public
RUN chmod -R 775 storage bootstrap/cache

# Expose port
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]