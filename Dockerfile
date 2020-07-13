FROM php:7.2-apache

RUN apt-get update &&\
    apt-get install apt-utils curl gnupg -y &&\
    curl -sL https://deb.nodesource.com/setup_8.x | bash - &&\
    mkdir -p /usr/share/man/man1 &&\
    apt-get install nodejs python make g++ git unzip zip libcurl4-openssl-dev libc-client-dev libkrb5-dev autoconf default-jre-headless cron p7zip-full vim zlib1g-dev mariadb-client libpng-dev -y &&\
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer &&\
    docker-php-ext-configure gd --with-png-dir=/usr/include/ && \
    docker-php-ext-install -j$(nproc) gd &&\
    docker-php-ext-install pdo_mysql bcmath curl opcache zip mbstring bcmath exif&&\
    cd /etc/apache2/mods-enabled &&\
    ln -s ../mods-available/rewrite.load ./ &&\
    ln -s /dev/stdout /var/log/apache2/access_atslp.log &&\
    ln -s /dev/stdout /var/log/apache2/access_crmlp.log &&\
    ln -s /dev/stdout /var/log/apache2/access_firstlp.log &&\
    ln -s /dev/stdout /var/log/apache2/access_top.log &&\
    ln -s /dev/stderr /var/log/apache2/error_atslp.log &&\
    ln -s /dev/stderr /var/log/apache2/error_crmlp.log &&\
    ln -s /dev/stderr /var/log/apache2/error_firstlp.log &&\
    ln -s /dev/stderr /var/log/apache2/error_top.log

RUN apt-get install -y libgmp-dev re2c libmhash-dev libmcrypt-dev file
RUN ln -s /usr/include/x86_64-linux-gnu/gmp.h /usr/local/include/
RUN docker-php-ext-configure gmp
RUN docker-php-ext-install gmp

RUN pecl install -o -f redis &&  rm -rf /tmp/pear &&  docker-php-ext-enable redis


CMD ["/usr/local/bin/run.sh"]

WORKDIR /var/www/cuongpmapi

EXPOSE 8006

CMD ["php", "-S", "0.0.0.0:8006", "-t", "/var/www/cuongpmapi/public"]
