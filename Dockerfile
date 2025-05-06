# Dockerfile for ringid admin backend (CodeIgniter)
FROM php:8.1-apache

# Copy admin backend code
COPY admin/ /var/www/html/

# Install required PHP extensions
RUN docker-php-ext-install mysqli

# Enable Apache mod_rewrite (for CodeIgniter)
RUN a2enmod rewrite

# Set recommended permissions
RUN chown -R www-data:www-data /var/www/html

# Expose web server port
EXPOSE 80

# Use the default Apache start command
CMD ["apache2-foreground"]
