#!/bin/bash
composer update --no-interaction &&
composer dumpautoload --no-cache &&
/usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf