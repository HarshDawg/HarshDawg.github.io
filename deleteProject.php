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
    <title>Lab 6 - Delete Project</title>
	<style type="text/css">
		h1{color: #7D6D61;}
		body{background-color: #BCD39C;}
        form { width:460px; height: 290px;margin:0px auto; background-color: #EAFDCF;}
        ul{ list-style:none; margin-top:5px;}
        ul li { display:block; float:left; width:100%; height:1%; }
        ul li label { float:left; padding:7px; }
		ul li span { color:indianred; font-weight:bold;}
        ul li span#radios {color:#000000; font-weight: normal; padding: 0px; margin-right: 130px;}
        ul li input, ul li select, span.values { float:right; margin-right:10px; border:1px solid #000; padding:3px; width:240px;}
        ul li input[type="radio"] { float: none; margin-right:0px; padding:0px; width:40px;}
		input#submit {width:248px; background-color: #93827F;}
		li input:focus { border:1px solid #999; }
		fieldset{ padding:10px; border:1px solid #000; width:420px; overflow:auto; margin:10px;}
		legend{ color:#675B59; margin:0 10px 0 0; padding:0 5px; font-size:11pt; font-weight:bold; }
    </style>
</head>
 
<body>
	<h1 style="text-align:center">Assign06 - Delete Project</h1>

	<?php 
	
	
	include("includes/menu.php");
	//prepare sql statement
	$sql = "SELECT ProjectID, ProjName, ProjCategory, ProjDesc, StartDate, EndDate FROM Assign06Projects WHERE ProjectID = 46";
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
	 $_SESSION["errorMessage"] = "You must first insert a Project with ID 46";
	//The carID field below is disabled
    ?> 
<form id="form0" method="post" action="doDeleteProject.php">
	<fieldset>
		<legend>Are you sure you want to delete this project?</legend>
        <ul>
			<!--Displays Project 46 results -->
            <li>
				<label title="ProjectID" for="projectIDdis">Project ID</label>
                <span class = "values"><?php if($num_results != 0) {echo( trim($row["ProjectID"]));} ?></span>
            </li>
            <li><label title="ProjName" for="projName">Project Name</label>
				<span class = "values"><?php if($num_results != 0) {echo( trim($row["ProjName"]));} ?></span>
			</li>
			<li><label title="ProjCategory" for="projCategory">Category</label>
				<span class = "values"><?php if($num_results != 0) {echo( trim($row["ProjCategory"]));} ?></span>
			</li>
			<li><label title="ProjDesc" for="projDesc">Description</label>
				<span class = "values"><?php if($num_results != 0) {echo( trim($row["ProjDesc"]));} ?></span>
			</li>
                <li><label title="StartMonth" for="startMonth">Start Date</label>
				<span class = "values"><?php if($num_results != 0) {echo( trim($row["StartDate"]));} ?></span>
			</li>
			<li><label title="StartDay" for="startDay">End Date</label>
				<span class = "values"><?php if($num_results != 0) {echo( trim($row["EndDate"]));} ?></span>
			</li>
            <!--Confirm delete -->
            <li><span><?php echo $_SESSION["errorMessage"]; ?></span></li>
            <li><input type="submit" value="Confirm Delete Project" name="submit" id="submit" /></li>
        </ul>
	</fieldset>
</form>
<?php
	$_SESSION["errorMessage"] = "";
	
	?>


</body>
</html>
