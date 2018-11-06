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
![alt text](https://raw.githubusercontent.com/khaledsabbah/scrapper/master/images/docker.png)

- Open docker container for php with the following command 
    
    -`docker exec -it docker_php_1 /bin/bash`
    - Run following commands
       
        - `mv .env.example  .env`
        - `./install.sh`
        - `php artisan key:generate`
        - `php artisan config:cache`
        
# Running
- server url :   `http://localhost:8089`
- Simple Task endpoint :  

        `http://localhost:8089/api/v1/simpleTask`

# Tests:

- Open the container again with :  `docker exec -it docker_php_1 /bin/bash`
- Then run: `./vendor/bin/phpunit ` 
    
            eg. :   `./vendor/bin/phpunit `
## Code Desgin and Architect
I tried to apply S.O.L.D principles & use some design pattern (eg: Factory Pattern , Filter Design Patterns, ) and Hydrate everything into object as possible.

## Patterns:
- ``Service layer`` : for aggregating multiple processes that do our logic.
- ``Transformer`` : Transform response object to and JSONable type like Array .
-  ``Factory`` : to create object of the Criteria filter on the fly .
- ``Contracts`` : to write the rules, our classes & services will follow .
- ``Entities`` : used as ValueObj to represent things or needs into objects 

    ``And the other framework specs like MVC, Models, Exceptions...`` 

###  Usage
* Go to the browser and write endpoint url but in  ``http://localhost:8089/api/v1/simpleTask`` ;
    > ``` You will see an output like that```
            
            {
                "lastPaginationNumber": 50,
                "pages": {
                "1": {
                    "pageNum": 1,
                    "pageLinks": [
                        "/mieten/109292075",
                        "/mieten/109292918",
                        "/mieten/109323437",
                        "/mieten/108081542",
                        "/mieten/109321000",
                        "/mieten/109327974",
                        ....
                    ]
                },
                ...
            }

    
# WorkFlow

    - `Controller` call `Service` function to fetch data .
    - `Entities` used to hydrate data .
    - `Service` used do our logic search over the Entities objects 
    - `Transformers` used to transform the result in the targetted Entity Output.
    -  Return the transformer Output to the controller again .
    -  Respond with Output as JSON 
   
    
# TODO :
- Making this task as a cronjob and use monit to minitor background demons statuses
- use DB to insert the crawled data in order to be retrieved faster
