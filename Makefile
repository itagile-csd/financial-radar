
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

host := $(shell docker-machine ip)
host ?= localhost

# works for both prod and dev servers
# this is Mac-specific
open:
	http-prompt http://localhost:$(shell docker port $(container) | cut -d':' -f2)


###################
# Common use cases
###################

serve_most_recent_prod: pull_images serve_prod


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
	$(MAKE) run_within_image vendor_binary=phpunit args=tests

run_within_image:
	$(run) -v $(pwd)/$(component):/app -w /app --entrypoint /app/vendor/bin/$(vendor_binary) $(base_image) $(args)

test_acceptance:
	$(MAKE) run_within_image vendor_binary=behat

test: test_unit test_acceptance test_deployed

composer:
	docker run --rm -v $(pwd)/$(component):$(composer_image_wd) composer/composer:1.1-alpine $(cmd)

