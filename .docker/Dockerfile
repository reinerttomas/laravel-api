FROM reinerttomas/php:8.2-apache

RUN a2enmod rewrite

COPY .docker/apache.conf /etc/apache2/sites-enabled/000-default.conf
COPY .docker/entrypoint.sh /entrypoint.sh

RUN chmod +x /entrypoint.sh

WORKDIR /var/www/html

CMD ["apache2-foreground"]

ENTRYPOINT ["/entrypoint.sh"]