#!/usr/bin/env bash

redis-server /usr/local/etc/redis.conf
CONFIG SET dir /tmp/
CONFIG SET dbfilename temp.rdb
config set stop-writes-on-bgsave-error no