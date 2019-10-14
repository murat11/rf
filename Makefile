export COMPOSE=docker-compose -f docker/docker-compose.yml

build:
	$(COMPOSE) build
	$(COMPOSE) run --rm php composer install

test:
	$(COMPOSE) run --rm php vendor/bin/phpunit tests/ --cache-result-file=var/cache/.phpunit.result.cache

run:
	$(COMPOSE) run --rm php bin/console   salary:calculate  Alice 6000 26 2 0
	$(COMPOSE) run --rm php bin/console   salary:calculate  Bob 4000 52 0 1
	$(COMPOSE) run --rm php bin/console   salary:calculate  Charlie 5000 36 3 1
