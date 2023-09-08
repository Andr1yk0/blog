FROM php:8.2.6-fpm
ARG user
ARG uid

COPY --from=composer /usr/bin/composer /usr/bin/composer

RUN apt-get update && apt-get install -y \
    zip \
    unzip \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev

RUN apt-get clean && rm -rf /var/lib/apt/lists/* && rm -rf /var/www/html

RUN docker-php-ext-install pdo_mysql

RUN docker-php-ext-install gd

RUN useradd -G www-data,root -u $uid -d /home/$user $user

RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

WORKDIR /var/www

USER $user