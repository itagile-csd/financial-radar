
repo := itagilede/fradar-php
app_image := $(repo):latest
container := fradar

base_version := 3
base_image := $(repo):$(base_version)-base

component := server
pwd := $(shell pwd)


##################
# Getting started
##################

composer_image_wd := /app
install_dependencies:
	docker run --rm -v $(pwd)/$(component):$(composer_image_wd) composer/composer:1.1-alpine install

serve_dev:
	docker run --name $(container) --rm -p 8002 -v $(pwd)/$(component):/app $(base_image)

# opens both prod and dev servers
# this is Mac-specific
open:
	open http://localhost:$(shell docker port $(container) | cut -d':' -f2)


###################
# Common use cases
###################

before_commit: build_prod test

serve_most_recent_prod: pull_images server_prod


##################
# Other stuff
##################

build_base:
	cd $(component) && docker build -t $(repo):latest-base -t $(base_image) -f Dockerfile.base .
	$(MAKE) build_prod

build_prod:
	cd $(component) && docker build -t $(app_image) .

serve_prod:
	docker run --name $(container) --rm -p 8002 $(app_image)

pull_images:
	docker pull $(repo)

push_images:
	docker push $(repo)

.PHONY: test
test:
	docker-compose up --build -d
	docker-compose run test await -t 1s http://server:8002
	docker-compose down

