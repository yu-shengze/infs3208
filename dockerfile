FROM php:7.4-fpm

RUN docker-php-ext-install mysqli
RUN docker-php-ext-enable mysqli
COPY ./sitepages/ /var/www/html/


CMD ["php-fpm"]

EXPOSE 9000