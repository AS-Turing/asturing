# Dockerfile pour Symfony 8
FROM php:8.4-apache

# Installer les extensions PHP nécessaires
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    libicu-dev \
    libpq-dev \
    && docker-php-ext-install \
    intl \
    pdo \
    pdo_mysql \
    opcache

# Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Configurer Apache
RUN a2enmod rewrite
RUN sed -i 's!/var/www/html!/app/public!g' /etc/apache2/sites-available/000-default.conf

# Configuration Apache pour Symfony
RUN echo '<Directory /app/public>\n\
    Options Indexes FollowSymLinks\n\
    AllowOverride All\n\
    Require all granted\n\
</Directory>' >> /etc/apache2/sites-available/000-default.conf

WORKDIR /app

# Copier les fichiers de dépendances
COPY composer.json composer.lock ./

# Installer les dépendances en dev
RUN composer install --no-scripts --no-autoloader

# Copier le reste du code
COPY . .

# Générer l'autoloader optimisé
RUN composer dump-autoload --optimize

# Permissions
RUN mkdir -p var/cache var/log && \
    chown -R www-data:www-data /app && \
    chmod -R 755 var

EXPOSE 80

CMD ["apache2-foreground"]
