# Usar una imagen base de PHP con Apache
FROM php:7.4-apache

# Instalar las extensiones necesarias
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Copiar el código de la aplicación al contenedor
COPY . /var/www/html/

# Permitir la reescritura en Apache
RUN a2enmod rewrite

# Exponer el puerto 80 para el servidor web
EXPOSE 80

# Comando para iniciar Apache
CMD ["apache2-foreground"]
