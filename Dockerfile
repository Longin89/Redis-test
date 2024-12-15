FROM php:7.4-apache

# Установка системных зависимостей
RUN apt-get update && apt-get install -y \
    unzip \
    libzip-dev \
    && rm -rf /var/lib/apt/lists/*

# Установка расширений
RUN docker-php-ext-install zip \
    && pecl install redis \
    && docker-php-ext-enable redis

# Установка Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Установка рабочей папки
WORKDIR /var/www/html

CMD ["apache2-foreground"]