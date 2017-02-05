
container_name := fradar

component := server
pwd := $(shell pwd)

bootstrap:
	docker run --rm -v $(pwd):/app composer/composer:1.1-alpine create-project --prefer-dist laravel/lumen $(component)

serve:
	docker run --name $(container_name) --rm -p 8000 -v $(pwd)/$(component):/app php:7.1-alpine php -S 0.0.0.0:8000 -t /app/public

open:
	open http://localhost:$(shell docker port $(container_name) | cut -d':' -f2)

