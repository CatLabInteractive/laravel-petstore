# Laravel Charon REST API project
This project is built using
* https://github.com/laravel/laravel
* Charon

Installation
============
* `composer create-project catlabinteractive/laravel-charon api`
* Copy `.env.example` to `.env`
* Make sure to set APP_URL in your .env file **before you continue**, 
this will make sure the swagger oauth2 client is setup correctly. Also 
set your database credentials etc
* Run `php artisan migrate`

Getting started
===============
Navigate to your-project/docs to load the swagger documentation. You
will notice that there is one endpoint "/users" with one single action.

