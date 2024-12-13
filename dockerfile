# Use PHP with Apache as the base image
FROM php:8.3-apache AS web

# Install Additional System Dependencies
RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip

RUN apt-get clean && rm -rf /var/lib/apt/lists/*

RUN a2enmod rewrite

RUN docker-php-ext-install pdo_mysql zip

ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Copy the application code
COPY . /var/www/html

WORKDIR /var/www/html

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN composer update

RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
# CMD ["/bin/sh", "-c", "php artisan migrate"]
