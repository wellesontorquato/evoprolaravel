FROM php:8.2-fpm

# Instala dependências do sistema e extensões PHP
RUN apt-get update && apt-get install -y \
    git curl zip unzip libzip-dev libpng-dev libonig-dev libxml2-dev \
    nginx supervisor gnupg ca-certificates \
    && docker-php-ext-install pdo pdo_mysql zip mbstring xml

# Instala Node.js 18.x (para build do Vite)
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - && \
    apt-get install -y nodejs

# Cria diretórios de log do supervisord
RUN mkdir -p /var/log/supervisor

# Define o diretório de trabalho
WORKDIR /var/www

# Copia todos os arquivos da aplicação
COPY . .

# Força rebuild de cache via argumento dinâmico
ARG CACHE_BUST=1

# Instala Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN echo "🚀 Cache bust token: $CACHE_BUST" && composer install --no-dev --optimize-autoloader

# Compila frontend com Vite
RUN npm install && npm run build

# Ajusta permissões para Laravel funcionar corretamente
RUN mkdir -p storage/logs && \
    chmod -R 775 storage bootstrap/cache && \
    chown -R www-data:www-data storage bootstrap/cache storage/logs && \
    chown -R www-data:www-data /var/www && chmod -R 755 /var/www

# Copia os arquivos de configuração do nginx e supervisord
COPY nginx.conf /etc/nginx/nginx.conf
COPY supervisord.conf /etc/supervisord.conf

# Expõe a porta padrão da Railway
EXPOSE 8080

# Inicia o supervisord que orquestra nginx + php-fpm + migrations
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisord.conf"]
