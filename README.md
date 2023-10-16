# KPI BACKEND LABS

Лабораторні роботи Полтавського Володимира IO-13

### Deployment

https://kpi-backend-634p.onrender.com/

## Installation

###Run dev server:
- Install Symfony CLI:
```shell 
curl -sS https://get.symfony.com/cli/installer | bash
```
- Start debug server:
```shell
symfony server:start
```

###Build
- Build app with docker:
```shell
docker-compose up
```
Server will be able on :80 port

##API
###Lab 1
```
/api/healthcheck
```
Returs you current date in d.m.Y H:i format and service status