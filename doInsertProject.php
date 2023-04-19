<?php 
session_start();



//Get data posted from the form 
//addslashes will escape special characters
$ProjectID = $_POST["projectID"];
$ProjName = addslashes($_POST["projName"]);
$ProjCategory = $_POST["projCategory"];
$ProjDescript = addslashes($_POST["projDescription"]);
$StartMonth = $_POST["startMonth"];
$StartDay = $_POST["startDay"];
$EndMonth = $_POST["endMonth"];
$EndDay = $_POST["endDay"];


$removeThese = array("<?php", "<?", "</", "<", "?>", "/>", ">", ";");
$ProjName = str_replace($removeThese, "", $ProjName);
$ProjDescript = str_replace($removeThese, "", $ProjDescript);


//check for empty values 
if(($ProjectID == "") || ($ProjName == "") || ($ProjCategory == "- Category -") || ($ProjDescript == "") || ($StartMonth == "- Month -") || ($StartDay == "- Day -") || ($EndMonth == "- Month -") || ($EndDay == "- Day -"))
{
	$_SESSION["errorMessage"] = "You must enter a value for all boxes!";
	header("Location:insertProject.php");
	exit;
	
}
//check is ShipperID is a number 
else if(!is_numeric($ProjectID)){
	$_SESSION["errorMessage"] = "You must enter a number for ProjectID!";
	header("Location:insertProject.php");
	exit;
	
}else{
	$_SESSION["errorMessage"] = "";
}

//open DB connection 
include("includes/openDBConn.php");
//prepare the sql statement, determine if the ShipperID already exists in DB 
$sql = "SELECT ProjectID FROM Assign06Projects WHERE ProjectID =".$ProjectID;

$result = mysqli_query($db, $sql);

//check to see if there are no records in the result, if not num of results to 0
if(empty($result))
	$num_results = 0;
else
	$num_results = mysqli_num_rows($result);

//check to see if ShipperID from the form is already in the DB 
if($num_results != 0 )
{
	$_SESSION["errorMessage"] = "The ProjectID you entered already exists!";
	header("Location:insertProject.php");
	exit;	
}
else{
	$_SESSION["errorMessage"] = "";
}

$StartDate = $StartMonth." ".$StartDay;
$EndDate = $EndMonth." ".$EndDay;
//execute SQL query and store the result of the execution into $result
$sql = "INSERT INTO Assign06Projects(ProjectID, ProjName, ProjCategory, ProjDesc, StartDate, EndDate) VALUES (".$ProjectID.", '".$ProjName."', '".$ProjCategory."', '".$ProjDescript."', '".$StartDate."', '".$EndDate."')";

$result = mysqli_query($db, $sql);

//clean up
include("includes/closeDbConn.php");

//redirect to default
header("Location:select.php");
	exit;	
?>