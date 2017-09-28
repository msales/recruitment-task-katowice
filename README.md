recruitment-task-katowice
=========================

A Symfony project created on May 5, 2017, 12:28 pm.


### Installation

1. Install docker sync https://github.com/EugenMayer/docker-sync/wiki/1.-Installation (done once system wide)
2. Run `git clone git@github.com:msales/recruitment-task-katowice.git`
3. Add entry to /etc/hosts: `'127.0.0.1 msales-katowice-trial.app'`
4. Build docker containers and volume by running: `./init.sh`
5. Start unison sync along docker containers: `docker-sync-stack start`
6. Install composer dependencies: `./docker/tools/composer.sh install`
7. Run cache clear: `./docker/tools/cache_clear.sh`
8. Visit: `http://msales-katowice-trial.app:8082/app_dev.php`


### Usage

In order to use symfony console - use tool designed to it:

1. `./docker/tools/sf.sh --version`
2. App is available under `http://msales-katowice-trial.app:8082/app_dev.php`

You can also use one of the prepared statements like:
1. `./docker/tools/cache_clear.sh`
2. `./docker/tools/version.sh`
3. `./docker/tools/db-verify.sh`

This command runs destroys the container, runs the command, and creates new container.

## Task description

1. Create an `Offer` entity with the given fields:
    * `application_id`
    * `country`
    * `payout`
    * `name`
    * `platform`
2. Create a command that will take `Advertiser ID` as a parameter.
3. Command should fetch data from the specified endpoint and save the data within the entity.
4. Keep in mind that in the future we will have new Advertisers that should be integrated.

#### Requirements

* `payout` should be stored in USD
* `country` should be stored as ISO 3166-1 alpha-2
* `application_id` should be unique
* `platform` should be an enum `['Android', 'iOS']`

#### Additional information

* For `Advertiser` with `ID = 2` to get payout amount for each offer you have to calculate it from `points`, where
`10 points = $0.01`.

Example routes to fetch data:

* `/advertiser/{advertiserId}/offers` to fetch all offers data by the given Advertiser
* `/advertiser/{advertiserId}/offer/{offerId}` to fetch one offer data by the given Advertiser


### Command added

generate first database

``` 
./docker/tools/sf.sh doctrine:database:create
./docker/tools/sf.sh doctrine:schema:update --force
```

in order to let know the system where it has to fetch offers we need to figure IP out with that commands
`docker ps` => that lists all the containers
```
9001/tcp     recruitment-task-katowice-php
9f4593f14b83        recruitmenttaskkatowice_nginx   "nginx"                  2 hours ago         Up 12 minutes       443/tcp, 0.0.0.0:8082->80/tcp        recruitmenttaskkatowice_nginx_1
```
look at the line that is attending requests on port 80

`docker inspect 9f4593f14b83` => that shows info about the container

and look for the line that contains `"IPAddress": "x.x.x.x",`

in parameters.yml just declare the endpoint

    advertisers_endpoint: http://x.x.x.x/advertiser/{advertiserId}/offers

Attention, each time you start containers (or sync) that IP will change.

The command to fetch offers and populate them into DB is

`./docker/tools/sf.sh process:advertiser n`  being n the advertiser_id we want to populate


###### tests

