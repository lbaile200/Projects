<?php //todo!!!
require("/var/www/html/mkt.reg/home/script/cache.php");
require("/var/www/html/mkt.reg/home/admin/common/sql-def2.php");
require("/var/www/html/mkt.reg/home/admin/common/ap-dml2.php");
require("/var/www/html/mkt.reg/home/script/common.php");
require("/var/www/html/mkt.reg/home/script/Encoding.php");
require_once("/var/www/html/management/serversettings.class.php");
$db_server = ServerSettings::DB_SERVER;
$db_reg = ServerSettings::DB_REGDB;
$db_user = ServerSettings::DB_USER;
$db_pass = ServerSettings::DB_PASSWORD;
$db_connection=open_database($db_server, $db_reg, $db_user, $db_pass);
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
<?php
echo "<table border='1' cellpadding='1' cellspacing='1'>\n";
echo "<tr>\n";
echo "<td class='text-background-lightblue'><div style='width: 50px' 'height: 5px'><p><b>Org</b></p></div></td>";
echo "<td class='text-background-lightblue'><div style='width: 100px' 'height: 5px'><p><b>Status</b></p></div></td>";
echo "<td class='text-background-lightblue'><div style='width: 500px' 'height: 5px'><p><b>Name</b></p></div></td>";
echo "<td class='text-background-lightblue'><div style='width: 200px' 'height: 5px'><p><b>Latitude</b></p></div></td>";
echo "<td class='text-background-lightblue'><div style='width: 200px' 'height: 5px'><p><b>Longitude</b></p></div></td>";
echo "<td class='text-background-lightblue'><div style='width: 200px' 'height: 5px'><p><b>State</b></p></div></td>";
echo "<td class='text-background-lightblue'><div style='width: 200px' 'height: 5px'><p><b>Country</b></p></div></td>";
echo "<td class='text-background-lightblue'><div style='width: 200px' 'height: 5px'><p><b>URL</b></p></div></td>";
echo "<tr>\n";
$x=1;
while($x<=100){
 $sql = "SELECT MAX(Org) AS count FROM Orgs"; //get total count of all orgs
  $count=sql_return_one_number($db_connection, $sql); //store that count as 'count'
 $sql = "SELECT Pointer AS POINTER FROM OrgsPointer WHERE IND=1"; //pointer is updated with every org processed
  $POINTER=sql_return_one_number($db_connection, $sql);
 $Org = $POINTER;// Capital Org is org ID, Lowercase org is name, this is confusing, fix.
  if ($POINTER > $count){ //this checks that we reset after the last organization
	 $def=1; //by comparing the org pointer to our actual count of organizations, if the pointer would be greater than the # of orgs
   $sql = "UPDATE OrgsPointer SET Pointer=1"; //then reset
   $aff=update_db($db_connection, $sql);
echo "the count has been reset";
die;
}if ($Org == "NULL"){
echo "null";
$x++;
}else{
 $sql = "SELECT Name As org FROM Orgs WHERE Org=".$Org; // get organization that matches org ID
	$org = sql_return_one_number($db_connection, $sql); // magic
}if($org == "") {//make sure we don't pull Empty set from database.  Saves scripting time, because it doesn't pass null data and then try to write values for it.
	$Org++;
	 $sql = "UPDATE OrgsPointer SET Pointer='".$Org."' WHERE Ind=1";
	 $aff=update_db($db_connection, $sql);
	 $x++;
}else{
  //$fixedOrg = Encoding::toUTF8($org);
  $strrep = str_replace("#", " ", $org);
	$locrep = str_replace(" ", "+", $strrep);
   $url=file_get_contents("https://maps.googleapis.com/maps/api/place/textsearch/json?query=$locrep&key=AIzaSyAIinoS23I_Hy3irLC79uF8Dt-sLDyMp6Q");
     $output=json_decode($url);
     $status=$output->status;
if($status == "OVER_QUERY_LIMIT"){
echo "You are over your query limit for the day, please try again tomorrow";
$msg="You have exceeded your API limited queries for the day on batch_latlong.php.  Please address the API or try again tomorrow";
mail("lbailey@ilsworld.com", "Over Query Limit", $msg);
$x=100;
}if($status != "OK"){	  //added additional logic to ignore ZERO RESULTS entries.  This saves time by not writing ZERO_RESULTS to the database
$Org++;
 $sql = "UPDATE OrgsPointer SET Pointer='".$Org."' WHERE Ind=1";
  $aff=update_db($db_connection, $sql);
$x++;
}else{
$lat=$output->results[0]->geometry->location->lat;//this is case sensitive, be careful
$lon=$output->results[0]->geometry->location->lng;
  //potential problems from this...
if(($lat == NULL)or($lat == "")){
$msg="Latitude returned non-valid values for Organization '".$Org."'";
mail("lbailey@ilsworld.com", "Invalid lat/long in batch_latlong.php", $msg);
die;
}if (($lon == NULL)or($lon == "")){
$msg="Longitude returned non-valid values for Organization '".$Org."'";
mail("lbailey@ilsworld.com", "Invalid lat/long in batch_latlong.php", $msg);
die;
}
$id=$output->results[0]->place_id;
 $sql="UPDATE Orgs SET Latitude=".$lat." WHERE Org=".$Org; //update
  $aff=update_db($db_connection, $sql);
 $sql="UPDATE Orgs SET Longitude=".$lon." WHERE Org=".$Org;
  $aff=update_db($db_connection, $sql);
  //no point in updating state/country if already exists.
  /*
 $sql="SELECT DISTINCT State FROM Instructors WHERE Org=".$Org;
  $state=sql_return_one_number($db_connection, $sql);
  $statesfix = array(
      "Alabama"=>"USAL",
      "Alaska"=>"USAK",
      "Arizona"=>"USAZ",
      "Arkansas"=>"USAR",
      "California"=>"USCA",
      "Colorado"=>"USCO",
      "Connecticut"=>"USCT",
      "Deleware"=>"USDE",
      "District of Columbia"=>"USDC",
      "Florida"=>"USFL",
      "Georgia"=>"USGA",
      "Hawaii"=>"USHI",
      "Idaho"=>"USID",
      "US/IL"=>"Illinois",
      "Indiana"=>"USIN",
      "Iowa"=>"USIA",
      "Kansas"=>"USKS",
      "Kentucky"=>"USKY",
      "Louisiana"=>"USLA",
      "Maine"=>"USME",
      "Maryland"=>"USMD",
      "Massachusetts"=>"USMA",
      "Michigan"=>"USMI",
      "Minnesota"=>"USMN",
      "Mississippi"=>"USMS",
      "Missouri"=>"USMO",
      "Montana"=>"USMT",
      "Nebraska"=>"USNE",
      "Nevada"=>"USNV",
      "New Hampshire"=>"USNH",
      "New Jersey"=>"USNJ",
      "New Mexico"=>"USNM",
      "New York"=>"USNY",
      "North Carolina"=>"USNC",
      "North Dakota"=>"USND",
      "Ohio"=>"USOH",
      "Oklahoma"=>"USOK",
      "Oregon"=>"USOR",
      "Pennsylvania"=>"USPA",
      "Rhode Island"=>"USRI",
      "South Carolina"=>"USSC",
      "South Dakota"=>"USSD",
      "Tennessee"=>"USTN",
      "Texas"=>"USTX",
      "Utah"=>"USUT",
      "Vermont"=>"USVT",
      "Virginia"=>"USVA",
      "Washington"=>"USWA",
      "West Virginia"=>"USWV",
      "Wisconsin"=>"USWI",
      "Wyoming"=>"USWY",
	  "Ontario"=>"CAON",
	  "Quebec"=>"CAQC",
	  "Nova Scotia"=>"CANS",
	  "New Brunswick"=>"CANB",
	  "Manitoba"=>"CAMB",
	  "British Columbia"=>"CABC",
	  "Prince Edward Island"=>"CAPE",
	  "Saskatchewan"=>"CASK",
	  "Alberta"=>"CAAB",
	  "Newfoundland and Labrador"=>"CANL"
    );
  $state = array_search($state, $statesfix); // this and the corresponding array will correct state shorthand (IN US) to full names will need to adjust for canada and so on.
 $sql="SELECT DISTINCT Country FROM Instructors WHERE Org=".$Org;
  $country=sql_return_one_number($db_connection, $sql);
  */
 $adr=file_get_contents("https://maps.googleapis.com/maps/api/place/details/json?&placeid=$id&key=AIzaSyAIinoS23I_Hy3irLC79uF8Dt-sLDyMp6Q");
  $output1=json_decode($adr, $assoc = true);
//if (($state == "NULL") or ($state == " ")){
 foreach ($output1['result']['address_components'] as $thing){//need a more descriptive variable than $thing...
 foreach ($thing['types'] as $type){
  if($type == 'administrative_area_level_3'){
  $city = $thing['long_name'];
}if($type == 'administrative_area_level_1'){
$state = $thing['long_name'];
  //admin change Jano 20160706 - start
   $replace = array('"',"'");
   $replace_with = array("","");
   $new_state = str_replace($replace,$replace_with,$state)  ;
  //admin change Jano 20160706 - end
  $sql= "UPDATE Orgs SET OrgState='".$new_state."' WHERE Org=".$Org; //trying something here...
  $aff= update_db($db_connection, $sql);
}if($type == 'country'){
  $country = $thing['long_name'];

  $lowered_country = strtolower($country);

  $fixed_country = ucfirst($lowered_country);

  $sql= "UPDATE Orgs SET OrgCountry='".$fixed_country."' WHERE Org=".$Org;
  $aff= update_db($db_connection, $sql);
  $Org++;
 $sql = "UPDATE OrgsPointer SET Pointer='".$Org."' WHERE Ind=1";
	$aff=update_db($db_connection, $sql);
	$x++;
}}}
/*}else NOTE!!This function is tied off above, see if (($state == "NULL") $sql = "UPDATE Orgs SET OrgState ='".$state."' WHERE Org=".$Org;
  $aff=update_db($db_connection, $sql);
   $sql = "UPDATE Orgs SET OrgCountry ='".$country."' WHERE Org=".$Org;
  $aff=update_db($db_connection, $sql); */
   foreach ($output1['result'] as $k => $v) {
    if ($k == "website"){
      $site = $v;}
        $sql = "UPDATE Orgs SET OrgUrl ='".$site."' WHERE Org=".$Org;
     $aff=update_db($db_connection, $sql);}
$fixed_org = Encoding::toUTF8($org);
$lowered_country = strtolower($country);
//echos for tracking.
	echo "<td><p>".$Org."</p></td>\n";
	echo "<td><p>".$status."</p></td>\n";
	echo "<td><p>".$fixed_org."</p></td>\n";
	echo "<td><p>".$lat."</p></td>\n";
	echo "<td><p>".$lon."</p></td>\n";
  echo "<td><p>".$state."</p></td>\n";
  echo "<td><p>".$fixed_country."</p></td>\n";
  echo "<td><p>".$site."</p></td>\n";
    echo "<tr/>\n";
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
