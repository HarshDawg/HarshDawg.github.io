<?php 
session_start();

if(empty($_SESSION["errorMessage"]))
	$_SESSION["errorMessage"] = "";

include("includes/openDbConn.php");
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
    <title>Lab 6 - Delete Car</title>
	<style type="text/css">
		h1{color: #7D6D61;}
		body{background-color: #BCD39C;}
        form { width:440px; height: 277px;margin:0px auto; background-color: #EAFDCF;}
        ul{ list-style:none; margin-top:5px;}
        ul li { display:block; float:left; width:100%; height:1%; }
        ul li label { float:left; padding:7px; }
		ul li span { color:#0000ff; font-weight:bold;}
		ul li span#radios { color: #000000; font-weight: normal; padding: 0px; margin-right: 130px;}
        ul li input, ul li select, span.values { float:right; margin-right:10px; border:1px solid #000; padding:3px; width:240px;}
		input#submit {width:248px; background-color: #93827F;}
		li input:focus { border:1px solid #999; }
		fieldset{ padding:10px; border:1px solid #000; width:400px; overflow:auto; margin:10px;}
		legend{ color:#000000; margin:0 10px 0 0; padding:0 5px; font-size:11pt; font-weight:bold; }
    </style>
</head>
 
<body>
	<h1 style="text-align:center">Assign06 - Delete Car</h1>

	<?php 
	
	
	include("includes/menu.php");
	//prepare sql statement
	$sql = "SELECT CarID, CarMake, CarModel, CarYear, CarColor, CarHybrid FROM Assign06Cars WHERE CarID = 23";
	//echo($sql);
	//exit;
	$result = mysqli_query($db, $sql);
	
	if(empty($result))
	{
		$num_results = 0;
	}else
	{
		$num_results = mysqli_num_rows($result);
		$row = mysqli_fetch_array($result);
	}
	
	if($num_results == 0)
	 $_SESSION["errorMessage"] = "You must first insert a Car with ID 23";
	//The carID field below is disabled
    ?> 
<form id="form0" method="post" action="doDeleteCar.php">
	<fieldset>
		<legend>Are you sure you want to delete this car?</legend>
        <ul>
			<!---Displays the current info for the Car --->
            <li>
				<label title="CarID" for="CarIDdis">Car ID</label>
                <span class = "values"><?php if($num_results != 0) {echo( trim($row["CarID"]));} ?></span>
            </li>
            <li><label title="CarMake" for="carMake">Make</label>
				<span class = "values"><?php if($num_results != 0) {echo( trim($row["CarMake"]));} ?></span>
			</li>
			<li><label title="CarModel" for="carModel">Model</label>
				<span class = "values"><?php if($num_results != 0) {echo( trim($row["CarModel"]));} ?></span>
			</li>
			<li><label title="CarYear" for="carYear">Year</label>
				<span class = "values"><?php if($num_results != 0) {echo( trim($row["CarYear"]));} ?></span>
			</li>
                <li><label title="CarColor" for="carColor">Color</label>
				<span class = "values"><?php if($num_results != 0) {echo( trim($row["CarColor"]));} ?></span>
			</li>
			<li><label title="CarHybrid" for="carHybrid">Hybrid</label>
				<span class = "values"><?php if($num_results != 0) {echo( trim($row["CarHybrid"]));} ?></span>
			</li>
            
			<!---Confirming to delete the car --->
            <li><span><?php echo $_SESSION["errorMessage"]; ?></span></li>
            <li><input type="submit" value="Confirm Delete Car" name="submit" id="submit" /></li>
        </ul>
	</fieldset>
</form>
<?php
	$_SESSION["errorMessage"] = "";
	
	?>


</body>
</html>
