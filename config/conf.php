<?php
	$host        = "host=localhost";
	$port        = "port=5432";
	$dbname      = "dbname=pointblank";
	$credentials = "user=postgres password=1233210";
	$db = pg_connect( "$host $port $dbname $credentials"  );
   if(!$db){
      echo "Error : No connect to database\n";
   }
?>