# SQLi-injection-php

### Running with Docker-Compose
To run :
```
docker-compose up -d
```

To shut down :
```
docker-compose down

### Run without Docker Compose
When running without Docker Compose, you will need to build the image and the network first :
```
docker build -t sqli-PHP-webserver . &&
docker network create server_network
```

Then you can run the containers :
```
docker run --name postgres --network=server_network -e POSTGRES_DB=database -e POSTGRES_USER=user -e POSTGRES_PASSWORD=.UYr930Qr -p 5432:5432 -v $(pwd)/init.sql:/docker-entrypoint-initdb.d/init.sql -d postgres:16.0 &&
docker run --name pgadmin --network=server_network -e PGADMIN_DEFAULT_EMAIL=adminServer@email.com -e PGADMIN_DEFAULT_PASSWORD=1D4sNQ75J -p 5050:80 -v pgadmin_data:/var/lib/pgadmin -d dpage/pgadmin4:latest &&
docker run --name sqli-PHP-webServer --network=server_network -p 4000:80 -v $(pwd)/app:/var/www/html -d sqli-PHP-webserver 
```

To shut down the containers :
```
docker stop sqli-PHP-webServer && docker stop pgadmin && docker stop postgres
```

### Visiting the website
After running the containers correctly, you can visit the page at :
```
localhost:4000
```