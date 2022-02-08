# tutorial-php8-1
Tutorial of PHP 8  
https://www.youtube.com/watch?v=4Nuyyoc2bPI

## Concepts seen in the tutorial 
* PHP 8
* MVC
* POO
* COMPOSER

## Notes
* I used Docker.
* I changed the file structure a bit to give it a better order.
* In UtilImages added second param for folder of image store.
* I tried to reduce and refactor the code in several parts.
* In post and get methods of Controller, add default value param.
* In Controller, add method currentUser.
* In User model, add methods getByUsername y getById.

# App
Simple app like Instagram

# Features
* User authentication

# Composer packages used
* bramus/router
* vlucas/phpdotenv

# Deployment

First you have to download the repository 

    git clone https://github.com/demiancy/tutorial-php8-1.git

The repository have the files for deploy app in Docker, with the next command you start the app in the port 3000

    docker-compose up

In case of not have Docker, you can copy the folder app into document root of your server

With the following command install the dependencies 

    docker-compose run php composer install

In the repository you have the export of the data base used in this tutorial.

To set the data base access, you create the file app/src/config/.env (You can use .env.example as an example).