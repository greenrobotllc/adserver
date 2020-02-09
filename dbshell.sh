#!/bin/bash
cd laradock || exit; docker-compose exec mariadb mysql -uroot -proot
