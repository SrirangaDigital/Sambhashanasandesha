#!/bin/sh

host="localhost"
db="sandesha"
usr="root"
pwd="mysql"

echo "drop database if exists sandesha; create database sandesha DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_general_ci;" | /usr/bin/mysql -uroot -pmysql
#~ 
perl author.pl $host $db $usr $pwd
perl feature.pl $host $db $usr $pwd
perl article.pl $host $db $usr $pwd
perl ocr.pl $host $db $usr $pwd
perl searchtable.pl $host $db $usr $pwd
perl wordInsert.pl $host $db $usr $pwd
echo "create fulltext index text_index on searchtable (text);" | /usr/bin/mysql -uroot -pmysql sandesha
echo "create fulltext index word_index on word (word);" | /usr/bin/mysql -uroot -pmysql sandesha

