FROM php:8.0.0-cli
RUN pecl install xdebug-3.0.1 && docker-php-ext-enable xdebug