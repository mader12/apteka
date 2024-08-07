FROM php:8.2-fpm-buster

RUN apt-get update
RUN apt-get -y install mariadb-client
RUN apt-get -y install git zlib1g-dev libpng-dev libicu-dev libldap-dev libonig-dev libxml2-dev libzip-dev libmemcached-dev

RUN docker-php-ext-install opcache
RUN docker-php-ext-install intl
RUN docker-php-ext-install ldap
RUN docker-php-ext-install mbstring
RUN docker-php-ext-install soap
RUN docker-php-ext-install zip
RUN docker-php-ext-install pdo_mysql

RUN git clone https://github.com/php-memcached-dev/php-memcached /usr/src/php/ext/memcached
RUN docker-php-ext-configure /usr/src/php/ext/memcached --disable-memcached-sasl
RUN docker-php-ext-install /usr/src/php/ext/memcached
RUN rm -rf /usr/src/php/ext/memcached

RUN apt-get install -y libfreetype6-dev libmcrypt-dev libjpeg-dev libpng-dev
RUN docker-php-ext-configure gd --with-freetype --with-jpeg --enable-gd
RUN docker-php-ext-install gd

ADD crontab /tmp/crontab

# Create the log file to be able to run tail
RUN touch /var/log/cron.log
RUN apt-get -y install cron
RUN /usr/bin/crontab /tmp/crontab
RUN rm -f /tmp/crontab

RUN service cron start