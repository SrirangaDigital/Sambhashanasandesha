#!/bin/sh

host="localhost"
db="sandesha"
usr="root"
pwd="mysql"

echo "drop database sandesha; create database sandesha;" | /usr/bin/mysql -uroot -pmysql

perl author.pl $host $db $usr $pwd
perl feature.pl $host $db $usr $pwd
perl article.pl $host $db $usr $pwd
#perl login.pl $host $db $usr $pwd
