FROM php:7.1-fpm

RUN \
	export PHP_INSTALL_DEPS="libmcrypt-dev libicu-dev wget" \
	&& apt-get update \
	&& apt-get install -y ${PHP_INSTALL_DEPS} \
	&& docker-php-ext-install pdo pdo_mysql mcrypt intl mbstring
