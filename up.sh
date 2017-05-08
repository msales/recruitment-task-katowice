#!/bin/bash

RED='\033[0;31m'
NC='\033[0m'

docker-compose build
docker-compose up -d
docker-compose exec php bash -c 'composer install'
docker-compose exec php bash -c './bin/console doctrine:schema:update --force'  

HOST="127.0.0.1 msales-katowice-trial.app\n"
printf "\n"
printf "${RED}Success! Please add following entry to your /etc/hosts: $HOST"
printf "\n"