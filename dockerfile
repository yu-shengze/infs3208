FROM php:7.4-fpm

RUN docker-php-ext-install mysqli &
COPY ./sitepages/ /var/www/html/
COPY ./phpini/ /usr/local/etc/php/

CMD ["php-fpm"]

EXPOSE 9000