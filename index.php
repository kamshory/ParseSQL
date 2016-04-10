<?php
include_once "lib/parsesql.php";
$file = "parsesql.sql";
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
$nqueryall = 0;
$nquerysuccess = 0;
$nqueryfail = 0;

foreach($query_array as $key=>$query)
{
	$sql = $query['query'];
	$res = mysql_query($sql);
	if(!$res)
	{
		$oke = $oke * 0;
		$nqueryfail++;
	}
	else
	{
		$nquerysuccess++;
	}
	$nqueryall++;
}
if($oke)
{
	$sql = "commit";
	$res = mysql_query($sql);
	echo "Commit. Success execute $nquerysuccess queries.";
}
else
{
	$sql = "rollback";
	$res = mysql_query($sql);
	echo "Rollback. $nqueryfail of $nqueryall queries fail to be executed.";
}
?>