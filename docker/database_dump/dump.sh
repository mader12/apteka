#!/bin/sh
# MySQL - схема и данные
mysqldump -h database_mysql -u root -p"asd_123" -P 3306 --skip-comments apeks > /tmp/db.sql 2> /tmp/error.log
mv -f /tmp/db.sql /sql/mysql/db.sql

#PostgreSQL - только схема
pg_dump -h database_postgresql -p 5432 -U apeks -w -d apeks --schema=public --no-comments > /tmp/db.sql 2> /tmp/error.log
mv -f /tmp/db.sql /sql/postgresql/db.sql

echo "[$(date +%d.%m.%Y) $(date +%X)] Dump finished" >> /var/log/cron.log