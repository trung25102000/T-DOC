FROM php:latest

ARG TZ
ARG PHP_INI_PATH
ARG PHP_TIMEZONE
ARG PHP_SESSION_SAVE_PATH

# Set timezone
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

# Copy php.ini
COPY $PHP_INI_PATH /usr/local/etc/php/conf.d/custom.ini

CMD ["php", "-a"]
