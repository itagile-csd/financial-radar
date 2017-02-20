
repo := itagilede/fradar-php
app_image := $(repo):latest
container := fradar

base_version := 4
base_image := $(repo):$(base_version)-base

component := server
pwd := $(shell pwd)

run_fradar := docker run --name $(container) --rm -p 8003

is_docker_machine_active = $(shell docker-machine active 2> /dev/null)


##################
# Getting started
##################

composer_image_wd := /app
install_dependencies:
	$(MAKE) composer cmd=install

serve_dev_command = $(run_fradar) -v $(pwd)/$(component):/app $(base_image)
serve_dev:
ifeq ($(is_docker_machine_active), 0)
	bash -c "trap 'echo \"Stopping and removing $(container)…\" && docker stop $(container) > /dev/null && docker rm $(container) > /dev/null && echo \"Stopped and removed $(container).\"' EXIT; $(serve_dev_command)"
else
	$(serve_dev_command)
endif

host = $(is_docker_machine_active && shell docker-machine ip)
ifeq ($(host),)
	host = localhost
endif
port = $(shell docker port $(container) | cut -d':' -f2)
# works for both prod and dev servers
open:
	http-prompt http://$(host):$(port)


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
	$(run_fradar) $(app_image)

pull_images:
	docker pull $(repo)

push_images:
	docker push $(repo)

test_smoke:
	docker-compose up --build -d
	docker-compose run smoke_tester await -t 1s http://server:8003

test_unit:
	$(MAKE) run_within_image vendor_binary=phpunit args='--colors=always tests'

run_within_image:
	docker run --rm -v $(pwd)/$(component):/app -w /app --entrypoint /app/vendor/bin/$(vendor_binary) $(base_image) $(args)

test_acceptance:
	$(MAKE) run_within_image vendor_binary=behat args='--colors'

test_quick: test_unit test_acceptance
test_all: test_quick test_smoke

composer:
	docker run --rm -v $(pwd)/$(component):$(composer_image_wd) composer/composer:1.1-alpine $(cmd)

