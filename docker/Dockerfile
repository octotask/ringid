# Placeholder Dockerfile for project-root/docker
FROM php:7.4-apache

# Install dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Copy existing application directory contents
COPY . /var/www/html

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Set recommended permissions
RUN chown -R www-data:www-data /var/www/html

# Expose port 80
EXPOSE 80
