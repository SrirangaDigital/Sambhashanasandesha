#!/usr/bin/perl

$host = $ARGV[0];
$db = $ARGV[1];
$usr = $ARGV[2];
$pwd = $ARGV[3];

print "Test OCR\n";

use DBI();

my $dbh=DBI->connect("DBI:mysql:database=$db;host=$host","$usr","$pwd");
$dbh->{'mysql_enable_utf8'} = 1;
$dbh->do('SET NAMES utf8');

$sth11=$dbh->prepare("drop table if exists testocr");
$sth11->execute();
$sth11->finish(); 

$sth11=$dbh->prepare("CREATE TABLE testocr(year varchar(5),
month varchar(10),
cur_page varchar(10),
text varchar(5000)) ENGINE=MyISAM");
$sth11->execute();
$sth11->finish(); 
@year = `ls Text`;

for($i1=0;$i1<@year;$i1++)
{
	print $year[$i1];
	chop($year[$i1]);
	@month = `ls Text/$year[$i1]/`;

	for($i2=0;$i2<@month;$i2++)
	{
		chop($month[$i2]);
		@files = `ls Text/$year[$i1]/$month[$i2]/`;

		for($i3=0;$i3<@files;$i3++)
		{
			chop($files[$i3]);
			if($files[$i3] =~ /\.txt/)
			{
				$yr = $year[$i1];
				$mon = $month[$i2];
				$cur_page = $files[$i3];
				open(DATA,"Text/$yr/$mon/$cur_page")or die ("cannot open Text/$yr/$mon/$cur_page");
				
				local $/;
				$content = <DATA>;
				$cur_page =~ s/\.txt//g;
				
				$line=<DATA>;
				$content =~ s/\\/\//g;
				$content =~ s/'/\\'/g;
				$content =~ s/\"/\\"/g;
				$content =~ s/\n/ /g;
				$content =~ s///g;
				$content =~ s///g;
				$content =~ s///g;
				$content =~ s/^\s+|\s+$//g;
				
				$sth1=$dbh->prepare("insert into testocr values ('$yr','$mon','$cur_page','$content')");
				$sth1->execute()  or die("Year $yr Month $mon Page $cur_page");
				$sth1->finish();
				close(DATA);
			}
		}
	}
}
