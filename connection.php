<?php

DEFINE ('HOST', "localhost");
DEFINE ('USERNAME', "root");
DEFINE ('PASSWORD', "root");
DEFINE ('DATABASE', "tic_system");

$con = mysqli_connect(HOST,USERNAME,PASSWORD,DATABASE);
// Check connection
if (mysqli_connect_errno()){
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

function get_max_index_of_table($con, $table_name) {
	// Retreive the max index
	$query = "SELECT MAX(".$table_name."_id) FROM ".$table_name;
	$result = @mysqli_query($con, $query);
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	return (int)$row["MAX(".$table_name."_id)"];
}

mysqli_set_charset($con, 'utf8');
 