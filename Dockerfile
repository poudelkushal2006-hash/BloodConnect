FROM php:8.2-apache

# Install PDO MySQL
RUN docker-php-ext-install pdo pdo_mysql

# Enable URL rewriting
RUN a2enmod rewrite

# Copy project
COPY . /var/www/html/

# Make public/ the Apache document root
RUN sed -i 's#DocumentRoot /var/www/html#DocumentRoot /var/www/html/public#' \
    /etc/apache2/sites-available/000-default.conf

RUN sed -i 's#<Directory /var/www/>#<Directory /var/www/html/public/>#' \
    /etc/apache2/apache2.conf

EXPOSE 80

CMD ["apache2-foreground"]