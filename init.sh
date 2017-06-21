#!/bin/sh

# Build container and run compose up.
docker-compose -f docker-compose.yml -f docker-compose-dev.yml build && docker volume create --name=recruitment-task-katowice