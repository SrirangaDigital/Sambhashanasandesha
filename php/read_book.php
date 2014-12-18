<?php

require_once('../../BookReader/BookReader.inc');
//assuming your book path is /data/b/bookid
 
$arch = $_GET['arch'];
$year = $_GET['year'];
$id = $_GET['id'];

//~ echo "Arch-->" . $arch . "<br />";
//~ echo "Year-->" . $year . "<br />";
//~ echo "Issue-->" . $id . "<br />";

$maindir = $arch . "/" . $year . "/" . $id;
//~ echo $maindir . "<br />";
$yearid = $year . "/" . $id;
$title = $year . "-" . $id;

BookReader::draw('70.85.191.122',
    $maindir,
    $yearid,
    '',
    $title);

?>
