#!/bin/bash
cd laradock || exit; docker-compose up -d workspace caddy mariadb;
