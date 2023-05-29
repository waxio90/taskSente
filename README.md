# Task Sente

## Docker + Symfony + Bootstrap/Twig

## Instalation

1. If not already done, [install Docker Compose](https://docs.docker.com/compose/install/) (v2.10+)
2. Run command in terminal `git clone https://github.com/waxio90/taskSente.git`

## Running

1. Run `docker compose build --pull --no-cache` to build fresh images
2. Run `docker compose up -d`
3. Run command in terminal: `docker ps`
4. Copy name container php
5. Run command in terminal: `docker exec -it {paste_name_container_php} bash`
6. Run command in container: `composer install`
7. Exit container `ctrl + d` or command in container: `exit`
8. Run command in terminal: `docker ps`
9. Copy name container node
10. Run command in terminal: `docker exec -it {paste_name_cantainer_node}`
11. Run command in container: `yarn`
12. Run command in container: `yarn build`
13. Open `https://localhost:8080`)
