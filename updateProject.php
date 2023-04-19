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
    <title>Lab 6 - Update Project</title>
	<style type="text/css">
		h1{color: #7D6D61;}
		body{background-color: #BCD39C;}
        form { width:440px; height: 350px; margin:0px auto; background-color: #EAFDCF;}
        ul{ list-style:none; margin-top:5px;}
        ul li { display:block; float:left; width:100%; height:1%; }
        ul li label { float:left; padding:7px; }
		ul li span { color: indianred; font-weight:bold;}
        ul li input, ul li select { float:right; margin-right:10px; border:1px solid #000; padding:3px; width:240px;}
		input#submit {width:248px; background-color: #93827F;}
		li input:focus { border:1px solid #999; }
		fieldset{ padding:10px; border:1px solid #000; width:400px; overflow:auto; margin:10px;}
		legend{ color:#675B59; margin:0 10px 0 0; padding:0 5px; font-size:11pt; font-weight:bold; }
    </style>
</head>
 
<body>
<h1 style="text-align:center">Lab 6 - Update Project</h1>
<?php
	include("includes/menu.php");
?>
<div style = "font-style: italic; text-align: center; font-size: 9px;">This set of pages validates as HTML5 compliant <br  />&nbsp;</div>	
	
	<?php
	// prepare SQL statement
		$sql = "SELECT ProjectID, ProjName, ProjCategory, ProjDesc, StartDate, EndDate FROM Assign06Projects WHERE ProjectID = 46";
	
		$result = mysqli_query($db, $sql);
	
		if(empty($result))
		{
			$num_results = 0;
		}else
		{
			$num_results = mysqli_num_rows($result);
			
			$row = mysqli_fetch_array($result);
		}
			//if there are no records, set error message
		if($num_results == 0)
			$_SESSION["errorMessage"] = "You must first insert a Project with ID 46";
	?>
	
	<!---Create the form for Projects and inputting the labels--->
<form id="form0" method="post" action="doUpdateProject.php">
	<fieldset>
		<legend>Update Assign06Projects table</legend>
        <ul>
            <li><label title="ProjectID" for="projectIDdis">Project ID</label>
                <input type="text" name="projectIDdis" id="projectIDdis" size="20" maxlength="20" 
                      value="<?php if($num_results != 0) {echo( trim($row["ProjectID"]));} ?>" disabled="disabled" />
            	<input name="projectID" id="projectID" type="hidden" value="<?php if($num_results != 0) {echo( trim($row["ProjectID"]));} ?>"/>
            </li>
            <li><label title="ProjName" for="projName">Project Name</label>
                <input name="projName" id="projName" type="text" size="20" maxlength="30" value="<?php if($num_results != 0) {echo( trim($row["ProjName"]));} ?>"/>
            </li>
            <!---Sets values for Category--->
            <li><label title="ProjCategory" for="projCategory">Category</label>
                <select name="projCategory">
                <option value="- Category -">- Category -</option>
                <option value="Commercial"  <?php if(($num_results != 0) && (trim($row["ProjCategory"]) == "Commercial")){echo "selected: 'selected'";} ?>>Commercial</option>
                <option value="Residential" <?php if(($num_results != 0) && (trim($row["ProjCategory"]) == "Residential")){echo "selected: 'selected'";} ?>>Residential</option>
                </select>

            <li><label title="ProjDescription" for="projDescription">Description</label>
                <input name="projDescription" id="projDescription" type="text" size="20" maxlength="30" value="<?php if($num_results != 0) {echo( trim($row["ProjDesc"]));} ?>"/>
            </li>
			
			<?php 
			//Separate StartDate and EndDate into 4 variables: StartMonth, StartDay, EndMonth, EndDay
			$StartMonth = trim( substr(trim($row["StartDate"]), 0, strpos(trim($row["StartDate"]), " ")));
			$StartDay = trim( substr(trim($row["StartDate"]), strpos(trim($row["StartDate"]), " "), strlen(trim($row["StartDate"]))));
			$EndMonth = trim( substr(trim($row["EndDate"]), 0, strpos(trim($row["EndDate"]), " ")));
			$EndDay = trim( substr(trim($row["EndDate"]), strpos(trim($row["EndDate"]), " "), strlen(trim($row["EndDate"]))));
			
			
			?>
			</br >
		<!--Checks to see if one of the months is selected --->
			<li><label title="StartMonth" for="startMonth">Start Month</label>
                <select name="startMonth">
                <option value="- Month -">- Start Month -</option>
                <option value="Jan" <?php if(($num_results != 0) && ($StartMonth == "Jan")){echo "selected: 'selected'";} ?>>Jan</option>
                <option value="Feb" <?php if(($num_results != 0) && ($StartMonth == "Feb")){echo "selected: 'selected'";} ?>>Feb</option>
                <option value="Mar" <?php if(($num_results != 0) && ($StartMonth == "Mar")){echo "selected: 'selected'";} ?>>Mar</option>
                <option value="Apr" <?php if(($num_results != 0) && ($StartMonth == "Apr")){echo "selected: 'selected'";} ?>>Apr</option>
                <option value="May" <?php if(($num_results != 0) && ($StartMonth == "May")){echo "selected: 'selected'";} ?>>May</option>
                <option value="Jun" <?php if(($num_results != 0) && ($StartMonth == "Jun")){echo "selected: 'selected'";} ?>>Jun</option>
                <option value="Jul" <?php if(($num_results != 0) && ($StartMonth == "Jul")){echo "selected: 'selected'";} ?>>Jul</option>
                <option value="Aug" <?php if(($num_results != 0) && ($StartMonth == "Aug")){echo "selected: 'selected'";} ?>>Aug</option>
                <option value="Sep" <?php if(($num_results != 0) && ($StartMonth == "Sep")){echo "selected: 'selected'";} ?>>Sep</option>
                <option value="Oct" <?php if(($num_results != 0) && ($StartMonth == "Oct")){echo "selected: 'selected'";} ?>>Oct</option>
                <option value="Nov" <?php if(($num_results != 0) && ($StartMonth == "Nov")){echo "selected: 'selected'";} ?>>Nov</option>
                <option value="Dec" <?php if(($num_results != 0) && ($StartMonth == "Dec")){echo "selected: 'selected'";} ?>>Dec</option>
                </select>
            </li>
		<!--Checks to see if one of the days is selected --->
            <li><label title="StartDay" for="startDay">Start Day</label>
                <select name="startDay">
                <option value="- Day -">- Start Day -</option>
                <option value="01" <?php if(($num_results != 0) && ($StartDay == "01")){echo "selected: 'selected'";} ?>>01</option>
                <option value="02" <?php if(($num_results != 0) && ($StartDay == "02")){echo "selected: 'selected'";} ?>>02</option>
                <option value="03" <?php if(($num_results != 0) && ($StartDay == "03")){echo "selected: 'selected'";} ?>>03</option>
                <option value="04" <?php if(($num_results != 0) && ($StartDay == "04")){echo "selected: 'selected'";} ?>>04</option>
                <option value="05" <?php if(($num_results != 0) && ($StartDay == "05")){echo "selected: 'selected'";} ?>>05</option>
                <option value="06" <?php if(($num_results != 0) && ($StartDay == "06")){echo "selected: 'selected'";} ?> >06</option>
                <option value="07" <?php if(($num_results != 0) && ($StartDay == "07")){echo "selected: 'selected'";} ?>>07</option>
                <option value="08" <?php if(($num_results != 0) && ($StartDay == "08")){echo "selected: 'selected'";} ?>>08</option>
                <option value="09" <?php if(($num_results != 0) && ($StartDay == "09")){echo "selected: 'selected'";} ?>>09</option>
                <option value="10" <?php if(($num_results != 0) && ($StartDay == "10")){echo "selected: 'selected'";} ?>>10</option>
                <option value="11" <?php if(($num_results != 0) && ($StartDay == "11")){echo "selected: 'selected'";} ?> >11</option>
                <option value="12" <?php if(($num_results != 0) && ($StartDay == "12")){echo "selected: 'selected'";} ?>>12</option>
                <option value="13" <?php if(($num_results != 0) && ($StartDay == "13")){echo "selected: 'selected'";} ?>>13</option>
                <option value="14" <?php if(($num_results != 0) && ($StartDay == "14")){echo "selected: 'selected'";} ?>>14</option>
                <option value="15" <?php if(($num_results != 0) && ($StartDay == "15")){echo "selected: 'selected'";} ?>>15</option>
                <option value="16" <?php if(($num_results != 0) && ($StartDay == "16")){echo "selected: 'selected'";} ?> >16</option>
                <option value="17" <?php if(($num_results != 0) && ($StartDay == "17")){echo "selected: 'selected'";} ?>>17</option>
                <option value="18" <?php if(($num_results != 0) && ($StartDay == "18")){echo "selected: 'selected'";} ?>>18</option>
                <option value="19" <?php if(($num_results != 0) && ($StartDay == "19")){echo "selected: 'selected'";} ?>>19</option>
                <option value="20" <?php if(($num_results != 0) && ($StartDay == "20")){echo "selected: 'selected'";} ?>>20</option>
                <option value="21" <?php if(($num_results != 0) && ($StartDay == "21")){echo "selected: 'selected'";} ?>>21</option>
                <option value="22" <?php if(($num_results != 0) && ($StartDay == "22")){echo "selected: 'selected'";} ?>>22</option>
                <option value="23" <?php if(($num_results != 0) && ($StartDay == "23")){echo "selected: 'selected'";} ?>>23</option>
                <option value="24" <?php if(($num_results != 0) && ($StartDay == "24")){echo "selected: 'selected'";} ?>>24</option>
                <option value="25" <?php if(($num_results != 0) && ($StartDay == "25")){echo "selected: 'selected'";} ?>>25</option>
                <option value="26" <?php if(($num_results != 0) && ($StartDay == "26")){echo "selected: 'selected'";} ?>>26</option>
                <option value="27" <?php if(($num_results != 0) && ($StartDay == "27")){echo "selected: 'selected'";} ?>>27</option>
                <option value="28" <?php if(($num_results != 0) && ($StartDay == "28")){echo "selected: 'selected'";} ?>>28</option>
                <option value="29" <?php if(($num_results != 0) && ($StartDay == "29")){echo "selected: 'selected'";} ?>>29</option>
                <option value="30" <?php if(($num_results != 0) && ($StartDay == "30")){echo "selected: 'selected'";} ?>>30</option>
                <option value="31" <?php if(($num_results != 0) && ($StartDay == "31")){echo "selected: 'selected'";} ?>>31</option>
                </select>
            </li>
            <li><label title="EndMonth" for="endMonth">End Month</label>
                <select name="endMonth">
                <option value="- Month -">- End Month -</option>
                <option value="Jan" <?php if(($num_results != 0) && ($EndMonth == "Jan")){echo "selected: 'selected'";} ?>>Jan</option>
                <option value="Feb" <?php if(($num_results != 0) && ($EndMonth == "Feb")){echo "selected: 'selected'";} ?>>Feb</option>
                <option value="Mar" <?php if(($num_results != 0) && ($EndMonth == "Mar")){echo "selected: 'selected'";} ?>>Mar</option>
                <option value="Apr" <?php if(($num_results != 0) && ($EndMonth == "Apr")){echo "selected: 'selected'";} ?>>Apr</option>
                <option value="May" <?php if(($num_results != 0) && ($EndMonth == "May")){echo "selected: 'selected'";} ?>>May</option>
                <option value="Jun" <?php if(($num_results != 0) && ($EndMonth == "Jun")){echo "selected: 'selected'";} ?>>Jun</option>
                <option value="Jul" <?php if(($num_results != 0) && ($EndMonth == "Jul")){echo "selected: 'selected'";} ?>>Jul</option>
                <option value="Aug" <?php if(($num_results != 0) && ($EndMonth == "Aug")){echo "selected: 'selected'";} ?>>Aug</option>
                <option value="Sep" <?php if(($num_results != 0) && ($EndMonth == "Sep")){echo "selected: 'selected'";} ?>>Sep</option>
                <option value="Oct" <?php if(($num_results != 0) && ($EndMonth == "Oct")){echo "selected: 'selected'";} ?>>Oct</option>
                <option value="Nov" <?php if(($num_results != 0) && ($EndMonth == "Nov")){echo "selected: 'selected'";} ?>>Nov</option>
                <option value="Dec" <?php if(($num_results != 0) && ($EndMonth == "Dec")){echo "selected: 'selected'";} ?>>Dec</option>
                </select>
            </li>
            <li><label title="EndDay" for="endDay">End Day</label>
                <select name="endDay">
                <option value="- Day -">- End Day -</option>
                <option value="01" <?php if(($num_results != 0) && ($EndDay == "01")){echo "selected: 'selected'";} ?>>01</option>
                <option value="02" <?php if(($num_results != 0) && ($EndDay == "02")){echo "selected: 'selected'";} ?>>02</option>
                <option value="03" <?php if(($num_results != 0) && ($EndDay == "03")){echo "selected: 'selected'";} ?>>03</option>
                <option value="04" <?php if(($num_results != 0) && ($EndDay == "04")){echo "selected: 'selected'";} ?>>04</option>
                <option value="05" <?php if(($num_results != 0) && ($EndDay == "05")){echo "selected: 'selected'";} ?>>05</option>
                <option value="06" <?php if(($num_results != 0) && ($EndDay == "06")){echo "selected: 'selected'";} ?> >06</option>
                <option value="07" <?php if(($num_results != 0) && ($EndDay == "07")){echo "selected: 'selected'";} ?>>07</option>
                <option value="08" <?php if(($num_results != 0) && ($EndDay == "08")){echo "selected: 'selected'";} ?>>08</option>
                <option value="09" <?php if(($num_results != 0) && ($EndDay == "09")){echo "selected: 'selected'";} ?>>09</option>
                <option value="10" <?php if(($num_results != 0) && ($EndDay == "10")){echo "selected: 'selected'";} ?>>10</option>
                <option value="11" <?php if(($num_results != 0) && ($EndDay == "11")){echo "selected: 'selected'";} ?> >11</option>
                <option value="12" <?php if(($num_results != 0) && ($EndDay == "12")){echo "selected: 'selected'";} ?>>12</option>
                <option value="13" <?php if(($num_results != 0) && ($EndDay == "13")){echo "selected: 'selected'";} ?>>13</option>
                <option value="14" <?php if(($num_results != 0) && ($EndDay == "14")){echo "selected: 'selected'";} ?>>14</option>
                <option value="15" <?php if(($num_results != 0) && ($EndDay == "15")){echo "selected: 'selected'";} ?>>15</option>
                <option value="16" <?php if(($num_results != 0) && ($EndDay == "16")){echo "selected: 'selected'";} ?> >16</option>
                <option value="17" <?php if(($num_results != 0) && ($EndDay == "17")){echo "selected: 'selected'";} ?>>17</option>
                <option value="18" <?php if(($num_results != 0) && ($EndDay == "18")){echo "selected: 'selected'";} ?>>18</option>
                <option value="19" <?php if(($num_results != 0) && ($EndDay == "19")){echo "selected: 'selected'";} ?>>19</option>
                <option value="20" <?php if(($num_results != 0) && ($EndDay == "20")){echo "selected: 'selected'";} ?>>20</option>
                <option value="21" <?php if(($num_results != 0) && ($EndDay == "21")){echo "selected: 'selected'";} ?>>21</option>
                <option value="22" <?php if(($num_results != 0) && ($EndDay == "22")){echo "selected: 'selected'";} ?>>22</option>
                <option value="23" <?php if(($num_results != 0) && ($EndDay == "23")){echo "selected: 'selected'";} ?>>23</option>
                <option value="24" <?php if(($num_results != 0) && ($EndDay == "24")){echo "selected: 'selected'";} ?>>24</option>
                <option value="25" <?php if(($num_results != 0) && ($EndDay == "25")){echo "selected: 'selected'";} ?>>25</option>
                <option value="26" <?php if(($num_results != 0) && ($EndDay == "26")){echo "selected: 'selected'";} ?>>26</option>
                <option value="27" <?php if(($num_results != 0) && ($EndDay == "27")){echo "selected: 'selected'";} ?>>27</option>
                <option value="28" <?php if(($num_results != 0) && ($EndDay == "28")){echo "selected: 'selected'";} ?>>28</option>
                <option value="29" <?php if(($num_results != 0) && ($EndDay == "29")){echo "selected: 'selected'";} ?>>29</option>
                <option value="30" <?php if(($num_results != 0) && ($EndDay == "30")){echo "selected: 'selected'";} ?>>30</option>
                <option value="31" <?php if(($num_results != 0) && ($EndDay == "31")){echo "selected: 'selected'";} ?>>31</option>
                </select>
            </li>
            
            <li><span><?php echo $_SESSION["errorMessage"]; ?></span></li>
            <li><input type="submit" value="Update Project" name="submit" id="submit" /></li>
        </ul>
	</fieldset>
	</fieldset>
</form>
<?php
	$_SESSION["errorMessage"] = "";
	
	?>
<script type="text/javascript">
	document.getElementById("projName").focus();
</script>
</body>
</html>