
repo := itagilede/fradar-php
app_image := $(repo):latest
container := fradar

base_version := 4
base_image := $(repo):$(base_version)-base

component := server
pwd := $(shell pwd)

run := docker run --name $(container) --rm -p 8003


##################
# Getting started
##################

composer_image_wd := /app
install_dependencies:
	$(MAKE) composer cmd=install

serve_dev:
	$(run) -v $(pwd)/$(component):/app $(base_image)

# opens both prod and dev servers
# this is Mac-specific
open:
	open http://localhost:$(shell docker port $(container) | cut -d':' -f2)


###################
# Common use cases
###################

serve_most_recent_prod: pull_images server_prod


##################
# Other stuff
##################

build_base:
	cd $(component) && docker build -t $(base_image) -f Dockerfile.base .
	$(MAKE) build_prod

build_prod:
	cd $(component) && docker build -t $(app_image) .

serve_prod:
	$(run) $(app_image)

pull_images:
	docker pull $(repo)

push_images:
	docker push $(repo)

test_deployed:
	docker-compose up --build -d
	docker-compose run test await -t 1s http://server:8003

test_unit:
	$(run) -v $(pwd)/$(component):/app --entrypoint /app/vendor/bin/phpunit $(base_image) /app/tests

test_acceptance:
	$(run) -v $(pwd)/$(component):/app --entrypoint /app/vendor/bin/behat -w /app $(base_image) $(args)

test: test_unit test_acceptance test_deployed

composer:
	docker run --rm -v $(pwd)/$(component):$(composer_image_wd) composer/composer:1.1-alpine $(cmd)
	
