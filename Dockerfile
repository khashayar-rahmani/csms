# Set master image
FROM php:8.0-fpm

# Set working directory
WORKDIR /var/www/

# Install Additional dependencies
RUN apt-get update && apt-get install -y \
    build-essential

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Add user for laravel
RUN usermod -u 1000 www-data

# Copy application folder
COPY . /var/www

# Creating .env file
COPY .env.example .env

# Copy existing application directory permissions
COPY --chown=www-data:www-data . /var/www

# Change current user to www
USER www-data

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]
