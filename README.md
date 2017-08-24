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
    * `country_payout`
    * `name`
2. Create a command that will take `Advertiser ID` as a parameter.
3. Command should fetch data from the specified endpoint and save the data within the entity.

#### Additional information

Routes to fetch data:

* `/advertiser/{advertiserId}/offers` to fetch all offers data by the given Advertiser
* `/advertiser/{advertiserId}/offer/{offerId}` to fetch one offer data by the given Advertiser
