ARG TARGET_PHP_VERSION=8.0
FROM php:${TARGET_PHP_VERSION}-fpm

ARG SERVICE_DIR="."
COPY ./.docker/.shared/scripts/ /tmp/scripts/
RUN chmod +x -R /tmp/scripts/

RUN /tmp/scripts/install_software.sh

# install php extensions
RUN /tmp/scripts/install_php_extensions.sh

# php config
ADD ./.docker/php-fpm/config/conf.ini /usr/local/etc/php/conf.d
ADD ./.docker/php-fpm/config/php-fpm.conf /usr/local/etc/php-fpm.d/

# install nginx and config
RUN apt-get update -y \
    && apt-get install -y nginx

RUN usermod -u 1000 www-data
RUN mkdir -p /var/www/html/public/ \
    && touch /var/www/html/public/index.php

# install unar
# RUN apt-get update -y \
#     && apt-get install -y unar

#source
ARG APP_CODE_PATH="/var/www/html"
COPY .  ${APP_CODE_PATH}

# Install dependencies
RUN composer install --prefer-dist --no-scripts --no-autoloader && rm -rf /root/.composer

# Copy codebase
ARG APP_USER=www-data
RUN chown -R ${APP_USER} ${APP_CODE_PATH}/storage/*

# Finish composer
RUN composer dump-autoload --no-scripts --optimize

# workdir
WORKDIR ${APP_CODE_PATH}

# Install node js and npm

RUN curl -sL https://deb.nodesource.com/setup_14.x | bash - \
    && apt-get install -y nodejs \
    && npm install -g yarn

# RUN npm install pm2 -g

# Install supervisor
RUN curl "https://bootstrap.pypa.io/get-pip.py" -o "get-pip.py" \
    && python3 get-pip.py \
    && pip3 install supervisor \
    && echo "supervisord -c /etc/supervisord.conf" >> /root/.bashrc

COPY .docker/supervisor/supervisord.conf /etc/supervisord.conf
# COPY .docker/supervisor/laravel-echo.conf /etc/supervisor/conf.d/laravel-echo.conf
COPY .docker/supervisor/laravel-horizon.conf /etc/supervisor/conf.d/laravel-horizon.conf

# cleanup
RUN /tmp/scripts/cleanup.sh

# clear .env
# RUN cd ${APP_CODE_PATH} && rm -rf .env

EXPOSE 80 443 6001

CMD ["sh", "-c", "set -x; php artisan optimize:clear; php artisan migrate; /usr/local/sbin/php-fpm --force-stderr --fpm-config /usr/local/etc/php-fpm.d/php-fpm.conf; supervisord; nginx -g 'daemon off;'"]
