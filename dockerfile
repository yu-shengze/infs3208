FROM php:7.4-fpm

RUN docker-php-ext-install mysqli &
COPY ./sitepages/ /var/www/html/
COPY ./phpconf/ /etc/php/7.4/fpm/
COPY ./wwwconf/ /etc/php/7.4/fpm/pool.d/
COPY ./phpini/ /usr/local/etc/php/

CMD ["php-fpm"]

EXPOSE 9000