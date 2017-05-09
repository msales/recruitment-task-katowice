#!/bin/bash

printf "Running composer $@ on Docker Container using EXEC: \n"

docker-compose run --rm php composer $@