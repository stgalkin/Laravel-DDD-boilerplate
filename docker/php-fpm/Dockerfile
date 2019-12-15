FROM php:7.4-fpm

RUN apt-get update \
  && apt-get install -y --no-install-recommends \
    curl \
    libmemcached-dev \
    libz-dev \
    libpq-dev \
    libjpeg-dev \
    libpng-dev \
    libfreetype6-dev \
    libssl-dev \
    libmcrypt-dev \
  && rm -rf /var/lib/apt/lists/*

RUN rm /etc/apt/preferences.d/no-debian-php

RUN apt-get update -yqq && \
    apt-get -y install libxml2-dev php-soap && \
    docker-php-ext-install -j$(nproc) \
        bcmath \
        opcache \
        pdo_mysql \
        pdo_pgsql \
        soap \
        sockets

RUN pecl install mcrypt-1.0.3 && \
        docker-php-ext-enable mcrypt

WORKDIR /var/www

EXPOSE 9000