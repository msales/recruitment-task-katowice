FROM php-recruitment

MAINTAINER Marek Szymeczko <marek.szymeczko@msales.com>

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer --version

WORKDIR /msales/recruitment-task-katowice

ENTRYPOINT ["composer"]