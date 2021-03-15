setup:
	composer install
	cp -n .env.example .env|| true
	php artisan key:gen --ansi
	touch database/database.sqlite
	php artisan migrate
	php artisan db:seed
	npm install
validate:
	composer validate
start:
	php artisan serve --host 0.0.0.0
migrate:
	php artisan migrate
console:
	php artisan tinker
test:
	php artisan test
deploy:
	git push heroku
lint:
	composer run-script phpcs -- --standard=PSR12 routes