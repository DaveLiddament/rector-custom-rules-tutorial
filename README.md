# Rector custom rules tutorial

This repository contains the code to support [Dave Liddament](https://twitter.com/daveliddament)'s Rector custom rules tutorial.


## Pre tutorial setup

1. Set up an environment with either PHP 8.2 or 8.3.
1. Clone this repository.
1. Run: `composer install`
1. Run all the checks. There is a composer script for this: `composer run-script all-checks`

You should see something similar to this:

```
$ composer run-script all-checks 
> composer validate --strict
./composer.json is valid
> vendor/bin/phpunit
PHPUnit 11.4.1 by Sebastian Bergmann and contributors.

Runtime:       PHP 8.2.24
Configuration: /home/dave/LampBristol/personal/rector-course/phpunit.xml

.                                                                   1 / 1 (100%)

Time: 00:00.002, Memory: 8.00 MB

OK (1 test, 1 assertion)
```

You're all good to go!

## Docker images

There are docker files that have been tested on docker for [MacOS](https://docs.docker.com/desktop/install/mac-install/).

### Build the container

```shell
docker compose build
```


### Start the container

```shell
docker compose up -d
```


### Run docker commands

```shell
docker compose exec php82 <command>
```

E.g.

```shell
# Composer install
docker compose exec php82 composer install

# Run all CI checks
docker compose exec php82 composer all-checks

# Run the tests
docker compose exec php82 vendor/bin/phpunit

# Run rector
docker compose exec php82 vendor/bin/rector
```