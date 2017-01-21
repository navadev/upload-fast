<?

	$usr = "root";
	
	$pwd = "";
	
	$db = "upload";
	
	$host = "localhost";

	// connect to database
	$cid =  mysqli_connect($host,$usr,$pwd, $db);
	if (!$cid) { echo("ERROR: " . mysqli_connect_error() . "\n");	}

?>
