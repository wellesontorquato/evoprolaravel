# Etapa base com PHP-FPM
FROM php:8.2-fpm

# Instala dependências necessárias
RUN apt-get update && apt-get install -y \
    git curl zip unzip libzip-dev libpng-dev libonig-dev libxml2-dev \
    nginx supervisor && \
    docker-php-ext-install pdo pdo_mysql zip mbstring xml

# Instala Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Define diretório de trabalho
WORKDIR /var/www/html

# Copia código do projeto para dentro do container
COPY . .

# Instala dependências PHP do Laravel
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Permissões para diretórios do Laravel
RUN chown -R www-data:www-data storage bootstrap/cache

# Copia arquivos de configuração NGINX e Supervisord
COPY nginx.conf /etc/nginx/nginx.conf
COPY supervisord.conf /etc/supervisord.conf

# Expõe a porta padrão do NGINX
EXPOSE 80

# Inicia supervisord (que gerencia nginx + php-fpm)
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisord.conf"]
