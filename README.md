### QUANDO 

This is a small demo of a form processing app.
Due to lack of time parts are not finalized but can give you an idea and approach.

# Starting up docker 

To deploy this project on your local machine a docker-compose script is provided based on Alpine linux distribution.
### Components:
* [Alpine](https://alpinelinux.org/)
* [Apache2](https://httpd.apache.org/)
* [PHP-FPM](http://php-fpm.org/)
* [MySQL](http://www.mysql.com/)

Have latest docker/docker-compose installed on the machine.
Postition yourself in the docker sub folder where docker-compose.yml file is located.
to automatically build and boot up all servers use:

```docker-compose up -d```

To shutdown use:

```docker-compose down``` 

you will also need a composer image so if you do not have already:

```docker pull composer```

Position yourself in a project root directory where composer.json is installed and do a:
```
docker run --rm --interactive --tty \
     --volume $PWD:/app \
     composer update --ignore-platform-reqs
```
This will update your installation and install all needed files.

to test you can login into the php container and run tests using

```docker exec -it uniled-php-server ./code/vendor/phpunit/phpunit/phpunit ./code/tests/phpunit/```

To test the app, which is very sparse go to localhost port 80.
By default a form with 3 fields will show. if you enter username smaller than 3 or bigger than 10 characters error will be triggered.
If you enter invalid email address error will be triggered.

###No framework rule
No frameworks apart from phpunit testing framework were used.

###Validation
Simplified Domain design was used, where domain validation is delegated to a specific domain so the whole logic related to a domain is contained within domain object.

###Models
Models are related to database entities and use domains classes for field definitions. For the purpose of grouping error handling, 
validation on model level always provides information about errors related to a specific field.

###Forms
Forms wastly in this simple example wrap around the model, but are there to later on enable complcated multi model scenarios.

### bootstrap

a small bootstrap script will intialise an adhoc service container where you can map different database and email providers.

### Frontend 
Is simple HTML no graphics/css elements and it is missing CSRF or similar for duplicate submit control. No template framerowks/packages used. simple one page in-line implementation.

### Reason for docker setup
Basically easy install for development and possibility to use same docker container setup for deployment.
Solution is using separate PHP and HTTP servers so that you can test solutions using different versions of PHP using PHP FPM service instead of having PHP client called for each script run (no init time).
On production you can easily add more PHP servers on a load balancer while still using one web server to handle the load.

