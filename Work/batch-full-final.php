<html>
<head>
<title>latlong.php</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<body bgcolor="#FFFFFF">
<?php
/* NOTES!!!  We currently use one API key to make two different calls, reducing our current capacity by half.
Where we currently can do 3000~ calls per day with a single key, we can do 1500 organizations (less, but I'm not checking)
we'll want to have 2 API keys used in-tandem.  Both use the 'places' API (changed from geolocation API) to get a place ID
and then feed the place ID BACK to the places API to get specific details about that place.
*/
//start our table
 echo "<table border='1' cellpadding='1' cellspacing='1'>\n";
  echo "<tr>\n";
  echo "<td class='text-background-lightblue'><div style='width: 50px' 'height: 5px'><p><b>Org</b></p></div></td>";
  echo "<td class='text-background-lightblue'><div style='width: 100px' 'height: 5px'><p><b>Status</b></p></div></td>";
  echo "<td class='text-background-lightblue'><div style='width: 500px' 'height: 5px'><p><b>Name</b></p></div></td>";
  echo "<td class='text-background-lightblue'><div style='width: 200px' 'height: 5px'><p><b>Latitude</b></p></div></td>";
  echo "<td class='text-background-lightblue'><div style='width: 200px' 'height: 5px'><p><b>Longitude</b></p></div></td>";
  echo "<tr>\n";
//counter tool, start with 1:
$x=1;
 while($x<=50){
$sql = "SELECT COUNT(*) AS count FROM Orgs"; //get total count of all orgs
  $count=sql_return_one_number($db_connection, $sql); //store that count as 'count'
$sql = "SELECT Pointer AS POINTER FROM OrgsPointer WHERE IND=1";
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
//this will pull out spaces and replace with + sign to comply with google API
 $locrep = str_replace(" ", "+", $org);
//feed our fancy (corrected) location to google using their API.  Should probably strip key and use variable, who has time for that?
 $url=file_get_contents("https://maps.googleapis.com/maps/api/place/textsearch/json?query=$locrep&key=AIzaSyDvd4rwvfYzF5X1bwF3FIf6Ibn46XbFkq0");
//API changed to PLACES API.  Change is small.  https://developers.google.com/places/web-service/search
 $output=json_decode($url);
  $lat=$output->results[0]->geometry->location->lat;//this is case sensitive, be careful
  $lon=$output->results[0]->geometry->location->lng;
  $id=$output->results[0]->place_id;
  $status=$output->status;
 if ($status == "OVER_QUERY_LIMIT") { //added logic to prevent script from running if over daily quota limit.  Otherwise DB gets filled with null values for lat/long
  echo "you are over your query limit for the day, please try again later";
  die;
}else{
 $adr=file_get_contents("https://maps.googleapis.com/maps/api/place/details/json?&placeid=$id&key=AIzaSyDvd4rwvfYzF5X1bwF3FIf6Ibn46XbFkq0");
 $output1=json_decode($adr, true);
  foreach ($output1['result']['address_components'] as $thing){//need a more descriptive variable than $thing...
  foreach ($thing['types'] as $type){
 if($type == 'administrative_area_level_3'){
  $city = $thing['long_name'];}
  if($type == 'administrative_area_level_1'){
  $state = $thing['long_name'];}
  if($type == 'country'){
  $country = $thing['long_name'];
}}}
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
}}}}
?>
</body>
</html>
