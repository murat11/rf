export COMPOSE=docker-compose -f docker/docker-compose.yml

up:
	$(COMPOSE) up -d

kill:
	$(COMPOSE) kill

build:
	$(COMPOSE) build

install:
	$(COMPOSE) exec -T php composer install

test:
	$(COMPOSE) exec -T php vendor/bin/phpunit tests/ --cache-result-file=var/cache/.phpunit.result.cache
