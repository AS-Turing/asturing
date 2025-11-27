# ================================
# Production Dockerfile - Symfony
# Optimized for production
# ================================

FROM php:8.3-apache

WORKDIR /app

# Install system dependencies and PHP extensions
RUN apt-get update && \
    apt-get install -y \
        git \
        unzip \
        zip \
        libpq-dev \
        libonig-dev \
        libxml2-dev \
        libzip-dev && \
    docker-php-ext-install pdo pdo_mysql zip && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy dependency files
COPY composer.json composer.lock ./

# Install PHP dependencies (production)
RUN composer install \
    --no-dev \
    --no-interaction \
    --no-scripts \
    --prefer-dist \
    --optimize-autoloader

# Copy application code
COPY . .

# Create minimal .env file for production (Symfony needs it to exist)
RUN echo "APP_ENV=prod" > /app/.env && \
    echo "APP_DEBUG=0" >> /app/.env

# Run post-install scripts
RUN composer dump-autoload --optimize --no-dev --classmap-authoritative

# Configure Apache
RUN a2enmod rewrite && \
    sed -i 's!/var/www/html!/app/public!g' /etc/apache2/sites-available/000-default.conf && \
    sed -i 's!AllowOverride None!AllowOverride All!g' /etc/apache2/apache2.conf && \
    echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Set directory permissions
RUN printf "\n<Directory /app/public>\n\
    Options Indexes FollowSymLinks\n\
    AllowOverride All\n\
    Require all granted\n\
</Directory>\n" | tee -a /etc/apache2/apache2.conf

# Create var directory if it doesn't exist and fix permissions
RUN mkdir -p /app/var && \
    chown -R www-data:www-data /app && \
    chmod -R 755 /app/var

# Switch to www-data user
USER www-data

EXPOSE 80

# Health check
HEALTHCHECK --interval=30s --timeout=10s --start-period=40s --retries=3 \
  CMD curl -f http://localhost/api/health || exit 1

CMD ["apache2-foreground"]
