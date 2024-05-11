FROM php:8.2-cli-alpine

RUN apk update && apk upgrade
RUN apk add libpq-dev
RUN docker-php-ext-install pdo pdo_pgsql pgsql

RUN mv $PHP_INI_DIR/php.ini-development $PHP_INI_DIR/php.ini

COPY ./development/php/conf.d /usr/local/etc/php/conf.d
COPY ./development/scheduler/cron/crontab /etc/crontabs/root

#RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/bin --filename=composer --quiet


WORKDIR /app

CMD ["crond", "-f"]


