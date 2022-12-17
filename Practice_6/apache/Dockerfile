FROM php:8.1-apache
ENV COMPOSER_ALLOW_SUPERUSER=1
COPY --from=composer /usr/bin/composer /usr/local/bin/composer
COPY jpgraph.zip jpgraph.zip
# Alice (fixtures generator) # GD (Graphics Library) # JpGraph
RUN apt-get update && apt-get install -y apache2-utils libaprutil1-dbd-mysql git unzip libpng-dev && docker-php-ext-install mysqli \
&& composer require nelmio/alice && a2enmod rewrite && pecl install redis && docker-php-ext-enable redis && a2enmod authn_dbd \
&& pecl install xdebug && docker-php-ext-enable xdebug && docker-php-ext-install gd && unzip jpgraph.zip && service apache2 restart