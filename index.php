<?php
$file = "sql.sql";
$host = "localhost";
$user = "root";
$password = "";
$database = "database";

mysql_connect($host, $user, $password);
mysql_select_db($database);

$query_array = ParseSQL(file_get_contents($file));

$sql = "start transaction";
$res = mysql_query($sql);
$oke = 1;
foreach($query_array as $key=>$query)
{
	$sql = $query['query'];
	$res = mysql_query($sql);
	if(!$res)
	{
		$oke = $oke * 0;
	}
}
if($oke)
{
	$sql = "commit";
	$res = mysql_query($sql);
}
else
{
	$sql = "rollback";
	$res = mysql_query($sql);
}

?>