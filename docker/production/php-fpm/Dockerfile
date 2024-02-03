FROM php:8.2-fpm-alpine

RUN apk update && apk upgrade
RUN apk add libpq-dev
RUN docker-php-ext-install pdo pdo_pgsql pgsql

#RUN apk add --update linux-headers --no-cache autoconf g++ make \
#    && pecl install xdebug \
#    && rm -rf /tmp/pear \
#    && docker-php-ext-enable xdebug


RUN mv $PHP_INI_DIR/php.ini-development $PHP_INI_DIR/php.ini



COPY ./common/php/conf.d /usr/local/etc/php/conf.d
COPY ./common/php/php-fpm.d /usr/local/etc/php-fpm.d
COPY ./development/php/conf.d /usr/local/etc/php/conf.d
COPY ./development/php-fpm/conf.d /usr/local/etc/php/conf.d

WORKDIR /app

