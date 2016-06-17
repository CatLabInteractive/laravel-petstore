# Laravel Charon Pet Store
Example project for Laravel [Charon](https://github.com/CatLabInteractive/charon).

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