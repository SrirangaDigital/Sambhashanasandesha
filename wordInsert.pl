#!/usr/bin/perl

$host = $ARGV[0];
$db = $ARGV[1];
$usr = $ARGV[2];
$pwd = $ARGV[3];

print "Word Insertion\n";

use DBI();

my $dbh=DBI->connect("DBI:mysql:database=$db;host=$host","$usr","$pwd");
$dbh->{'mysql_enable_utf8'} = 1;
$dbh->do('SET NAMES utf8');

$sth11=$dbh->prepare("drop table if exists word");
$sth11->execute();
$sth11->finish(); 

$sth11=$dbh->prepare("CREATE TABLE word(year varchar(5),
month varchar(10),
height varchar(10),
width varchar(10),
pagenum varchar(10),
cords varchar(25),
word varchar(50),
wordid int(10) NOT NULL AUTO_INCREMENT,
PRIMARY KEY (wordid))AUTO_INCREMENT=1001  ENGINE=MyISAM");
$sth11->execute();
$sth11->finish(); 
@year = `ls Volumes_xml`;

for($i1=0;$i1<@year;$i1++)
{
	print $year[$i1];
	chop($year[$i1]);
	$yr = $year[$i1];
	
	@month = `ls Volumes_xml/$year[$i1]/`;

	for($i2=0;$i2<@month;$i2++)
	{
		chop($month[$i2]);
		$mon = $month[$i2];
		@files = `ls Volumes_xml/$year[$i1]/$mon`;
		for($i3 = 0; $i3 < @files; $i3++)
		{
			chop($files[$i3]);
			$file = $files[$i3];
			open(IN,"Volumes_xml/$yr/$mon/$file")or die ("cannot open Volumes_xml/$yr/$mon/$file");
			$line = <IN>;
			while($line)
			{
				if($line =~ /<OBJECT data="(.*)" type="(.*)" height="(.*)" width="(.*)" usemap="(.*).djvu" >/)
				{
					$height = $3;
					$width = $4;
					$page = $5;
				}
				elsif($line =~ /<WORD coords="(.*)">(.*)<\/WORD>/)
				{
					$cords = $1;
					$word = $2;
					insert_word($yr,$mon,$height,$width,$page,$cords,$word);
				}
				$line = <IN>;
			}
			close(IN);
		}
	}
}
$dbh->disconnect();

sub insert_word()
{
	my($yr,$mon,$height,$width,$page,$cords,$word) = @_;

	$word =~ s/\\/\//g;
	$word =~ s/'/\\'/g;
	$word =~ s/\"/\\"/g;
	$word =~ s/\n/ /g;
	$word =~ s///g;
	$word =~ s///g;
	$word =~ s///g;
	$word =~ s/^\s+|\s+$//g;
	
	my($sth1,$sth);

	$sth = $dbh->prepare("insert into word values('$yr','$mon','$height','$width','$page','$cords','$word','')");
	$sth->execute();
	$sth->finish();
}

