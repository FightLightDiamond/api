#!/usr/bin/env bash

pm2 start bash/start.sh  bash/laravel-echo.sh  bash/queue.sh bash/redis.sh

