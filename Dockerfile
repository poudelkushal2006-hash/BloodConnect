FROM php:8.2-cli

# Install PDO MySQL
RUN docker-php-ext-install pdo pdo_mysql

# Copy BloodConnect project
COPY . /var/www/html/

# Start PHP server using Railway's PORT
CMD ["sh", "-c", "php -S 0.0.0.0:${PORT:-8080} -t /var/www/html/public"]