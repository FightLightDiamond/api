php -dmemory_limit=2G
php -d memory_limit=2512M /usr/local/bin/composer update
set COMPOSER_MEMORY_LIMIT=-1
composer config -g repo.packagist composer https://packagist.phpcomposer.com
