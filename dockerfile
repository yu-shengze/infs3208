FROM php:7.4-fpm

RUN docker-php-ext-install mysqli &
COPY ./phpconf/php-fpm.conf /etc/php/7.4/fpm/php-fpm.conf
COPY ./wwwconf/www.conf /etc/php/7.4/fpm/pool.d/www.conf

CMD ["php-fpm"]

EXPOSE 9000