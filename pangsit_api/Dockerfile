FROM php:8.1-apache
RUN docker-php-ext-install mysqli
COPY . /var/www/html/
RUN echo "ServerName localhost" >> /etc/apache2/conf-available/servername.conf \
    && a2enconf servername
EXPOSE 80
