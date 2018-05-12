FROM php:7-fpm

RUN apt-get update && \
    apt-get install -y zip unzip git zlib1g-dev libxml2-dev libfreetype6-dev libjpeg62-turbo-dev

# Docker PHP extensions
RUN docker-php-ext-configure pdo_mysql --with-pdo-mysql=mysqlnd && \
	docker-php-ext-install pdo_mysql zip bcmath && \
	docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/  &&  \
    docker-php-ext-install gd

# Default settings
RUN echo "date.timezone=${PHP_TIMEZONE:-Europe/Amsterdam}" > $PHP_INI_DIR/conf.d/date_timezone.ini

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && pecl install xdebug \
    && echo "zend_extension=$(find /usr/local/lib/php/extensions/ -name xdebug.so)" > /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.remote_enable=on" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.remote_autostart=off" >> /usr/local/etc/php/conf.d/xdebug.ini

RUN usermod -u 1000 www-data

# Create api dir
WORKDIR /var/www/

# Copy composer and nginx
COPY composer.* /var/www/
COPY dev.conf /etc/nginx/conf.d/

# Run composer install
RUN composer install --no-scripts --no-autoloader

# Copy files and set ownership
COPY . /var/www/

# Prepare symfony for install
ENV SYMFONY_ENV dev

RUN composer dump-autoload --optimize \
    && composer run-script post-install-cmd

VOLUME /var/www/
VOLUME /etc/nginx/conf.d