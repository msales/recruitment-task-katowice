FROM php:7-fpm-alpine3.6

RUN apk --update add \
        curl \
        tar \
        git \
        zip \
        gmp \
        gmp-dev \
        php7-gmp \
        php7-xdebug \
        php7-bcmath \
        php7-redis \
        php7-pcntl \
        php7-sockets \
        php7-pdo_mysql \
        && rm -rf /var/cache/apk/*

RUN docker-php-ext-install \
    gmp \
    bcmath \
    mysqli \
    pdo \
    pdo_mysql

COPY custom-config.ini /etc/php7/conf.d/
