FROM doug7410/laravel_base:v1

COPY . /var/www

WORKDIR /var/www

COPY docker/start-container /usr/local/bin/start-container
COPY docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf
COPY docker/nginx.conf /etc/nginx/sites-enabled/money-mountain.conf

RUN chmod +x /usr/local/bin/start-container
RUN composer install

EXPOSE 80

ENTRYPOINT ["start-container"]