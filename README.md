# Demo Warehouse project

The request was to create a product warehouse managing system using php.

### Requirements

- PHP ^7.4|^8.0
- Composer
- BCMath PHP Extension
- Ctype PHP Extension
- Fileinfo PHP extension
- JSON PHP Extension
- Mbstring PHP Extension
- OpenSSL PHP Extension
- PDO PHP Extension for Sqlite
- Tokenizer PHP Extension
- XML PHP Extension
- PDO_SQLITE PHP Extension

### Installation Guide

Run:

```
composer install
php artisan warehouse:install
npm install
npm run prod
php artisan serve
```

In order to be able to use the forget password flow you must provide an smtp server configuration in the .env file.

### Tests

Run:

```
php artisan test
```

