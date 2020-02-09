#!/bin/bash
bash start.sh
cd laradock || exit; docker-compose up certbot
