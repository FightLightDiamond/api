ifndef u
u:=sotatek
endif

ifndef env
env:=dev
endif

OS:=$(shell uname)

docker-start:
	cp laravel-echo-server.json.example laravel-echo-server.json
	@if [ $(OS) = "Linux" ]; then\
		sed -i -e "s/localhost:8000/web:8000/g" laravel-echo-server.json; \
		sed -i -e "s/\"redis\": {}/\"redis\": {\"host\": \"redis\"}/g" laravel-echo-server.json; \
	else\
		sed -i '' -e "s/localhost:8000/web:8000/g" laravel-echo-server.json; \
		sed -i '' -e "s/\"redis\": {}/\"redis\": {\"host\": \"redis\"}/g" laravel-echo-server.json; \
	fi
	docker-compose up -d

docker-restart:
	docker-compose down
	make docker-start
	make docker-init-db-full
	make docker-link-storage

docker-connect:
	docker exec -it cuongpmapi bash

docker-redis:
	docker exec -it api_redis_1 ash

init-app:
	cp .env.example .env
	composer install
	php artisan key:generate
	php artisan passport:keys --force
	php artisan migrate
	php artisan db:seed
	php artisan storage:link

docker-init:
	git submodule update --init
	docker exec -it cuongpmapi-api make init-app
	rm -rf node_modules
	npm install

init-db-full:
	make autoload
	php artisan migrate:fresh
	make update-master
	php artisan db:seed
	./bin/import_seed_data.sh

gen-i18n:
	php artisan vue-i18n:generate

docker-gen-i18n:
	docker exec -it cuongpmapi-api make gen-i18n

docker-init-db-full:
	docker exec -it cuongpmapi-api make init-db-full

docker-link-storage:
	docker exec -it cuongpmapi-api php artisan storage:link

init-db:
	make autoload
	php artisan migrate:fresh

start:
	php artisan serve

log:
	tail -f storage/logs/laravel.log

test-js:
	npm test

test-php:
	vendor/bin/phpcs --standard=phpcs.xml && vendor/bin/phpmd app text phpmd.xml

build:
	npm run dev

watch:
	npm run watch

docker-watch:
	docker exec -it cuongpmapi-api make watch

autoload:
	composer dump-autoload

cache:
	php artisan cache:clear && php artisan view:clear

docker-cache:
	docker exec cuongpmapi-api make cache

route:
	php artisan route:list

generate-master:
	php bin/generate_master.php $(lang)

update-master:
	php artisan master:update $(lang)
	make cache

compile:
	ssh $(u)@$(h) "cd $(dir) && npm install && composer install && make cache && make autoload && npm run production"
