FROM php:8.2-fpm

# Instala dependências do sistema e ferramentas necessárias
RUN apt-get update && apt-get install -y \
    git curl zip unzip libzip-dev libpng-dev libonig-dev libxml2-dev \
    nginx supervisor \
    gnupg ca-certificates

# Instala Node.js 18.x (para Vite)
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - && \
    apt-get install -y nodejs

# Cria diretórios de log
RUN mkdir -p /var/log/supervisor

# Define diretório de trabalho
WORKDIR /var/www

# Copia os arquivos da aplicação
COPY . .

# Instala o Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# Instala dependências do frontend e compila os assets com Vite
RUN npm install && npm run build

# Ajusta permissões
RUN chown -R www-data:www-data /var/www \
    && chmod -R 755 /var/www \
    && chmod -R 775 storage bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache

# Copia configs do nginx e do supervisord
COPY nginx.conf /etc/nginx/nginx.conf
COPY supervisord.conf /etc/supervisord.conf

# Expõe a porta 8080 (usada pelo nginx no Railway)
EXPOSE 8080

# Comando de inicialização
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisord.conf"]
