FROM php:8.2-apache

# Habilitar módulos necesarios (opcional)
RUN docker-php-ext-install mysqli pdo pdo_mysql
RUN a2enmod rewrite

# Copiar o código fonte
COPY www/ /var/www/html/
