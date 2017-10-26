#!/bin/bash

printf "Running phpunit $@ on Docker Composer Container: \n"

docker-compose run --rm vendor phpunit -c app/ $@