# KPI BACKEND LABS

Лабораторні роботи Полтавського Володимира IO-13

### Deployment

http://185.229.224.230

### Postman Workspace

https://warped-shadow-667028.postman.co/workspace/61247b03-0b8a-4cb2-bec7-7958ee34fa5d

## Installation

### Run dev server:
- Install PHP

- Install [Symfony CLI](https://symfony.com/download "Symfony CLI")

- Install [Composer](https://getcomposer.org/download "Composer")

- Install dependencies
```shell
composer install --dev
```
- Run database and debug services with docker
```shell
docker compose -f docker-compose.dev.yaml up
```
- [Make migrations](#migrations)

- Start debug server:

```shell
symfony server:start
```

## Build
- Build app with docker:
```shell
docker compose up
```
- [Make migrations](#migrations)

Server will be able on :80 port

### Migrations
To sync your database with mapping information you must make migrations
```shell
php bin/console doctrine:migrations:migrate 
```

Or when you have no database
```shell
php bin/console doctrine:database:create 
```
