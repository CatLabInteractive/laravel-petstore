# Laravel Charon REST API project
[![Build Status](https://travis-ci.org/CatLabInteractive/laravel-charon.svg?branch=master)](https://travis-ci.org/CatLabInteractive/laravel-charon)

This project is built using
* https://github.com/laravel/laravel
* https://github.com/CatLabInteractive/charon

Installation
============
* `composer create-project catlabinteractive/laravel-charon api`
* Copy `.env.example` to `.env`
* Make sure to set APP_URL in your .env file **before you continue**, 
this will make sure the swagger oauth2 client is setup correctly. Also 
set your database credentials etc
* Run `php artisan key:generate`
* Run `php artisan migrate`

Getting started
===============
Navigate to your-project/docs to load the swagger documentation.