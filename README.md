#### Entity Relationship Diagram
[![ERD](https://raw.githubusercontent.com/ngalambackend/ngalambackend/master/ngalambackend-erd.png?token=ACMF5BFLOYKTPYIJVDDJQNS7CRRE4)](https://raw.githubusercontent.com/ngalambackend/ngalambackend/master/ngalambackend-erd.png?token=ACMF5BFLOYKTPYIJVDDJQNS7CRRE4)

#### How to install
1. Run this command in your terminal to enter the application folder
	```
	cd ngalambackendcommunity
    ```
2. Setup Env. Copy `.env.example` to new file `.env`
    ```
    cp .env.example .env
    ```
3. Setup database
    ```
    DB_DATABASE=db_ngalambackend
    DB_USERNAME=root
    DB_PASSWORD=password
    ```
4. Install composer
	```
	composer install
	```
5. Generate new key
    ```
    php artisan key:generate
    ```
6. Generate Tables
	```
	php artisan migrate
    ```
7. Insert datas using seeder 
    ```
    php artisan db:seed
    ```
8. Run your web with this command
    ```
    php artisan serve
    ```
    After that, you can see the url like : `http://127.0.0.1:8000` and open url link in your browser

#### Credits
* [Laravel 7](https://laravel.com/docs/7.x "Laravel 7")
* [Stisla](https://getstisla.com/ "Stisla")
* [Laravel SweetAlert](https://github.com/uxweb/sweet-alert "Laravel SweetAlert")
* [Ramsey UUID](https://github.com/ramsey/uuid "Ramsey UUID")

#### Contributors
* [Crew](https://github.com/ngalambackend/ngalambackendcommunity/graphs/contributors "Crew")
