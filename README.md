# Require to Install

1. [XAMPP Version >8.1](https://www.apachefriends.org/download.html)
2. [composer](https://getcomposer.org/download/)
3. [Node version >=16](https://nodejs.org/en)

# Usage

## First Step

1. Clone This Project
2. npm install
3. composer install

## Second Step

1. Setup the `.env` file, by copy from `.env.example` then rename the file to .env
2. open xampp, start apche and mysql
3. Create a database from phpmyadmin with the same name as DB_DATABASE from .env file

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```

4. run this command on laravel project

```bash
    php artisan migrate
```

5. And then run this command

```bash
    php artisan serve
```

## Features

1. CRUD Product Api
