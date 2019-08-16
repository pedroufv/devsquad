FROM php:7.2-apache

RUN apt-get update && apt-get install -y git nodejs supervisor cron
RUN apt-get update && apt-get install -y git nodejs supervisor cron

RUN apt-get install -y \
    git \
    zip \
    curl \
    sudo \
    unzip \
    libicu-dev \
    libbz2-dev \
    libpng-dev \
    libjpeg-dev \
    libmcrypt-dev \
    libreadline-dev \
    libfreetype6-dev \
    g++

RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"

RUN docker-php-ext-install \
    bz2 \
    intl \
    iconv \
    bcmath \
    opcache \
    calendar \
    mbstring \
    pdo_mysql \
    zip

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

ARG uid
RUN useradd -G www-data,root -u $uid -d /home/devsquad devsquad
RUN mkdir -p /home/devsquad/.composer && \
    chown -R devsquad:devsquad /home/devsquad

RUN a2enmod rewrite headers

COPY apache /etc/apache2/sites-available/

RUN a2ensite devsquad.conf

COPY supervisor /etc/supervisor/conf.d/
RUN mkdir -p /var/www/html/ecommerce/storage/logs/

COPY cron/ecommerce-cron /etc/cron.d/ecommerce-cron
RUN chmod 0644 /etc/cron.d/ecommerce-cron
RUN crontab /etc/cron.d/ecommerce-cron
RUN touch /var/log/cron.log
CMD cron && tail -f /var/log/cron.log

RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf
CMD apachectl -D FOREGROUND
