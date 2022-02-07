# tutorial-php8-1
Tutorial of PHP 8  
https://www.youtube.com/watch?v=4Nuyyoc2bPI

## Concepts seen in the tutorial 
* PHP 8
* MVC
* POO
* COMPOSER

# App
Simple app like Instagram

# Features
* User authentication

# Composer packages used
* bramus/router

# Deployment

First you have to download the repository 

    git clone https://github.com/demiancy/tutorial-php8-1.git

The repository have the files for deploy app in Docker, with the next command you start the app in the port 80

    docker-compose up

In case of not have Docker, you can copy the folder app into document root of your server

With the following command install the dependencies 

    docker-compose run php composer install
