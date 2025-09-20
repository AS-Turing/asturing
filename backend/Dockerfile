FROM php:8.3-apache

WORKDIR /app

# Install needed packages and PHP extensions
RUN apt-get update \
    && apt-get install -y git unzip zip libpq-dev libonig-dev libxml2-dev libzip-dev \
    && docker-php-ext-install pdo pdo_mysql zip

# Enable Apache rewrite and configure virtual host
RUN a2enmod rewrite && \
    sed -i 's!/var/www/html!/app/public!g' /etc/apache2/sites-available/000-default.conf \
    && sed -i 's!AllowOverride None!AllowOverride All!g' /etc/apache2/apache2.conf \
    && echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Autoriser Apache à accéder au DocumentRoot
RUN printf "\n<Directory /app/public>\n\
    Options Indexes FollowSymLinks\n\
    AllowOverride All\n\
    Require all granted\n\
</Directory>\n" | tee -a /etc/apache2/apache2.conf

# Install Composer (séparé de l'opération précédente)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory and copy app code
COPY . .

# autorise composer à tourner en root (build)
ENV COMPOSER_ALLOW_SUPERUSER=1

# Install PHP dependencies
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Fix permissions (at build time only)
RUN chown -R www-data:www-data /app

# Configuration pour permettre l'utilisation de .htaccess
RUN sed -i 's!/var/www/html!/app/api/public!g' /etc/apache2/sites-available/000-default.conf  \
    && sed -i 's!AllowOverride None!AllowOverride All!g' /etc/apache2/apache2.conf

# Use www-data user to run the container
USER www-data

EXPOSE 8000
CMD ["apache2-foreground"]
