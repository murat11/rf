FROM php:7.2
MAINTAINER Murat Erkenov <murat@narsana.ru>

RUN apt-get update && apt-get install -y --no-install-recommends libssl-dev libmcrypt-dev libxml2-dev libzip-dev git libcurl4-openssl-dev ssh

RUN docker-php-ext-install zip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY conf.d/* /usr/local/etc/php/conf.d/
