# Ldocker

## Overview

This project uses Laravel Sail with Docker to set up a Laravel development environment.

## Setup Instructions

1. **Clone the Repository:**
   ```sh
   git clone https://github.com/yuliiabodnar/ldocker.git
   cd ldocker
   
2. **Install Laravel Sail:**
   ```sh
   composer require laravel/sail --dev
   
3. **Create the .env File:**
   ```sh
   cp .env.local .env

4. **Create MySQL Volume Directory:**
   ```sh
   mkdir -p docker/volume/mysql
   sudo chown -R $(whoami):$(whoami) ./docker/volume/mysql
   sudo chmod -R 755 ./docker/volume/mysql

5. **Install and Configure Laravel Sail:**
   ```sh
   php artisan sail:install

6. **Build and Start Docker Containers:**
   ```sh
   ./vendor/bin/sail up --build -d

6. **Run Database Migrations:**
   ```sh
   ./vendor/bin/sail artisan migrate

7. **Adjust File Permissions:**
   ```sh
   ./vendor/bin/sail shell
   chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
   chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

