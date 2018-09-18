FROM php:7.1-apache
RUN pecl install xdebug-2.6.0
RUN echo "xdebug.remote_enable=1" >> /usr/local/etc/php/php.ini
RUN echo "memory_limit = 256M" >> /usr/local/etc/php/php.ini
RUN apt-get update
RUN apt-get install -y libpng-dev
RUN apt-get install -y --no-install-recommends git zip

RUN curl --silent --show-error https://getcomposer.org/installer | php
RUN apt-get update && apt-get install -y curl && apt-get install -y unzip
RUN apt-get install -y zlib1g-dev
RUN docker-php-ext-install zip
RUN docker-php-ext-enable xdebug
RUN docker-php-ext-install gd
RUN docker-php-ext-install pdo_mysql
RUN a2enmod rewrite
RUN php composer.phar create-project craftcms/craft /var/www/html/craft
RUN chmod 777 -R /var/www/html/craft
RUN /var/www/html/craft/craft setup/security-key
RUN cd /var/www/html/craft && php ../composer.phar config repositories.plugin path plugins/workshop && php ../composer.phar config minimum-stability dev
ADD plugin /var/www/html/craft/plugins/workshop
WORKDIR craft
RUN rm composer.lock && php ../composer.phar require jetbrains/phpstormcraftworkshop