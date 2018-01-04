# CyclePath

The source code of the web application/API used for CyclePath mobile application.

## Build

[![SensioLabsInsight](https://insight.sensiolabs.com/projects/0faa11b9-4b07-4797-824a-731be7f735a3/mini.png)](https://insight.sensiolabs.com/projects/0faa11b9-4b07-4797-824a-731be7f735a3)
[![Build Status](https://travis-ci.org/Guikingone/CyclePath-Symfony.svg?branch=master)](https://travis-ci.org/Guikingone/CyclePath-Symfony)
[![Maintainability](https://api.codeclimate.com/v1/badges/e160414b1e334efc1def/maintainability)](https://codeclimate.com/github/Guikingone/CyclePath-Symfony/maintainability)
[![Codacy Badge](https://api.codacy.com/project/badge/Grade/86e06c6d166f40dd88fef98b6642c7d5)](https://www.codacy.com/app/Guikingone/CyclePath-Symfony?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=Guikingone/CyclePath-Symfony&amp;utm_campaign=Badge_Grade)
[![CircleCI](https://circleci.com/gh/Guikingone/CyclePath-Symfony.svg?style=svg)](https://circleci.com/gh/Guikingone/CyclePath-Symfony)

## Usage

Once you've installed Docker, time to build the project.

This project use Docker environment files in order to allow the configuration according to your needs,
this way, you NEED to define a .env file in order to launch the build.

**_In order to perform better, Docker can block your dependencies installation and return an error
or never change your php configuration, we recommend to delete all your images/containers
before building the project_**

```bash
docker stop $(docker ps -a -q)
docker rm $(docker ps -a -q)
docker rmi $(docker images -a -q) -f # Only if you need to clean your images and containers stored locally.
```

**Note that this command can take several minutes before ending**

Once this is done, let's build the project.

```bash
cp .env.dist .env
```

Update the informations linked to Docker then use Docker-Compose :

```bash
docker-composer up -d --build --remove-orphans
```

Then you must use Composer in order to launch the application :

```bash
docker exec -it project_php-fpm sh

# Use Composer inside the container for better performances.
composer clear-cache
composer install --optimize-autoloader --apcu-autoloader
composer dump-autoload --optimize --apcu

# Configure BDD
./bin/console d:s:c # for classic users

# Fixtures
./bin/console d:f:l -n
```

Once this is done, access the project via your browser :

- Dev :

```
http://localhost:port/
```

**For the production approach, you must update the .env file and change the APP_ENV and APP_DEBUG keys.**

- Prod :

```
http://localhost:port/
```

If you need to perform some tasks:

```bash
docker exec -it project_php-fpm sh
```

Once in the container:

```bash
# Example for clearing the cache
./bin/console c:c --env=prod || rm -rf var/cache/*
```

**Please note that you MUST open a second terminal in order to keep git ou other commands line outside of Docker**

### PHP CLI

```bash
php bin/console s:r || ./bin/console s:r
```

Then access the project via your browser:

```
http://localhost:port/
```

**The commands listed before stay available and needed for this approach**

## Quality

As define in the internal guidelines, this project follow the more strict rules for
quality and best practices, this way, we include PHP-CS-FIXER for the code quality and PSR 
respect, here's the process to use it : 

```bash
docker exec -it container_php-fpm sh

# Once the container is launched
php-cs-fixer fix src/ # Every time you work on a new feature.
php-cs-fixer fix tests/ # Once you've added new tests
```

## Frontend

This project use React in order to manage the frontend part, this way, 
we use [Symfony/Encore]('https://symfony.com/doc/current/frontend.html').

- **Development** 

In order to achieve the development environment, we use Docker and NodeJS, once the project is build, let's compile the assets : 

```bash
./node_modules/.bin/encore dev --watch # Development approach using the watcher.
```

- **Production**

In production environment, the assets preparation is even easier, once the project is build and ready, just use
Encore shortcuts to build the production assets : 

```bash
./node_modules/.bin/encore production # Compiled once and optimized.
```

## Contributing

See [Contributing](contributing/contribution.md)

## Testing 

See [Testing](contributing/testing.md)

## Performances

See [Performances](contributing/performances.md)
