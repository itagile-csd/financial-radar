
image := fradar-dev
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
	cd $(component) && docker build -t fradar-base:latest -f Dockerfile.base .

build:
	cd $(component) && docker build -t $(image) .

serve:
	docker run --name $(container) --rm -p 8000 $(image)

open:
	open http://localhost:$(shell docker port $(container) | cut -d':' -f2)

