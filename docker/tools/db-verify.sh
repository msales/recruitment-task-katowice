#!/bin/bash

printf "Running schema create on Docker PHP Container: \n"
printf "If it will throw handled exception saying database is already present - it means that connection works: \n"

docker-compose run --rm sf doctrine:database:create