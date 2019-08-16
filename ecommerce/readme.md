# DevSquad Test

This project is a [Laravel](https://github.com/laravel/laravel) API scaffold using:

- [Laravel 5 Repositories](https://github.com/andersao/l5-repository).
- [CORS Middleware for Laravel 5](https://github.com/barryvdh/laravel-cors).
- [JSON Web Token Authentication for Laravel & Lumen](https://github.com/tymondesigns/jwt-auth).
- [L5 Swagger](https://github.com/DarkaOnLine/L5-Swagger).
- [PHP Docker Offical Image](https://hub.docker.com/_/php).
- [MySQL Docker Offical Image](https://hub.docker.com/_/mysql).


## Install
1. clone project ```git clone git@github.com:...```
2. install dependencies ```composer install```
3. copy file .env.exemple and rename .env ```cp .env.example .env```
4. change .env settings
5. generate key ```php artisan key:generate```
6. generate jwt key ```php artisan jwt:secret```
7. create database ```echo "create database {dbname}" | mysql -u {username} -p```
8. run migrate ```php artisan migrate --seed```

## How to run this project with docker?
- run docker `docker-compose build && docker-compose up -d`
- generate key `docker-compose exec --user=devsquad devsquad bash -c "php ./ecommerce/artisan key:generate"` 
- generate jwt key `docker-compose exec --user=devsquad devsquad bash -c "php ./ecommerce/artisan jwt:secret"` 
- run migrations `docker-compose exec --user=devsquad devsquad bash -c "php ./ecommerce/artisan migrate --seed"` 
- register and login to manager products
- open hosts `sudo vim /etc/hosts`
- add host `127.0.0.1   devsquad.local`
- run `npm install` or just `npm i`
- access `http://devsquad.local:8080` on browser
- using `host 172.28.1.1` check for users created and use `password` as password
- see api documentation in `/api/doc` like `http://devsquad.local:8080/api/doc`
