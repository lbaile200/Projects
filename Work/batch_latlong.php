<?php //started 12:35 pm 2/14/2014 Lucas
require("../script/cache.php");
require("./common/sql-def2.php");
require("./common/ap-dml2.php");
require("../script/common.php");
$db_connection=open_database($db_server, $db_database, $db_username, $db_password);
mysql_query("SET NAMES utf8");
?>
<html>
<head>
<title>latlong.php</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style>
      html, body, #map-canvas {
        height: 100%;
        margin: 0px;
        padding: 0px
      }
    </style>
<link rel="stylesheet" href="../stylesheet.css">
<script language="Javascript1.2">
function go(st)
{st.submit();}
</script>

</head>

<body bgcolor="#FFFFFF">
 
<?php // need a way to keep DB from pulling empty tables, use minimal (select min(Org) AS org FROM Orgs where Org>number;)  also create column for manual, if no valid data returned, set column to Y and move on.  Never repeat manual columns
 echo "<table border='1' cellpadding='1' cellspacing='1'>\n";
    echo "<tr>\n";
     echo "<td class='text-background-lightblue'><div style='width: 50px' 'height: 5px'><p><b>Org</b></p></div></td>";
     echo "<td class='text-background-lightblue'><div style='width: 100px' 'height: 5px'><p><b>Status</b></p></div></td>";
     echo "<td class='text-background-lightblue'><div style='width: 500px' 'height: 5px'><p><b>Name</b></p></div></td>";
	 echo "<td class='text-background-lightblue'><div style='width: 200px' 'height: 5px'><p><b>Latitude</b></p></div></td>";
	 echo "<td class='text-background-lightblue'><div style='width: 200px' 'height: 5px'><p><b>Longitude</b></p></div></td>";
    echo "<tr>\n";
	
$x=1;
while($x<=100){
 $sql = "SELECT COUNT(*) AS count FROM Orgs"; //get total count of all orgs
  $count=sql_return_one_number($db_connection, $sql); //store that count as 'count' 
 $sql = "SELECT Pointer AS POINTER FROM OrgsPointer WHERE IND=1"; //pointer is updated with every org processed
  $POINTER=sql_return_one_number($db_connection, $sql);
 $Org = $POINTER;// Capital Org is org ID, Lowercase org is name, this is confusing, fix.
 
  if ($Org > $count){ //this checks that we reset after the last organization
	$def=1; //by comparing the org pointer to our actual count of organizations, if the pointer would be greater than the # of orgs 
	$sql = "UPDATE OrgsPointer SET Pointer=".$def." WHERE Ind=1"; //then reset
	 $aff=update_db($db_connection, $sql);
	 echo "the count has been reset";
	 die;
	 
}else{
    $sql = "SELECT Name As org FROM Orgs WHERE Org=".$Org; // get organization that matches org ID
	$org = sql_return_one_number($db_connection, $sql); // magic
	
  }if($org == "") {//make sure we don't pull Empty set from database.  Saves scripting time, because it doesn't pass null data and then try to write values for it.  
	$Org++;
	 $sql = "UPDATE OrgsPointer SET Pointer='".$Org."' WHERE Ind=1";
	 $aff=update_db($db_connection, $sql);
	 $x++; 

}else{
	$orgrep = str_replace(" ", "+", $org); //remove all spaces and add a + sign for google API purposes using my personal key for testing, removed old key ::AIzaSyCgLdBIgzvZvE0l1yFmdvL4cMAky8tl6d4||
	$latlong = file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?address=$orgrep&sensor=false&key=AIzaSyAx34hJn5qG18hcCpjBISXUfDGgJJbfc4g"); // pass info to google
	$output=json_decode($latlong); //store it
	 $status=$output->status;
	 
  if ($status == "OVER_QUERY_LIMIT") { //added logic to prevent script from running if over daily quota limit.  Otherwise DB gets filled with null values for lat/long
	 
	echo "you are over your query limit for the day, please try again later";
	die;
	
  }if($status == "ZERO_RESULTS"){	  //added additional logic to ignore ZERO RESULTS entries.  This saves time by not writing ZERO_RESULTS to the database 
	$Org++;
	 $sql = "UPDATE OrgsPointer SET Pointer='".$Org."' WHERE Ind=1";
	 $aff=update_db($db_connection, $sql);
	$x++; 

}else{	 
	$lat = $output->results[0]->geometry->location->lat; //find lat under geometry / location / lat
	$long = $output->results[0]->geometry->location->lng; //find long under geometry / location / lng
	 $sql="UPDATE Orgs SET Latitude='".$lat."' WHERE Org=".$Org; //update
	  $aff=update_db($db_connection, $sql);
	 $sql="UPDATE Orgs SET Longitude='".$long."' WHERE Org=".$Org; 
	  $aff=update_db($db_connection, $sql);
	  
//echos for tracking.   
	echo "<td><p>".$Org."</p></td>\n";
	echo "<td><p>".$status."</p></td>\n";
	echo "<td><p>".$org."</p></td>\n";
	echo "<td><p>".$lat."</p></td>\n";
	echo "<td><p>".$long."</p></td>\n";
	echo "</tr>\n";

	$Org++;
	 $sql = "UPDATE OrgsPointer SET Pointer='".$Org."' WHERE Ind=1";
	$aff=update_db($db_connection, $sql);
	$x++; 
}//one for main 'while' statement
}//one for first 'if' statement that checks if org is greater than count
}//one for second 'if' statement that stops if over limit
//nine for the races of men...
?>

</body>

</html>