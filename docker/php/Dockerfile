FROM ubuntu:22.04

LABEL maintainer="Taylor Otwell"

ARG WWWGROUP
ARG NODE_VERSION=20
ARG MYSQL_CLIENT="mysql-client"
ARG POSTGRES_VERSION=15

WORKDIR /var/www/html

ENV DEBIAN_FRONTEND noninteractive
ENV TZ=UTC
ENV SUPERVISOR_PHP_USER="sail"

# Fix permissions for Laravel directories
RUN chown -R www-data:www-data /storage /bootstrap/cache \
    && chmod -R 775 /storage /bootstrap/cache

RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

# Use the PHP 8.2.1 FPM image as a base
FROM php:8.3-fpm

# Install system dependencies and PHP extensions
RUN apt-get update && \
    apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    unzip \
    git \
    libicu-dev \
    libxslt-dev \
    libonig-dev \
    libcurl4-openssl-dev \
    && rm -rf /var/lib/apt/lists/*

# Configure and install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd zip intl xsl pdo pdo_mysql mysqli curl \
    && docker-php-ext-enable pdo_mysql

# Install and enable Xdebug
RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

# Set default values for environment variables if not provided
ENV WWWGROUP=1000
ENV WWWUSER=1000

# Create a user and group for Sail
RUN groupadd --force -g ${WWWGROUP} sail \
    && useradd -ms /bin/bash --no-user-group -g sail -u ${WWWUSER} sail

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy custom PHP configuration files
#COPY ./src/docker/php/conf.d/* /usr/local/etc/php/conf.d/

# Start PHP-FPM server
CMD ["php-fpm"]
