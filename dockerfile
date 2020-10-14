FROM ubuntu:18.04
  
LABEL maintainer = “Shengze Yu shengze.yu@uqconnect.edu.au”
ENV TZ=Australia/Brisbane
RUN apt-get -yqq update
RUN DEBAIN_FRONTEND=noninteractive apt install -y tzdata
RUN apt-get -yqq install apt-utils
RUN apt-get -yqq install curl gcc make autoconf libc-dev zlib1g-dev pkg-config
RUN apt-get -yqq install gnupg2 dirmngr wget apt-transport-https lsb-release ca-certificates software-properties-common
RUN add-apt-repository ppa:ondrej/php
RUN apt-get -yqq update
RUN apt-get -yqq install nginx php7.4 php7.4-cli php7.4-fpm php7.4-json php7.4-pdo php7.4-pgsql php7.4-zip php7.4-gd php7.4-mbstring php7.4-curl php7.4-xml php7.4-bcmath php7.4-json

COPY ./phpconf/php-fpm.conf /etc/php/7.4/fpm/php-fpm.conf
COPY ./wwwconf/www.conf /etc/php/7.4/fpm/pool.d/www.conf
COPY ./sitepages/ /var/www/html/
COPY ./nginx/default.conf /etc/nginx/conf.d/default.conf

RUN service nginx reload      
RUN php-fpm7.4 -F &           
RUN service nginx restart

WORKDIR /var/www/html
    
EXPOSE 80 
    
CMD service php7.4-fpm start && nginx -g "daemon off;"