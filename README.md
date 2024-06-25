# Backend

## Install PHP
```bash
sudo apt install --no-install-recommends php8.1
sudo apt install -y php8.1-cli php8.1-common php8.1-mysql php8.1-zip php8.1-gd php8.1-mbstring php8.1-curl php8.1-xml php8.1-bcmath
sudo apt install -y php8.1-pgsql libgd3
```

## Install Composer
```bash
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('sha384', 'composer-setup.php') === 'dac665fdc30fdd8ec78b38b9800061b4150413ff2e3b6f88543c636f7cd84f6db9189d43a81e5503cda447da73c7e5b6') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
php composer-setup.php
php -r "unlink('composer-setup.php');
sudo mv composer.phar /usr/local/bin/composer
```
## Install Postgres
https://www.postgresql.org/download/

## Create DB in Postgres
```bash
sudo -i -u postgres
createdb streets-db
createuser --interactive --pwprompt
//streets-user with password admin, non-superuser
psql
GRANT ALL PRIVILEGES ON DATABASE "streets-db" TO "streets-user";
\q
exit
```

## Setup Laravel .env
```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=streets-db
DB_USERNAME=streets-user
DB_PASSWORD=admin
```

## Run migrations
```bash
php artisan migrate
```

## Run seeders
```
// For Regiones, Provincias & Ciudades
php artisan db:seed --class=BulkSeeder

// Faker data for Calles
php artisan db:seed --class=CalleSeeder
```

## Serve
```bash
php artisan serve
```

# Frontend

Node version 18

## Install modules
```bash
cd frontend/street-maintainer/
npm install
```

## Setup .env
```env
NEXT_PUBLIC_API_HOST="http://localhost:8000/api"
```

## Run
```bash
npm run dev
```