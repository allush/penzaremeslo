#!/usr/bin/env bash

function _exit {
  exit 0
}

function _app {
  success=false
  while [ "$success" = false ] ; do
    chmod -R 777 /app/protected/runtime && \
      chmod -R 777 /app/assets && \
      chmod -R 777 /app/src && \
      composer install && \
      bower install --allow-root && \
      protected/yiic migrate --interactive=0 && \
      php-fpm -D

    if [ "$?" = 0 ] ; then
      success=true
    else
      sleep 10
    fi
  done
}

trap _exit SIGTERM

_app &

while true ; do
  sleep 0.1
done
