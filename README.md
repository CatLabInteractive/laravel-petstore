# Laravel Charon Pet Store
[![Build Status](https://travis-ci.org/CatLabInteractive/laravel-petstore.svg?branch=master)](https://travis-ci.org/CatLabInteractive/laravel-petstore)

Example project for Laravel [Charon](https://github.com/CatLabInteractive/charon).

Live example at http://petstore.catlab.eu/docs

Installation
------------
1. Clone project
2. Copy `.env.example` to `.env`
3. Make sure to set APP_URL in your .env file **before you continue**, 
this will make sure the swagger oauth2 client is setup correctly. Also 
set your database credentials etc
4. Run `php artisan key:generate`
5. Run `php artisan migrate --seed`
6. Done!

API Description
---------------
Navigate to `your-host/docs` to load the swagger API documentation.

Starting a new RESTful API?
---------------------------
This project is just an example. We have an empty 'new project' 
available (https://github.com/catlabinteractive/laravel-charon[here] that 
will get you up and running in no time.