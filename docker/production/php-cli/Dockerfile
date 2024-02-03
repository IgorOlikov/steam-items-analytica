FROM php:8.2-cli-alpine3.16



RUN apk update && apk upgrade
RUN apk --no-cache add autoconf g++ make && pecl install xdebug && docker-php-ext-enable xdebug && rm -rf /tmp/pear; apk del autoconf g++ make
RUN apk add libpq-dev
RUN docker-php-ext-install pdo pdo_pgsql pgsql



RUN mv $PHP_INI_DIR/php.ini-development $PHP_INI_DIR/php.ini

COPY ./common/php/conf.d /usr/local/etc/php/conf.d
COPY ./development/php/conf.d /usr/local/etc/php/conf.d



RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/bin --filename=composer --quiet

RUN addgroup -g 1000 app && adduser -u 1000 -G app -s /bin/sh -D app

WORKDIR /app

USER app
