#!/usr/bin/perl 

print "Article Insertion\n";

$host = $ARGV[0];
$db = $ARGV[1];
$usr = $ARGV[2];
$pwd = $ARGV[3];

use DBI();

open(IN, "sandesha.xml") or die "can't open sandesha.xml\n";

$dbh=DBI->connect("DBI:mysql:database=$db;host=$host","$usr","$pwd");
$sth_enc=$dbh->prepare("set names utf8");
$sth_enc->execute();
$sth_enc->finish();

$sth11=$dbh->prepare("CREATE TABLE article(volume varchar(5), 
issue varchar(10), 
month varchar(50),
year varchar(50),
title varchar(5000),
featid varchar(20),
page varchar(50),
page_end varchar(50),
authorname varchar(5000),
authid varchar(500),
titleid int(50) not null auto_increment,
primary key (titleid)) auto_increment=10001 ENGINE=MyISAM character set utf8 collate utf8_general_ci");

$sth11->execute();
$sth11->finish();

$line = <IN>;

while($line)
{
	if($line =~ /<volume vnum="(.*)">/)
	{
		$vnum = $1;
	}
	elsif($line =~ /<\/volume>/)
	{
		$vnum = "";
	}
	elsif($line =~ /<issue inum="(.*)" month="(.*)" year="(.*)">/)
	{
		$inum = $1;
		$month = $2;
		$year = $3
	}
	elsif($line =~ /<\/issue>/)
	{
		$inum = "";
		$month = "";
		$year = "";
	}
	elsif($line =~ /<title>(.*)<\/title>/)
	{
		$title = $1;
	}
	elsif($line =~ /<feature>(.*)<\/feature>/)
	{
		$featurename = $1;
		$fid = get_fid($featurename);
	}
	elsif($line =~ /<page>(.*)-(.*), (.*)-(.*)<\/page>/)
	{
		$page = $1;
		$page_end = $2;
	}
	elsif($line =~ /<page>(.*)-(.*)<\/page>/)
	{
		$page = $1;
		$page_end = $2;
	}
	elsif($line =~ /<author type="(.*)" sal="(.*)">(.*)<\/author>/)
	{
		$type = $1;
        $sal = $2;
		$auth = $3;
		$authname = $authname . "!!!" . $type . ";" . $auth . ";" . $sal;
		$authid = $authid . ";" . get_author($auth);
	}
	elsif($line =~ /<allauthors\/>/)
	{
		$authid = "0";
		$authname = "";
	}
	elsif($line =~ /<\/entry>/)	
	{
		insert_article($vnum,$inum,$month,$year,$title,$fid,$page,$page_end,$authname,$authid);
		$title = "";
		$fid = "";
		$page = "";
		$page_end = "";
		$authname = "";
		$authid = "";
	}	
	
	$line = <IN>;
}
close(IN);
$dbh->disconnect();

sub insert_article()
{
	my($vnum,$inum,$month,$year,$title,$fid,$page,$page_end,$authname,$authid) = @_;
	my($sth1);

	$title =~ s/'/\\'/g;
	$authname =~ s/'/\\'/g;
	$authname =~ s/^!!!//;
	$authid =~ s/^;//;
	

	$sth1=$dbh->prepare("insert into article values('$vnum','$inum','$month','$year','$title','$fid','$page','$page_end','$authname','$authid','')");
	$sth1->execute();
	
	$sth1->finish();
}

sub get_author()
{
	my($authorname) = @_;
	my($sth,$authid);

	$authorname =~ s/'/\\'/g;
	$sth = $dbh->prepare("select authid from author where authorname='$authorname' and sal='$sal'");
	$sth->execute();

	$row = $sth->fetchrow_hashref();
	$authid = $row->{'authid'};
	$sth->finish();
	return($authid);
}

sub get_fid()
{
	my($featurename) = @_;
	my($sth,$fid);

	$featurename =~ s/'/\\'/g;

	$sth = $dbh->prepare("select featid from feature where featurename='$featurename'");
	$sth->execute();

	$row = $sth->fetchrow_hashref();
	$fid = $row->{'featid'};
	$sth->finish();
	return($fid);
}
