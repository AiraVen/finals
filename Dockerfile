# Use the official PHP image with Apache
FROM php:8.0-apache

# Install necessary system dependencies for PostgreSQL
RUN apt-get update && apt-get install -y \
    libpq-dev \
    && docker-php-ext-install pdo_pgsql pgsql

# Enable Apache's mod_rewrite
RUN a2enmod rewrite

# Copy the custom Apache configuration file
COPY apache-config.conf /etc/apache2/conf-available/servername.conf

# Enable the custom servername configuration
RUN a2enconf servername

# Copy your project files to the Apache server's root
COPY . /var/www/html/

# Expose port 80 to the outside world
EXPOSE 80
