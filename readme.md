# CRUD Products

This is a project controll products.

The project was developed using [Laravel](https://laravel.com/), so it has to be installer using Homestead or the specification recommended to install Laravel, that is:
* PHP >= 7.0
* OpenSSL PHP Extension
* PDO PHP Extension
* Mbstring PHP Extension

There must be a database system as well. So the products can be stored somewhere, right?

Clone or download the project and enter in the folder created:
```
cd /path-to/wherever-the/code-is
```  

There is a `.env.example` file, change it's name to `.env`, this is a standard behaviour from Laravel environment, and create the database that you put in this config file, OK?
```
mv .env.example .env
```  

Now we create a encryption key to the application
```
php artisan key:generate
```  

Clone or download the project and run the composer installer:
```
composer install
```  

Now whe create the tables at the database that is defined at `.env` running the command:
```
php artisan migrate --seed
```  

Now, if you want to know if it is all working, you can run the tests:
```
vendor/bin/phpunit
```  

Now just start the server and you can access it at your [Localhost](http://localhost:8000). Do your registration an start to create and edit the products. 
```
php artisan serve
```    

If there is any question/suggestion, please let me know. Can be via issue or via https://sandrogallina.com/.    