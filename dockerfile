# Используем официальный образ PHP с Apache
FROM php:8.0-apache

# Копируем файлы приложения в директорию Apache
COPY . /var/www/html/

# Копируем файл конфигурации PHP
COPY custom-php.ini /usr/local/etc/php/conf.d/

# Устанавливаем необходимые расширения PHP
RUN docker-php-ext-install mysqli

# Открываем порт 80 для Apache
EXPOSE 80