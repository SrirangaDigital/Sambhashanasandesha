#!/usr/bin/perl

$host = $ARGV[0];
$db = $ARGV[1];
$usr = $ARGV[2];
$pwd = $ARGV[3];

print "Search Table\n";

use DBI();

my $dbh=DBI->connect("DBI:mysql:database=$db;host=$host","$usr","$pwd");
$sth_enc=$dbh->prepare("set names utf8");
$sth_enc->execute();
$sth_enc->finish();

$sth11=$dbh->prepare("drop table if exists searchtable");
$sth11->execute();
$sth11->finish(); 

$sth11=$dbh->prepare("CREATE TABLE searchtable(title varchar(500),
authid varchar(200),
authorname varchar(1000),
featid varchar(10),
text text,
page varchar(50),
cur_page varchar(10),
volume varchar(5),
issue varchar(10),
year varchar(10),
month varchar(10),
titleid varchar(30)) ENGINE=MyISAM character set utf8 collate utf8_general_ci");
$sth11->execute();
$sth11->finish();

$sth1=$dbh->prepare("select * from article order by titleid");
$sth1->execute();

while($ref=$sth1->fetchrow_hashref())
{
	$titleid = $ref->{'titleid'};
	$page = $ref->{'page'};
	$volume = $ref->{'volume'};
	$issue = $ref->{'issue'};
	$title = $ref->{'title'};
	$authid = $ref->{'authid'};
	$authorname = $ref->{'authorname'};
	$year = $ref->{'year'};
	$month = $ref->{'month'};
	$featid = $ref->{'featid'};
	$str = '';
	$title =~ s/'/\\'/g;
	$authorname =~ s/'/\\'/g;
	# print $year."\n";
	
	@pageRangeList = split(';',$page);
	
	for($i1=0;$i1<@pageRangeList;$i1++)
	{
		@pageRange = split('-',$pageRangeList[$i1]);
		$str .= $pageRange[0]."' and '".$pageRange[1]." or cur_page between ";
	}
	
	$str =~ s/ or cur_page between $//;
	$sth2=$dbh->prepare("select * from testocr where year='$year' and month='$month' and (cur_page between '$str')");
	$sth2->execute();
	
	while($ref2=$sth2->fetchrow_hashref())
	{
		$text = $ref2->{'text'};
		$text =~ s/'/\\'/g;
		$cur_page = $ref2->{'cur_page'};
			
		$sth4=$dbh->prepare("insert into searchtable values('$title','$authid','$authorname','$featid','$text','$page','$cur_page',
			'$volume','$issue','$year','$month','$titleid')");
		$text = '';
		$sth4->execute();
		$sth4->finish();
	}
	$sth2->finish();
}

$sth1->finish();
$dbh->disconnect();
