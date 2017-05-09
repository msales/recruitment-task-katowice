#!/bin/bash

printf "Running $@ on Docker Container: \n"

docker-compose run --rm php $@