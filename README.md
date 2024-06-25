# Install Instructions

## Clone Project
```bash
git clone git@github.com:sebastiantare/test-laravel-react.git
cd test-laravel-react
```

# Backend

## Install PHP 8.1
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

```bash
sudo apt install postgresql postgresql-contrib
sudo systemctl start postgresql.service
```

## Create DBs in Postgres
```bash
sudo -i -u postgres
createdb streets-db
createdb streets-db-testing
createuser --interactive --pwprompt
# streets-user with password admin, non-superuser
psql
GRANT ALL PRIVILEGES ON DATABASE "streets-db" TO "streets-user";
GRANT ALL PRIVILEGES ON DATABASE "streets-db-testing" TO "streets-user";
\q
exit
```

## Setup Laravel .env and .env.testing

```bash
cd backend/api-rest/
cp .env.example .env
cp .env.example .env.testing
```

Replace in .env

```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=streets-db
DB_USERNAME=streets-user
DB_PASSWORD=admin
```

Replace in .env.testing

```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=streets-db-testing
DB_USERNAME=streets-user
DB_PASSWORD=admin
```

## Install packages
```
composer install
```

## Generate the APP Key
```
php artisan key:generate
```

This will generate the **APP_KEY** on the .env. **Copy and paste it on the empty APP_KEY in .env.testing**

## Run migrations
```bash
php artisan migrate
```

## Run the tests
```bash
php artisan test
```

## Run seeders
```bash
# For Regiones, Provincias & Ciudades
php artisan db:seed --class=BulkSeeder

# Faker data for Calles, if needed for testing.
php artisan db:seed --class=CalleSeeder
```

## Serve
```bash
php artisan serve
```

This will start running the API on <a href="http://localhost:8000" target="_blank">http://localhost:8000</a>

Example: http://localhost:8000/api/calles


# Frontend

Node version 18. Created with [T3](https://t3.gg/) Stack (Next.js) just for the frontend.

## Install modules
```bash
cd frontend/street-maintainer/
npm install
```

## Setup .env

```bash
cp .env.example .env
```

```env
NEXT_PUBLIC_API_HOST="http://localhost:8000/api"
```

## Run
```bash
npm run dev
```

Finally go to <a href="http://localhost:3000" target="_blank">http://localhost:3000</a>








