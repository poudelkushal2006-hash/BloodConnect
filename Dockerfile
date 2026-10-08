FROM php:8.2-apache

# Install MySQL PDO driver
RUN docker-php-ext-install pdo pdo_mysql

# Enable Apache rewrite
RUN a2enmod rewrite

# Copy project files
COPY . /var/www/html/

# Set public as Apache document root
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' \
    /etc/apache2/sites-available/000-default.conf

# Railway uses the PORT environment variable
RUN printf '#!/bin/bash\nsed -i "s/Listen 80/Listen ${PORT:-80}/" /etc/apache2/ports.conf\nsed -i "s/<VirtualHost \\*:80>/<VirtualHost *:${PORT:-80}>/" /etc/apache2/sites-available/000-default.conf\napache2-foreground\n' > /usr/local/bin/start-railway.sh \
    && chmod +x /usr/local/bin/start-railway.sh

EXPOSE 80

CMD ["/usr/local/bin/start-railway.sh"]