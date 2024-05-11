FROM php:8.2-cli-alpine


RUN apk update && apk upgrade
RUN apk add libpq-dev
RUN docker-php-ext-install pdo pdo_pgsql pgsql
RUN apk add supervisor

RUN mv $PHP_INI_DIR/php.ini-development $PHP_INI_DIR/php.ini

COPY ./development/php/conf.d /usr/local/etc/php/conf.d

COPY ./development/worker/conf/worker.conf /etc/supervisor/conf.d/
COPY ./development/worker/conf/supervisord.conf /etc/supervisord.conf

WORKDIR /app


CMD [ "/usr/bin/supervisord", "-n", "-c", "/etc/supervisord.conf" ]






