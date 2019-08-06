
# HOW TO BUILD / USE THIS CODE

1. Download Laravel Depedency
```console
composer install
```

2. Generate Keygen
 ```console
php artisan key:generate
```


4. create .env file from .env.example file template and setup database config (host, username, password)

5. Run your MySQL Services ( Use XAMPP, MAMP, etc)

6. Run Migration to generate table
```console
php artisan migrate
```

7. run laravel project
```console
php -S localhost:8000 -t public
```


