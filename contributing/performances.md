# Performances

This project use [Blackfire]('https://blackfire.io/') and Blackfire-Player in order to validate the performances aspect, 
this way, during development, here's the process : 

## Blackfire

A container is dedicated to Blackfire usage, this way, he can easily fetch the default HTTP server and see if the response
is reachable. 

During development, we need to ensure that every new features/bloc of code maintain the default "performance" of the application,
if a regression is detected, we need to patch it as soon as possible, in order to maintain the quality, here's the process : 

- **During the first launch**

```bash
blackfire config 
```

- **As soon as a new bloc of code is added :** 

```bash
docker exec -it projet_blackfire sh

blackfire config # Only with the first launch

Blackfire curl http://172.20.0.1:_port_/_locale_/_path_ --samples 20 
```

- **As soon as a new commit is created and ready to be pushed :** 

```bash
docker exec -it projet_blackfire sh

Blackfire curl http://172.20.0.1:_port_/_locale_/_path_ --samples 45
```

During the production usage, we need to validate that our code is well grabbed by the server and that no _bottleneck_
can be found, here's the process : 

- As soon as the production is updated : 

```bash
docker exec -it projet_blackfire sh

blackfire config # Only with the first launch

Blackfire curl http://_local_IP_:_port_/_locale_/_path_ --samples 45
```

By using 45 passes, we can easily compare with the development "final" stage, this way, if the code regress in production
mode, we can patch it during the next commit and improve the production. 

## Blackfire-Player

- **Development**

If your code is linked to the web application, make sure to add Blackfire inside your functional tests,
in order to ensure that every page is accessible, use Blackfire-Player : 

```bash
docker exec -it container_php-fpm sh

# Once the container is launched
blackfire-player run scenarios/dev.bkf --variable env=http://172.20.0.1:8080/ --full-report -v
```

- **Pre-Production**

As Blackfire-Player is dedicated to response and DOM crawling, we recommend to use the dedicated file : 

```bash
docker exec -it container_php-fpm sh

# Once the container is launched
blackfire-player run scenarios/prod.bkf --variable env=http://127.0.0.1:8000/ --full-report -v 
```

Blackfire-Player isn't configured to run on a production environment, plus, as we use functional tests, we can't compromise
our DB, in order to ease the process, only the pre-production phase is prepared to handle it. 
