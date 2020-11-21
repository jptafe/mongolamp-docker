
FROM php:7.4-apache 

RUN set -eux; \
	apt-get update; \
	rm -rf /var/lib/apt/lists/*

RUN set -eux; \
    pecl install mongodb \
    && docker-php-ext-enable mongodb

EXPOSE 80
CMD ["apache2-foreground"]
