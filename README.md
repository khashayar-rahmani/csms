# Charging station management system

This is an API service, used to manage charging stations, charging
processes and customers (so-called eDrivers) amongst other things.


## Usage
First make sure you have docker and docker compose on your machine.

Clone the project locally.

### Running the service

If you have any local config, navigate into the root of the project and copy .env.example as .env. Fill your local config in .env file.

To set up the whole stack, just issue the following command in the root of the project.

```
docker-compose up -d
```

The server will start listening on port 8000 of the host machine.

## API Documentation with OpenAPI V3

To generate Document files and Swagger UI run :

```
docker-compose exec app php artisan l5-swagger:generate
```

You can find the documentation on: http://localhost:8000/api/documentation

## Tests

There are two type of tests in this project.

### Unit Tests

To run unit tests, just issue the following command:

```
docker-compose exec app php artisan test --testsuite=Unit
```

### Feature Tests

To run feature tests, just issue the following command:

```
docker-compose exec app php artisan test --testsuite=Feature
```
