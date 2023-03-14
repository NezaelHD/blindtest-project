FROM php:8.1-apache
RUN apt update && apt upgrade -y
RUN curl -sS https://getcomposer.org/installer | php \
        && mv composer.phar /usr/local/bin/ \
        && ln -s /usr/local/bin/composer.phar /usr/local/bin/composer
RUN a2enmod rewrite
RUN docker-php-ext-install pdo pdo_mysql
ENV PATH="~/.composer/vendor/bin:./vendor/bin:${PATH}"