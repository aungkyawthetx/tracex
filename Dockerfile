FROM php:8.2-apache

# Enable Apache rewrite module
RUN a2enmod rewrite

# Install useful PHP extensions (common for apps)
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Copy project into Apache web root
COPY . /var/www/html/

# Set correct permissions
RUN chown -R www-data:www-data /var/www/html

WORKDIR /var/www/html
