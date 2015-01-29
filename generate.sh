#!/bin/sh

host="localhost"
db="sandesha"
usr="root"
pwd="mysql"

echo "drop database if exists sandesha; create database sandesha DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_general_ci;" | /usr/bin/mysql -uroot -pmysql

perl author.pl $host $db $usr $pwd
perl feature.pl $host $db $usr $pwd
perl article.pl $host $db $usr $pwd
#perl login.pl $host $db $usr $pwd
