# KPI BACKEND LABS

Лабораторні роботи Полтавського Володимира IO-13

### Deployment

http://185.229.224.230

## Installation

### Run dev server:
- Install Symfony CLI:
```shell 
curl -sS https://get.symfony.com/cli/installer | bash
```
- Start debug server:
```shell
symfony server:start
```

### Build
- Build app with docker:
```shell
docker-compose up --profile prod
```
Server will be able on :80 port

## API
### Lab 1
```
/api/healthcheck
```
Returns server current date in d.m.Y H:i format and service status
