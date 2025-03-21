# Etapa 1: Construir l'aplicació Laravel amb Vue.js
FROM node:16 AS build-stage
WORKDIR /app
COPY . .
RUN chmod -R 755 /app
RUN npm install -g vite
RUN npm install && npm run build

# Etapa 2: Configurar Laravel i instal·lar dependències
FROM php:8.2-fpm AS laravel-stage
WORKDIR /var/www/html
COPY --from=build-stage /app /var/www/html
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    git \
    curl \
    && docker-php-ext-install pdo_mysql gd

# Instal·lar Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
RUN git config --global --add safe.directory /var/www/html
RUN composer install --no-dev --optimize-autoloader

# Etapa 3: Configurar MySQL
FROM mysql:8.0 AS mysql-stage
ENV MYSQL_ROOT_PASSWORD=root
ENV MYSQL_DATABASE=b33_37391784_GGGamers
ENV MYSQL_USER=b33_37391784
ENV MYSQL_PASSWORD=1Q2w3e4r5t.

# Etapa 4: Configurar NGINX
FROM nginx:alpine AS nginx-stage
COPY --from=laravel-stage /var/www/html /usr/share/nginx/html
COPY nginx/nginx.conf /etc/nginx/nginx.conf

# Exposar el port 80
EXPOSE 80

# Comanda per iniciar tots els serveis
CMD ["nginx", "-g", "daemon off;"]
