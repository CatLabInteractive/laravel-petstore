# Laravel Charon REST API project
This project is built using
* https://github.com/laravel/laravel
* Charon

Installation
============
* Checkout this project
* Run composer install
* Make sure to set APP_URL in your .env file **before you continue**, 
this will make sure the swagger oauth2 client is setup correctly. Also 
set your database credentials etc
* Run php artisan migrate

Getting started
===============
Navigate to your-project/docs to load the swagger documentation. You
will notice that there is one endpoint "/users" with one single action.

