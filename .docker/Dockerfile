FROM php:7.3-cli-alpine

RUN apk --update add wget curl git php-curl php-openssl php-json php-phar php-dom && \
    rm /var/cache/apk/* && \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer

COPY . /app
WORKDIR /app

CMD ["/bin/sh"]
ENTRYPOINT ["/bin/sh", "-c"]