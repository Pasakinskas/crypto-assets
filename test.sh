export DB_PORT=33061 DB_DATABASE=test DB_USERNAME=test DB_PASSWORD=test

php artisan migrate:fresh
php artisan db:seed
./vendor/bin/phpunit
