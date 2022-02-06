FROM php:8.1-rc-apache-buster

ARG USER=docker
ARG USER_UID=1000
ARG USER_GID=$USER_UID

RUN apt-get update && apt-get install -y


ENV APACHE_DOCUMENT_ROOT /home/${USER}

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

### SETUP CURRENT USER ###
RUN useradd -m ${USER} --uid=${USER_UID} | chpasswd
USER ${USER_UID}:${USER_GID}
WORKDIR /home/${USER}

