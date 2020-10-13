FROM php:7.4-fpm

RUN docker-php-ext-install mysqli
RUN mkdir ~/website
RUN cd ~/website
RUN git clone git://github.com/yu-shengze/infs3208 .


CMD ["php-fpm"]

EXPOSE 9000