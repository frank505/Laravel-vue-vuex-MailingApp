For the Api be sure to have docker installed on your machine and then you can run ./vendor/bin/sails up to launch the Api.
This sets up mysql,php,redis.
To see your redis cached data please run docker exec command on the redis container.

To start the front end application run:

docker run -it -p 8080:8080 --rm --name alias_name_for_container docker_username/docker_container_name
