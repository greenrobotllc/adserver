#!/bin/bash
cd laradock || exit; docker-compose exec caddy tail -f /var/log/caddy/error.log
