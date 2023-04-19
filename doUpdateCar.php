<?php 
session_start();


//Get data posted from the form 
//addslashes will escape special characters
$CarID = $_POST["carID"];
$CarMake = $_POST["carMake"];
$CarModel = addslashes($_POST["carModel"]);
$CarYear = $_POST["carYear"];
$CarColor = addslashes($_POST["carColor"]);
$CarHybrid = $_POST["carHybrid"];

$removeThese = array("<?php", "<?", "</", "<", "?>", "/>", ">", ";");
$CarModel = str_replace($removeThese, "", $CarModel);
$CarColor = str_replace($removeThese, "", $CarColor);

if(empty($CarID))
	header("Location:select.php");
	
	
	
if(($CarID == "") || ($CarMake == "- Make -") || ($CarModel == "") || ($CarYear == "- Year -") || ($CarColor == "") || ($CarHybrid == ""))
{
	$_SESSION["errorMessage"] = "You must enter a value for all boxes!";
	header("Location:updateCar.php");
	exit;
	
}
else if(!is_numeric($CarID)){
	$_SESSION["errorMessage"] = "You must enter a number for CarID!";
	header("Location:updateCar.php");
	exit;
	
}else{
	$_SESSION["errorMessage"] = "";
}

include("includes/openDbConn.php");

$sql = "UPDATE Assign06Cars SET CarMake ='".$CarMake."', CarModel ='".$CarModel."', CarYear = '".$CarYear."', CarColor = '".$CarColor."', CarHybrid = '".$CarHybrid."' WHERE CarID=".$CarID;

$result = mysqli_query($db, $sql);

//clean up
include("includes/closeDbConn.php");

//redirect to default
header("Location:select.php");
?>