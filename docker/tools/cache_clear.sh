#!/bin/bash

docker/tools/sf.sh c:c -e dev
docker exec -it recruitment-task-katowice-php chown -R www-data:www-data /msales