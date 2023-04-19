<?php 
session_start();



//Get data posted from the form 
//addslashes will escape special characters
$CarID = $_POST["carID"];
$CarMake = addslashes($_POST["carMake"]);
$CarModel = addslashes($_POST["carModel"]);
$CarYear = $_POST["carYear"];
$CarColor = addslashes($_POST["carColor"]);
$CarHybrid = $_POST["carHybrid"];


$removeThese = array("<?php", "<?", "</", "<", "?>", "/>", ">", ";");
$CarModel = str_replace($removeThese, "", $CarModel);
$CarColor = str_replace($removeThese, "", $CarColor);

//check for empty values 
if(($CarID=="") || ($CarMake=="- Make -") || ($CarModel=="") || ($CarYear=="- Year -") || ($CarColor=="") || ($CarHybrid==""))
{
	$_SESSION["errorMessage"] = "You must enter a value for all boxes!";
	header("Location: insertCar.php");
	exit;
	
}
//check is ShipperID is a number 
else if(!is_numeric($CarID)){
	$_SESSION["errorMessage"] = "You must enter a number for CarID!";
	header("Location: insertCar.php");
	exit;
	
}else{
	$_SESSION["errorMessage"] = "";
}

//open DB connection 
include("includes/openDBConn.php");
//prepare the sql statement, determine if the ShipperID already exists in DB 
$sql = "SELECT CarID FROM Assign06Cars WHERE CarID =".$CarID;

$result = mysqli_query($db, $sql);

//check to see if there are no records in the result, if not num of results to 0
if(empty($result))
	$num_results = 0;
else
	$num_results = mysqli_num_rows($result);

//check to see if ShipperID from the form is already in the DB 
if($num_results != 0 )
{
	$_SESSION["errorMessage"] = "The CarID you entered already exists!";
	header("Location: insertCar.php");
	exit;	
}
else{
	$_SESSION["errorMessage"] = "";
}
//execute SQL query and store the result of the execution into $result
$sql = "INSERT INTO Assign06Cars(CarID, CarMake, CarModel, CarYear, CarColor, CarHybrid) VALUES (".$CarID.", '".$CarMake."', '".$CarModel."', '".$CarYear."', '".$CarColor."', '".$CarHybrid."')";

$result = mysqli_query($db, $sql);

//clean up
include("includes/closeDbConn.php");

//redirect to default
header("Location: select.php");
	exit;	
?>