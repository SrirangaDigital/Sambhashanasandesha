#!/usr/bin/perl 

$host = $ARGV[0];
$db = $ARGV[1];
$usr = $ARGV[2];
$pwd = $ARGV[3];


use DBI();

open(IN, "sandesha.xml") or die "can't open sandesha.xml\n";

$dbh=DBI->connect("DBI:mysql:database=$db;host=$host","$usr","$pwd");

$sth11=$dbh->prepare("CREATE TABLE author(authorname varchar(400),
sal varchar(100),
authid int(10) NOT NULL AUTO_INCREMENT,
PRIMARY KEY (authid))AUTO_INCREMENT=1001");

$sth11->execute();
$sth11->finish();

$line = <IN>;

while($line)
{
	if($line =~ /<author type="(.*)" sal="(.*)">(.*)<\/author>/)
	{
		$type = $1;
        $sal = $2;
		$authorname = $3;

		insert_author($authorname,$sal);
	}
	$line = <IN>;
}
close(IN);
$dbh->disconnect();

sub insert_author()
{
	my($authorname,$sal) = @_;

	$authorname =~ s/'/\\'/g;
	my($sth1,$sth);

	$sth = $dbh->prepare("select authid from author where authorname='$authorname' and sal='$sal'");
	$sth->execute();
	if($sth->rows() == 0)
	{
		$sth1=$dbh->prepare("insert into author values('$authorname','$sal','')");
		$sth1->execute();
		$sth1->finish();
	}
	$sth->finish();
}
