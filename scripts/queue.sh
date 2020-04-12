#!/usr/bin/env bash

php artisan queue:work --tries=2 --daemon