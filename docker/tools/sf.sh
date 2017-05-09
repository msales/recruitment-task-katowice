#!/bin/bash

printf "Running app/console $@ on Docker PHP Container: \n"

docker-compose run --rm php $@