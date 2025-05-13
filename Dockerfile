FROM php:8.2-fpm

# Instala dependências do sistema
RUN apt-get update && apt-get install -y \
    git curl zip unzip libzip-dev libpng-dev libonig-dev libxml2-dev \
    nginx supervisor && \
    docker-php-ext-install pdo pdo_mysql zip mbstring xml

# Cria diretórios de log
RUN mkdir -p /var/log/supervisor

# Copia arquivos da aplicação
WORKDIR /var/www
COPY . .

# Instala Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# Permissões
RUN chown -R www-data:www-data /var/www && chmod -R 755 /var/www

# Copia config do nginx e supervisord
COPY nginx.conf /etc/nginx/nginx.conf
COPY supervisord.conf /etc/supervisord.conf

# Porta exposta
EXPOSE 80

# Comando de inicialização
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisord.conf"]
