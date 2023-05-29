# Task Sente

## Docker + Symfony + Bootstrap/Twig

## Instalation

1. If not already done, [install Docker Compose](https://docs.docker.com/compose/install/) (v2.10+)
2. Run command in terminal `git clone https://github.com/waxio90/taskSente.git`

## Running

1. Run command in terminal: `cd taskSente`
2. Run `docker compose build --pull --no-cache` to build fresh images
3. Run `docker compose up -d`
4. Run command in terminal: `docker ps`
5. Copy name container php
6. Run command in terminal: `docker exec -it {paste_name_container_php} bash`
7. Run command in container: `composer install`
8. Exit container `ctrl + d` or command in container: `exit`
9. Run command in terminal: `docker ps`
10. Copy name container node
11. Run command in terminal: `docker exec -it {paste_name_cantainer_node}`
12. Run command in container: `yarn`
13. Run command in container: `yarn build`
14. Exit container `ctrl + d` or command in container: `exit`
15. Open in browser`https://localhost:8080`)
