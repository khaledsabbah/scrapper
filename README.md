# InternsVally Pre-Interview Task
-  Create a php crawler to extract the links with specific filters

# Dev-Ops Description :
- Docker & docker-compose. 
- register services  ``php-fpm ``, ``nginx``
- Link each service to service registry .
- Monitor health check and reload service if it's down .

# Perquisite
- Docker & docker-compose 


# Install
- `git clone https://github.com/khaledsabbah/scrapper.git`
- `cd scrapper`
- `cd docker`
- `docker-compose up`
- You should see the following image
![alt text](https://raw.githubusercontent.com/khaledsabbah/Edfa3lyTask/master/images/docker.png)

- Open docker container for php with the following command 
    
    -`docker exec -it docker_php_1 /bin/bash`
    - Run following commands
       
        - `mv .env.example  .env`
        - `./install.sh`
        - `php artisan key:generate`
        - `php artisan config:cache`
        
#Running
- server url :   `http://localhost:8089`

# Tests:

- Open the container again with :  `docker exec -it docker_php_1 /bin/bash`
- Then run: `./vendor/bin/phpunit ` 
    
            eg. :   `./vendor/bin/phpunit `
## Code Desgin and Architect
I tried to apply S.O.L.D principles & use some design pattern and Hydrate everything into object as possible.

## Patterns:
- ``Service layer`` : for calling repository if any and aggregate multiple processes.

    ``And the other framework specs like MVC, Models, Exceptions...`` 

# WorkFlow

   
    
# TODO :
-