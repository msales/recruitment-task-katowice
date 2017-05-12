#!/bin/bash

printf "Running permissions fixer on Docker Dev Permissions Container: \n"

docker-compose -f docker-compose.yml -f docker-compose-dev.yml run --rm dev_permissions /bin/chown www-data:www-data -R /msales/recruitment-task-katowice/var
