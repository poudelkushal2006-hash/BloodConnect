FROM php:8.2-apache

RUN docker-php-ext-install pdo pdo_mysql

RUN a2dismod mpm_event || true
RUN a2dismod mpm_worker || true
RUN a2dismod mpm_prefork || true
RUN a2enmod mpm_prefork
RUN a2enmod rewrite

COPY . /var/www/html/

ENV APACHE_DOCUMENT_ROOT=/var/www/html/public

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' \
    /etc/apache2/sites-available/000-default.conf

EXPOSE 80