#!/bin/sh
# MySQL - схема и данные
mysqldump -h database_mysql -u root -p"asd_123" -P 3306 --skip-comments data > /tmp/db.sql 2> /tmp/error.log
mv -f /tmp/db.sql /sql/mysql/db.sql

echo "[$(date +%d.%m.%Y) $(date +%X)] Dump finished" >> /var/log/cron.log