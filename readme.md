# DevSquad Test

This project is a SPA with [Laravel](https://github.com/laravel/laravel) + [VueJS](https://github.com/vuejs/vue):

- [Laravel 5 Repositories](https://github.com/andersao/l5-repository).
- [CORS Middleware for Laravel 5](https://github.com/barryvdh/laravel-cors).
- [JSON Web Token Authentication for Laravel & Lumen](https://github.com/tymondesigns/jwt-auth).
- [L5 Swagger](https://github.com/DarkaOnLine/L5-Swagger).
- [PHP Docker Offical Image](https://hub.docker.com/_/php).
- [MySQL Docker Offical Image](https://hub.docker.com/_/mysql).


## Install
1. clone project ```git clone git@github.com:...```
2. install dependencies ```composer install``` and `npm install`
3. copy file .env.exemple and rename .env ```cp .env.example .env```
4. change .env settings
5. generate key ```php artisan key:generate```
6. generate jwt key ```php artisan jwt:secret```
7. create database ```echo "create database {dbname}" | mysql -u {username} -p```
8. run migrate ```php artisan migrate --seed```
9. verify a email of one user seeded and login with `password` to manager products
10. run `php artisan serve`. See the api documentation in `/api/doc` 

## How to run this project with docker?
- run docker `docker-compose build && docker-compose up -d`
- generate key `docker-compose exec --user=devsquad devsquad bash -c "php ./ecommerce/artisan key:generate"` 
- generate jwt key `docker-compose exec --user=devsquad devsquad bash -c "php ./ecommerce/artisan jwt:secret"` 
- run migrations `docker-compose exec --user=devsquad devsquad bash -c "php ./ecommerce/artisan migrate --seed"` 
- open hosts `sudo vim /etc/hosts`
- add host `127.0.0.1   devsquad.local`
- run `npm install` or just `npm i`
- access `http://devsquad.local:8080` on browser
- using `host 172.28.1.1` check for users created and use `password` as password
- see api documentation in `/api/doc` like `http://devsquad.local:8080/api/doc`
- access landing page on `/landing` like `http://devsquad.local:8080/landing`

## Additional info
- Configure email on `.env` with mailtrap, for example, to see the sent notifications
- With docker run `docker exec -it devsquad bash -c "sudo supervisord"` for start queue worker
- If you run this without docker configure worker on supervisor to queues
- If you run this without docker add `* * * * * php /path-to-your-projec/artisan schedule:run >> /dev/null 2>&1` on cron
- On `docker/application/supervisor` has worker file for put into `/etc/supervisor/conf.d/`
