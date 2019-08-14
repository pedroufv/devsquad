## DevSquad Test

This project is a [Laravel](https://github.com/laravel/laravel) API scaffold using:

- [Laravel 5 Repositories](https://github.com/andersao/l5-repository).
- [CORS Middleware for Laravel 5](https://github.com/barryvdh/laravel-cors).
- [JSON Web Token Authentication for Laravel & Lumen](https://github.com/tymondesigns/jwt-auth).
- [L5 Swagger](https://github.com/DarkaOnLine/L5-Swagger).


## Install
1. clone project ```git clone git@github.com:...```
2. install dependencies ```composer install```
3. copy file .env.exemple and rename .env ```cp .env.example .env```
4. change .env settings
5. generate key ```php artisan key:generate```
6. generate jwt key ```php artisan jwt:secret```
7. create database ```echo "create database {dbname}" | mysql -u {username} -p```
8. run migrate ```php artisan migrate --seed```
