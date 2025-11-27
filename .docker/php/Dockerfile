FROM php:8.3.11-fpm

RUN apt-get update \
&& apt-get install -y \
    libpq-dev \
    libzip-dev \
    zip \
    git \
    cron \
&& docker-php-ext-install zip pdo_pgsql \
&& pecl install xdebug \
&& docker-php-ext-enable xdebug

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
&& php composer-setup.php \
&& php -r "unlink('composer-setup.php');" \
&& mv composer.phar /usr/local/bin/composer

WORKDIR /var/www/symf
