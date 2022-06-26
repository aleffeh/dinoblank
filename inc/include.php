<?php
try{$dbuser = 'postgres';
$dbpass = '1233210';
$host = '127.0.0.1';
$dbname='pointblank';
$connec = new PDO("pgsql:host=$host;dbname=$dbname", $dbuser, $dbpass);
}
catch (PDOException $e)
{
	echo "Error : " . $e->getMessage() . "<br/>";
	die();
} 
?>