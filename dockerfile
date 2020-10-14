FROM php:7.4-fpm

RUN docker-php-ext-install mysqli
COPY ./sitepages/ /var/www/html/


CMD ["php-fpm"]

EXPOSE 9000