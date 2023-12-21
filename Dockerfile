# Utilisez l'image officielle PHP avec Apache
FROM php:8.2.4-apache

# Installation des dépendances nécessaires pour Laravel et Composer
RUN apt-get update && \
    apt-get install -y --no-install-recommends \
        libzip-dev zip unzip git libfreetype6-dev libjpeg62-turbo-dev libpng-dev && \
    docker-php-ext-install pdo_mysql gd zip

# Installer Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer


# Définissez le répertoire de travail dans le conteneur
WORKDIR /var/www/html

# Installez les dépendances nécessaires (par exemple, le support MySQL)
RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip

# Installer nano
RUN apt-get update && \
    apt-get install -y nano && \
    rm -rf /var/lib/apt/lists/*

# Installez les extensions PHP nécessaires
RUN docker-php-ext-install zip pdo_mysql

# Copiez les fichiers de votre application dans le conteneur
COPY . /var/www/html/


RUN composer install --no-scripts --no-autoloader && \
    composer dump-autoload
# Ajustez les autorisations
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap

# Activez le module Apache mod_rewrite
RUN a2enmod rewrite

# Exposer le port 80 pour le serveur web
EXPOSE 80

# Exécuter l'application Laravel
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=80"]

