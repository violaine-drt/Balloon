#!/bin/bash

# Configure XDebug to not start by default, and to support coverage
sed -i 's/xdebug.mode = debug/xdebug.mode = debug,coverage/g' /usr/local/etc/php/conf.d/xdebug.ini
sed -i 's/xdebug.start_with_request = yes/xdebug.start_with_request = no/g' /usr/local/etc/php/conf.d/xdebug.ini
echo "xdebug.discover_client_host=1" >> /usr/local/etc/php/conf.d/xdebug.ini


apt-get update

# Install Postgre PDO
apt-get install -y libpq-dev \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pdo_pgsql pgsql

# Install GD extension for image manipulation
apt-get install -y libpng-dev libjpeg-dev libfreetype6-dev \
    && docker-php-ext-configure gd -with-freetype=/usr/include/ -with-jpeg=/usr/include/ \
    && docker-php-ext-install gd