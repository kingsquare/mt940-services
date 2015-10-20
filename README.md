# Kingsquare PHP MT940 service

This is a simple service for quickly testing out by parsing Mt940 files :)

Post an mt940 file and JSON the results ... could it be more simple?

# Local testing via docker

```
docker run -it --rm -w /app -v $(pwd):/app kingsquare/php-tools /composer install
docker run -it --rm -w /app -v $(pwd):/app -p 8080:8080 php:5.6-cli php -S 0.0.0.0:8080 

```