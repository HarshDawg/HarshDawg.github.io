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


if(empty($ProjectID))
	header("Location:select.php");

if(($ProjectID == "") || ($ProjName == "") || ($ProjCategory == "- Category -") || ($ProjDescript == "") || ($StartMonth == "- Month -") || ($StartDay == "- Day -") || ($EndMonth == "- Month -") || ($EndDay == "- Day -"))
{
	$_SESSION["errorMessage"] = "You must enter a value for all boxes!";
	header("Location:updateProject.php");
	exit;
	
}
else if(!is_numeric($ProjectID)){
	$_SESSION["errorMessage"] = "You must enter a number for ProjectID!";
	header("Location:updateProject.php");
	exit;
	
}else{
	$_SESSION["errorMessage"] = "";
}

include("includes/openDbConn.php");

$StartDate = $StartMonth." ".$StartDay;
$EndDate = $EndMonth." ".$EndDay;

$sql = "UPDATE Assign06Projects SET ProjName ='".$ProjName."', ProjCategory ='".$ProjCategory."', ProjDesc = '".$ProjDescript."', StartDate = '".$StartDate."', EndDate = '".$EndDate."' WHERE ProjectID=".$ProjectID;

$result = mysqli_query($db, $sql);

//clean up
include("includes/closeDbConn.php");

//redirect to default
header("Location:select.php");
?>