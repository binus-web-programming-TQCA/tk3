serve:
	php artisan cache:clear
	php artisan serve

dev:
	npm run dev

install:
	composer install
	php artisan key:generate
	php artisan migrate
	php artisan db:seed
	npm install
