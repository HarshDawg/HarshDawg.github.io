<?php 
session_start();
include("includes/openDbConn.php");
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Assign06 - Select</title>
</head>

<body style = "background-color: #BCD39C;">
	
	  <?php 
	   //Prepare sql statement
	    $sql = "SELECT ProjectID, ProjName, ProjCategory, ProjDesc, StartDate, EndDate FROM Assign06Projects ORDER BY ProjectID ASC";
		//echo($sql);
	    //exit;
	
	   //Execute sql query
	   //Store results in variable
	   $result = mysqli_query($db, $sql);
	//check to see if there were any records returned
	if( empty($result) )
			$num_results = 0;
		else
			$num_results = mysqli_num_rows($result);
	  ?>
	 <h1 style="text-align: center; color: #7D6D61;">Assign06 - Select</h1>
	<?php
	   include("includes/menu.php");
	?>
	<!---Creats Project Table --->
	<table style="border:0px; width:700px; padding:0px; margin:0px auto; border-spacing:0px;" title="Listing of Projects"> 
		<thead>
		<tr>
			<th colspan="6" style="font-weight:bold; background-color:#93827F; text-align:center; text-decoration:underline;">Assign06Projects Table</th>
			</tr>
				<tr>
					<th style="background-color:#93827F; font-weight:bold">ProjectID</th>
                	<th style="background-color:#93827F; font-weight:bold">ProjName</th>
                	<th style="background-color:#93827F; font-weight:bold">ProjCategory</th>
                	<th style="background-color:#93827F; font-weight:bold">ProjDesc</th>
                	<th style="background-color:#93827F; font-weight:bold">StartDate</th>
                	<th style="background-color:#93827F; font-weight:bold">EndDate</th>
					</tr>
		    </thead>
			<tfoot>
				<tr>
					<td colspan="6" style="text-align:center; font-style:italic;">Information pulled from the MySQL database</td>
				</tr>
			</tfoot>
			<tbody>
				<?php 
				for( $i=0; $i<$num_results; $i++ ){
					//store a single record into a var called $row
					$row = mysqli_fetch_array($result);
					//below: always use trim() on data pulled from a database 
			
				?>
				<!---Shows information from the Project Database to Project Table --->
				 <tr> 
					<td style="border-right: 1px solid #000000; background-color: floralwhite;"><?php echo( trim( $row["ProjectID"]) ); ?></td>
					<td style="border-right: 1px solid #000000; background-color: floralwhite;"><?php echo( trim( $row["ProjName"]) ); ?></td>
					<td style="border-right: 1px solid #000000; background-color: floralwhite;"><?php echo( trim( $row["ProjCategory"]) ); ?></td>
					<td style="border-right: 1px solid #000000; background-color: floralwhite;"><?php echo( trim( $row["ProjDesc"]) ); ?></td>
					 <td style="border-right: 1px solid #000000; background-color: floralwhite;"><?php echo( trim( $row["StartDate"]) ); ?></td>
					<td style = "background-color: floralwhite;"><?php echo( trim( $row["EndDate"]) ); ?></td>
				</tr>
				<?php 
				} //end for loop
	
				?>
		</tbody>
	</table>
	
	<p>&nbsp;</p>
	<?php 
	//Prepare the SQL statement
	  $sql = "SELECT CarID, CarMake, CarModel, CarYear, CarColor, CarHybrid FROM Assign06Cars";
	
	$result = mysqli_query($db, $sql);
	//this helps display the results from database 
	if(empty($result))
			$num_results = 0;
		else
			$num_results = mysqli_num_rows($result);
	
	?>
	<!---Create Cars Table --->
	<table  style="border:0px; width:700px; padding:0px; margin:0px auto; border-spacing:0px;" title="Listing of Cars"> 
		<thead>
		<tr>
			 <th colspan="6" style="background-color:#D5BEBA; font-weight:bold; text-align:center; text-decoration:underline;">Assign06Cars Table</th>
			</tr>
				<tr>
					<th style="background-color:#D5BEBA; font-weight:bold">CarID</th>
                	<th style="background-color:#D5BEBA; font-weight:bold">CarMake</th>
                	<th style="background-color:#D5BEBA; font-weight:bold">CarModel</th>
                	<th style="background-color:#D5BEBA; font-weight:bold">CarYear</th>
                	<th style="background-color:#D5BEBA; font-weight:bold">CarColor</th>
                	<th style="background-color:#D5BEBA; font-weight:bold">CarHybrid</th>
				</tr>
		</thead>
			<tfoot>
				<tr>
				<td colspan="6" style="text-align: center; font-style: italic;">Information pulled from MySQL database</td>
				
				</tr>
		</tfoot>
			<tbody>
				<?php 
				for( $i=0; $i< $num_results; $i++ ){
					//store a single record into a var called $row
					$row = mysqli_fetch_array($result);
					
					//below: always use trim() on data pulled from a database 
			
				?>
				<!---Shows information from the Cars Database to Cars Table --->
				<tr> 
					<td style="border-right: 1px solid #000000; background-color: floralwhite;"><?php echo( trim( $row["CarID"] ) ); ?></td>
					<td style="border-right: 1px solid #000000; background-color: floralwhite;"><?php echo( trim( $row["CarMake"] ) ); ?></td>
					<td style="border-right: 1px solid #000000; background-color: floralwhite;"><?php echo( trim( $row["CarModel"] ) ); ?></td>
					<td style="border-right: 1px solid #000000; background-color: floralwhite;"><?php echo( trim( $row["CarYear"] ) ); ?></td>
					<td style="border-right: 1px solid #000000; background-color: floralwhite;"><?php echo( trim( $row["CarColor"] ) ); ?></td>
					<td style = "background-color: floralwhite;"><?php echo( trim( $row["CarHybrid"]) ); ?></td>
				</tr>
				<?php 
				} //end for loop
	
				?>
		</tbody>	
	</table>
	<?php 
	include("includes/closeDbConn.php");
	?>
</body>
</html>