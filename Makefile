
repo := itagilede/fradar-php
app_image := $(repo):latest
container := fradar

component := server
pwd := $(shell pwd)

composer_image := composer/composer:1.1-alpine
composer_wd := /app

bootstrap:
	docker run --rm -v $(pwd):$(composer_wd) $(composer_image) create-project --prefer-dist laravel/lumen $(component)

install_dependencies:
	docker run --rm -v $(pwd)/$(component):$(composer_wd) $(composer_image) install

build_base:
	cd $(component) && docker build -t $(repo):latest-base -f Dockerfile.base .

build:
	cd $(component) && docker build -t $(app_image) .

serve:
	docker run --name $(container) --rm -p 8000 $(app_image)

serve_dev:
	docker run --name $(container) --rm -p 8000 -v $(pwd)/$(component):/app $(repo):latest-base

open:
	open http://localhost:$(shell docker port $(container) | cut -d':' -f2)

push_images:
	docker push $(repo)

.PHONY: test
test:
	docker-compose run test await -t 1s http://server:8000

