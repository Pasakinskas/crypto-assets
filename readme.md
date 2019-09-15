## Installation

Use composer to install dependencies: `composer install`

Start development database: `bash ./start_dev_db.sh` (MariaDB Docker image)

Migrate and seed local database and start the app:

```
php artisan migrate:fresh
php artisan db:seed
bash ./start.sh
```

In case Docker is not available, change database config in `.env`

## Tests
Start a test database: `bash ./start_test_db.sh` 

Run the tests using phpunit: `bash ./test.sh`

In case Docker is not available, change test database config in test.sh
