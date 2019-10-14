FROM php:7.2-fpm
MAINTAINER Murat Erkenov <murat@narsana.ru>

RUN apt-get update && apt-get install -y --no-install-recommends libssl-dev libmcrypt-dev libxml2-dev libzip-dev git libcurl4-openssl-dev ssh

RUN docker-php-ext-install opcache zip xml
RUN docker-php-ext-enable opcache zip xml

RUN pecl install xdebug
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY conf.d/* /usr/local/etc/php/conf.d/

CMD ["php-fpm"]
