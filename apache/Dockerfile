FROM php:8.2-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    git \
    curl \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
        gd \
        mysqli \
        pdo \
        pdo_mysql \
        mbstring \
        xml \
        zip \
        opcache

# Enable Apache modules
RUN a2enmod rewrite ssl headers

# Copy custom Apache configuration
COPY apache2.conf /etc/apache2/apache2.conf
COPY sites-available/ /etc/apache2/sites-available/

# Enable the site
RUN a2ensite 000-default

# Set working directory
WORKDIR /var/www/html

# Expose ports
EXPOSE 80 443