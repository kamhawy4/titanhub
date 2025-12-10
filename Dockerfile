FROM php:8.2-apache

# تفعيل Apache mod_rewrite
RUN a2enmod rewrite

# تثبيت الحزم النظامية المطلوبة
RUN apt-get update && apt-get install -y \
    zip unzip git curl libzip-dev libpng-dev libonig-dev libxml2-dev \
    && rm -rf /var/lib/apt/lists/*

# تثبيت الإضافات الخاصة بـ PHP
RUN docker-php-ext-install pdo pdo_mysql mbstring zip xml gd pcntl

# تثبيت Redis extension
RUN pecl install redis \
    && docker-php-ext-enable redis

# تثبيت Composer
COPY --from=composer:2.7 /usr/bin/composer /usr/bin/composer

# ضبط مجلد العمل
WORKDIR /var/www/html

# ضبط DocumentRoot لـ Laravel
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf \
    && sed -ri -e 's!<Directory /var/www/>!<Directory ${APACHE_DOCUMENT_ROOT}>!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# صلاحيات الملفات
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html
