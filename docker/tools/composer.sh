#!/bin/bash

printf "Running composer $@ on Docker Composer Container: \n"

docker-compose run --rm composer $@