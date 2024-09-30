# PHP
FROM php:8.2-apache AS php

RUN apt-get update -y && apt-get install -y \
    unzip \
    libpq-dev \
    libcurl4-gnutls-dev \
    libonig-dev \
    libxml2-dev \
    curl \
    gnupg
RUN docker-php-ext-install \
    pdo \
    pdo_mysql \
    bcmath \
    mbstring \
    tokenizer \
    xml \
    ctype \
    json \
    openssl

WORKDIR /var/www
COPY . .

COPY --from=composer:2.7.7 /usr/bin/composer /usr/bin/composer

ENV PORT=8000

EXPOSE 80

ENTRYPOINT [ "docker/entrypoint.sh" ]

#APACHE
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache
RUN a2enmod rewrite
CMD ["apache2-foreground"]
