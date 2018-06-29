FROM php:7-cli-alpine3.6

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

RUN echo "xdebug.remote_port=9001" >> /etc/php7/conf.d/xdebug.ini \
    && echo "xdebug.remote_enable=1" >> /etc/php7/conf.d/xdebug.ini \
    && echo "xdebug.remote_autostart=1" >> /etc/php7/conf.d/xdebug.ini \
    && echo "xdebug.remote_connect_back=0" >> /etc/php7/conf.d/xdebug.ini \
    && echo "xdebug.remote_host=192.168.65.0" >> /etc/php7/conf.d/xdebug.ini

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php \
    && php -r "unlink('composer-setup.php');" \
    && mv composer.phar /usr/local/bin/composer

WORKDIR /msales/recruitment-task-katowice
