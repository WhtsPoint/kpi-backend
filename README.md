# KPI BACKEND LABS

Лабораторні роботи Полтавського Володимира IO-13

### Deployment

http://185.229.224.230

## Installation

### Run dev server:
- Install [Symfony CLI](https://symfony.com/download "Symfony CLI")

- Install [Composer](https://getcomposer.org/download "Composer")

- Install PHP

- Install dependencies
```shell
composer install --dev
```
- Run database and debug services with docker
```shell
docker-compose --dev up
```
- [Make migrations](#migrations)

- Start debug server:

```shell
symfony server:start
```

### Migrations
To sync your database with mapping information you must make migrations
```shell
php bin/console doctrine:database:create  
php bin/console doctrine:migrations:diff
php bin/console doctrine:migrations:migrate 
```
## Build
- Build app with docker:
```shell
docker-compose --profile prod up
```
- [Make migrations](#migrations)

Server will be able on :80 port
