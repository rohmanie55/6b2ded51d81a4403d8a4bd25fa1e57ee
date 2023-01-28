FROM php:8.2-apache
LABEL maintainer="Muhamad Rohmani <mrohmani96@gmail.com>"

# COPY default.conf /etc/apache2/sites-available/000-default.conf
COPY httpd.conf /usr/local/apache2/conf/httpd.conf
COPY default.conf /etc/apache2/sites-available/000-default.conf

# Enable mod_rewrite
RUN a2enmod rewrite

ENV PATH="./vendor/bin:${PATH}"

COPY conf/ /usr/local/etc/php/conf.d/

RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime \
    && ln -s /usr/include/x86_64-linux-gnu/gmp.h /usr/local/include/ \
    && echo $TZ > /etc/timezone \
    && apt-get update \
    && apt-get -y --no-install-recommends install apt-utils curl zip unzip  \
        procps git nano wget sendmail supervisor \
        zlib1g-dev libgpgme11 libgpgme11-dev \
        libfreetype6-dev libjpeg62-turbo-dev libmcrypt-dev libreadline-dev \
        libgmp-dev libmhash-dev libpng-dev libxml2-dev libssl-dev libzip-dev libpq-dev \
        re2c apache2-utils openssl autoconf pkg-config \
    && docker-php-ext-install opcache zip \
    && docker-php-ext-configure gd \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install soap intl bcmath pcntl sockets \
    && docker-php-ext-configure gmp \
    && docker-php-ext-install gmp \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo_pgsql pgsql 

RUN echo "### Installing PHP and its Extensions are completed. ###"

# Add Mongodb, Redis, XDebug
# RUN pecl install xdebug \ 
#     && docker-php-ext-enable xdebug opcache 

# RUN echo "### Installing XDebug Extensions are completed. ###"

# Add Composer
RUN curl -sS https://getcomposer.org/installer | php -- \
    --install-dir=/usr/bin --filename=composer && chmod +x /usr/bin/composer 
RUN echo "### Installing Composer is completed. ###" 

# copy supervisor config
COPY supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# start supervisor
CMD ["supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]

EXPOSE 80 443

WORKDIR /var/www/html
