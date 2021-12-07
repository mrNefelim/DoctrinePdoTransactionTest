FROM phusion/baseimage:master-amd64

ENV LANG       en_US.UTF-8
ENV LC_ALL     en_US.UTF-8
ENV APP_ENV    development

CMD ["/sbin/my_init"]

RUN apt update && apt install -y git \
    zip \
    php7.4-fpm \
    php7.4-mysql \
    php7.4-xml \
    php7.4-mbstring \
    php7.4-zip \
    && apt clean

WORKDIR /var/www

COPY --from=composer:1.10.19 /usr/bin/composer /usr/bin/composer
COPY ./ /var/www
RUN /usr/bin/composer install --prefer-dist

EXPOSE 80
EXPOSE 8080
