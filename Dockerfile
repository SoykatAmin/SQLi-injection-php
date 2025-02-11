#Get apache php
FROM php:8.2-apache

#Enable Apache modules
RUN a2enmod 

#Install postgre + php
RUN apt-get update \
    && apt-get install -y libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql

RUN echo "ServerName 0.0.0.0" >> /etc/apache2/apache2.conf

#Copy the PHP code file in /app into the container at /var/www/html
COPY ./src /var/www/html

COPY init.sql /docker-entrypoint-initdb.d/