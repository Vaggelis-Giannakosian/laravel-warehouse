# Demo Warehouse project

The assignment was to create a product warehouse managing system using php. More information can be found into warehouse_assignment.docx

### Requirements

- PHP >= 7.4
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
- Node.js >= 14

### Installation Guide

Run:

```
composer install
php artisan warehouse:install
npm install
npm run prod
php artisan serve
```
Admin User credentials:

username: "_admin_" 

password: "_password_"

In order to be able to use the forget password flow you must provide an smtp server configuration in the .env file.

### Tests

Run:

```
php artisan test
```

