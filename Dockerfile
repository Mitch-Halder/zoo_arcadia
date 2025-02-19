FROM php:8.0-apache

RUN apt-get update && apt-get install -y \
    wget \
    gnupg2 \
    lsb-release \
    libcurl4-openssl-dev \
    pkg-config \
    libssl-dev \
    libsasl2-dev \
    libz-dev

RUN echo "deb http://apt.postgresql.org/pub/repos/apt $(lsb_release -cs)-pgdg main" > /etc/apt/sources.list.d/pgdg.list && \
    wget --quiet -O - https://www.postgresql.org/media/keys/ACCC4CF8.asc | apt-key add - && \
    apt-get update && apt-get install -y \
    libpq-dev postgresql-client

RUN docker-php-ext-install pdo pdo_pgsql

RUN pecl install mongodb && \
    docker-php-ext-enable mongodb

COPY . /var/www/html/

EXPOSE 80

