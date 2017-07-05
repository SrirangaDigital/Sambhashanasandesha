<?php
$user='root';
$password='Sriranga@#$!';
$database='sandesha';
$server = 'localhost';
$year = "2015";
$month = "02";
$volume = "020";
$issue = "05";

$db = @new mysqli("$server", "$user", "$password", "$database");
$db->set_charset('utf8');
if($db->connect_errno > 0)
{
	echo '<span class="aFeature clr2">Not connected to the Database</span>';
	echo '</div> <!-- cd-container -->';
	echo '</div> <!-- cd-scrolling-bg -->';
	echo '</main> <!-- cd-main-content -->';

    exit(1);
}
?>
