#!/bin/bash

# set encryption key
sed --in-place -e ':a' -e 'N' -e '$!ba' -e "s/'crypt' => \[\\n        'key' => '[a-z0-9]*'\\n    \],/'crypt' => \[\\n        'key' => 'ed71316f73e0b3bb2e3ebba961470c9c'\\n    \],/g" /magentonfs/magento/app/etc/env.php

# 前提 var/restore にバックアップファイルが一つだけ置いてある状態。
# リストアするファイルのUNIX_TIME部分を変数として取得する。
# TODO エラー処理など

cd /magentonfs/magento/var/restore/
BACKUP_FILE_NAME=`ls -al| grep '_media' |grep '.tgz'| sed -E 's/.* (([0-9]*)_media(|_.*).tgz)/\1/g'`
BACKUP_UNIX_TIME=`ls -al| grep '_media' |grep '.tgz'| sed -E 's/.* (([0-9]*)_media(|_.*).tgz)/\2/g'`

tar -zxvf /magentonfs/magento/var/restore/${BACKUP_FILE_NAME} > /dev/null
rm -rf /magentonfs/magento/var/restore/pub/media/catalog/product/cache > /dev/null
cp -rf /magentonfs/magento/var/restore/pub/media /magento/pub > /dev/null

mysql -h test-fec-instance-1.ce4roblr7nax.ap-southeast-1.rds.amazonaws.com -u admin -pArtemis-2019 magento < /magentonfs/magento/var/restore/${BACKUP_UNIX_TIME}_db.sql
mysql -h test-fec-instance-1.ce4roblr7nax.ap-southeast-1.rds.amazonaws.com -u admin -pArtemis-2019 magento < /magentonfs/magento/dev/tools/install_scripts/all_env_delete_personal_information.sql
mysql -h test-fec-instance-1.ce4roblr7nax.ap-southeast-1.rds.amazonaws.com -u admin -pArtemis-2019 magento < /magentonfs/magento/dev/tools/install_scripts/local_vagrant_overwrite_config.sql
mysql -h test-fec-instance-1.ce4roblr7nax.ap-southeast-1.rds.amazonaws.com -u admin -pArtemis-2019 magento < /magentonfs/magento/dev/tools/install_scripts/all_env_modify_admin_authorization_rule.sql

# モジュールのアップデート、コンパイルコマンド一式
cd /magentonfs/magento
php -dmemory_limit=2G ./bin/magento cache:flush
php -dmemory_limit=2G ./bin/magento indexer:reindex
php -dmemory_limit=2G ./bin/magento setup:upgrade
php -dmemory_limit=2G ./bin/magento setup:di:compile
php -dmemory_limit=2G ./bin/magento setup:static-content:deploy --jobs 10 -f th_TH en_US --theme Magento/backend --theme Feca/FecaAsia2
php -dmemory_limit=2G ./bin/magento maintenance:status
