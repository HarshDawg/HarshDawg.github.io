<?php 

session_start();

//open DB connection
include("includes/openDBConn.php");

//sql statement
$sql = "DELETE FROM Assign06Projects Where ProjectID = 46";

//execute the query and store the result in $result
$result = mysqli_query($db, $sql);

include("includes/closeDBConn.php");

//go back to the select page
header("Location: select.php");
?>