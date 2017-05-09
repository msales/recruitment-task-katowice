FROM debian:jessie

MAINTAINER Marek Szymeczko <marek.szymeczko@msales.com>

RUN apt-get update && apt-get install -y \
    nginx

ADD nginx.conf /etc/nginx/
ADD msales-katowice-trial.conf /etc/nginx/sites-available/

RUN ln -s /etc/nginx/sites-available/msales-katowice-trial.conf /etc/nginx/sites-enabled/
RUN rm /etc/nginx/sites-enabled/default

RUN echo "upstream php-upstream { server php:9000; }" > /etc/nginx/conf.d/upstream.conf

RUN usermod -u 1000 www-data
RUN service nginx restart

CMD ["nginx"]

EXPOSE 80
EXPOSE 443
