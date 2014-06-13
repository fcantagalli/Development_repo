<?php
	include ("DbConnect.php");
	$db = new database();
	//$db->setup("dbuser", "dbpass", "dbhost", "dbname"); //optional, you can alter the default values on the script, but if not using this dont forget to set de db
	$db->setDb("mysql");
	$query = "SELECT * FROM user";
	$res = $db->send_sql($query);
	echo "Found ".mysqli_num_rows($res)." rows<BR>"; // or num_rows_result
	$row = $db->next_row(NULL);
	echo $row[0]."<BR>";
	$row = $db->next_row(NULL);
	echo $row [1]."<BR>";
	$db->printout();
	$db->inserted_id();
	$db->new_db("testing");
	$db->disconnect();
	$db->inserted_id();
?>