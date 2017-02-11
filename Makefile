
repo := itagilede/fradar-php
app_image := $(repo):latest
container := fradar

component := server
pwd := $(shell pwd)

##################
# Getting started
##################

composer_image_wd := /app
install_dependencies:
	docker run --rm -v $(pwd)/$(component):$(composer_image_wd) composer/composer:1.1-alpine install

serve_dev:
	docker run --name $(container) --rm -p 8000 -v $(pwd)/$(component):/app $(repo):latest-base

# opens both prod and dev servers
# this is Mac-specific
open:
	open http://localhost:$(shell docker port $(container) | cut -d':' -f2)


##################
# Other stuff
##################

build_base:
	cd $(component) && docker build -t $(repo):latest-base -f Dockerfile.base .

build_prod:
	cd $(component) && docker build -t $(app_image) .

serve_prod:
	docker run --name $(container) --rm -p 8000 $(app_image)

push_images:
	docker push $(repo)

.PHONY: test
test:
	docker-compose run test await -t 1s http://server:8000

