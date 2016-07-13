<?php //started 12:35 pm 2/14/2014 Lucas
require("../script/cache.php");
require("./common/sql-def2.php");
require("./common/ap-dml2.php");
require("../script/common.php");
require("../script/Encoding.php");
$db_connection=open_database($db_server, $db_database, $db_username, $db_password);
//mysql_query("SET NAMES utf8");
?>
<html>
<head>
<title>latlong.php</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body bgcolor="#FFFFFF">
<?php
/*1= North America
2=South America
3=Africa
4=Asia
5=Europe
6=Oceania*/
$sql = "SELECT COUNT(Name) FROM Orgs";
$totalcount=sql_return_one_number($db_connection, $sql);
$fixedcount=$totalcount-5;
echo "<h3>We have worked with over ".$fixedcount." schools world-wide!</h3>";
echo "<div style='Float: Left'>";

function display_organizations($Continent, $Continent_Name, $Disp_Ready){
$Disp_Ready = $_GET['dispready'];
$sql = "SELECT Orgs.OrgUrl, Orgs.Name, Orgs.OrgState, Orgs.OrgCountry, Countries.iContinent FROM Orgs INNER JOIN Countries ON Orgs.OrgCountry=Countries.Country WHERE iContinent=".$Continent." AND Disp_Ready='".$Disp_Ready."' AND Name IS NOT NULL ORDER BY OrgCountry, OrgState, Name";
$rows = sql_run_select($db_connection, $sql);
for ($i=0; $i<= $rows-1; $i=$i+1){
$OrgURL = $gp_db_array[$i]["OrgUrl"];
$Name = $gp_db_array[$i]["Name"];
$Name0 = strtolower($Name);
$Name1 = ucwords($Name0);
$fixed_name = Encoding::toUTF8($Name1);
$state = $gp_db_array[$i]["OrgState"];
$country = $gp_db_array[$i]["OrgCountry"];
$countryfix=strtolower($country);
$realcountry=ucwords($countryfix);
 if ($OrgURL == ""){
  echo  "<p>".$fixed_name.": ".$state.", ".$realcountry."</p>";
  }else{
  echo  "<a href=".$OrgURL.">".$fixed_name."</a> ".$state.", ".$realcountry."";
  }
echo "<br/>";
}
}

display_organizations(1, "North America");
display_organizations(2, "South America");
display_organizations(3, "Africa");
display_organizations(4, "Asia");
display_organizations(5, "Europe");
display_organizations(6, "Oceania");
/*
echo "</div>";
echo "<h1>South America</h1>";
$sql = "SELECT Orgs.OrgUrl, Orgs.Name, Orgs.OrgState, Orgs.OrgCountry, Countries.iContinent FROM Orgs INNER JOIN Countries ON Orgs.OrgCountry=Countries.Country WHERE iContinent=2 AND Name IS NOT NULL ORDER BY OrgCountry, OrgState, Name";
$rows = sql_run_select($db_connection, $sql);
for ($i=0; $i<= $rows-1; $i=$i+1){
  $OrgURL= $gp_db_array[$i]["OrgUrl"];
  $Name = $gp_db_array[$i]["Name"];
  $Name0 = strtolower($Name);
  $Name1 = ucwords($Name0);
  $fixed_name = Encoding::toUTF8($Name1);
  //$state = $gp_db_array[$i]["State"];
  $country = $gp_db_array[$i]["OrgCountry"];
  $countryfix=strtolower($country);
  $realcountry=ucwords($countryfix);
 if ($OrgURL == ""){
  echo  "<p>".$fixed_name.", ".$realcountry."</p>";
  }else{
  echo  "<a href=".$OrgURL.">".$fixed_name."</a> ".$realcountry."";
  }
echo "<br/>";
}
echo "<h1>Africa</h1>";
$sql = "SELECT Orgs.OrgUrl, Orgs.Name, Orgs.OrgState, Orgs.OrgCountry, Countries.iContinent FROM Orgs INNER JOIN Countries ON Orgs.OrgCountry=Countries.Country WHERE iContinent=3 AND Name IS NOT NULL ORDER BY OrgCountry, OrgState, Name";
$rows = sql_run_select($db_connection, $sql);
for ($i=0; $i<= $rows-1; $i=$i+1){
  $OrgURL= $gp_db_array[$i]["OrgUrl"];
  $Name = $gp_db_array[$i]["Name"];
  $Name0 = strtolower($Name);
  $Name1 = ucwords($Name0);
  $fixed_name = Encoding::toUTF8($Name1);
//  $state = $gp_db_array[$i]["State"];
  $country = $gp_db_array[$i]["OrgCountry"];
  $countryfix=strtolower($country);
  $realcountry=ucwords($countryfix);
  if ($OrgURL == ""){
  echo  "<p>".$fixed_name.", ".$realcountry."</p>";
  }else{
  echo  "<a href=".$OrgURL.">".$fixed_name."</a> ".$realcountry."";
  }
echo "<br/>";
}
echo "<h1>Asia</h1>";
$sql = "SELECT Orgs.OrgUrl, Orgs.Name, Orgs.OrgState, Orgs.OrgCountry, Countries.iContinent FROM Orgs INNER JOIN Countries ON Orgs.OrgCountry=Countries.Country WHERE iContinent=4 AND Name IS NOT NULL ORDER BY OrgCountry, OrgState, Name";
$rows = sql_run_select($db_connection, $sql);
for ($i=0; $i<= $rows-1; $i=$i+1){
  $OrgURL= $gp_db_array[$i]["OrgUrl"];
  $Name = $gp_db_array[$i]["Name"];
  $Name0 = strtolower($Name);
  $Name1 = ucwords($Name0);
  $fixed_name = Encoding::toUTF8($Name1);
//  $state = $gp_db_array[$i]["State"];
  $country = $gp_db_array[$i]["OrgCountry"];
  $countryfix=strtolower($country);
  $realcountry=ucwords($countryfix);
 if ($OrgURL == ""){
  echo  "<p>".$fixed_name.", ".$realcountry."</p>";
  }else{
  echo  "<a href=".$OrgURL.">".$fixed_name."</a> ".$realcountry."";
  }
echo "<br/>";
}
echo "<h1>Europe</h1>";
$sql = "SELECT Orgs.OrgUrl, Orgs.Name, Orgs.OrgState, Orgs.OrgCountry, Countries.iContinent FROM Orgs INNER JOIN Countries ON Orgs.OrgCountry=Countries.Country WHERE iContinent=5 AND Name IS NOT NULL ORDER BY OrgCountry, OrgState, Name";
$rows = sql_run_select($db_connection, $sql);
for ($i=0; $i<= $rows-1; $i=$i+1){
  $OrgURL= $gp_db_array[$i]["OrgUrl"];
  $Name = $gp_db_array[$i]["Name"];
  $Name0 = strtolower($Name);
  $Name1 = ucwords($Name0);
  $fixed_name = Encoding::toUTF8($Name1);
//  $state = $gp_db_array[$i]["State"];
  $country = $gp_db_array[$i]["OrgCountry"];
  $countryfix=strtolower($country);
  $realcountry=ucwords($countryfix);
 if ($OrgURL == ""){
  echo  "<p>".$fixed_name.", ".$realcountry."</p>";
  }else{
  echo  "<a href=".$OrgURL.">".$fixed_name."</a> ".$realcountry."";
  }
echo "<br/>";
}
echo "<h1>Oceania</h1>";
$sql = "SELECT Orgs.OrgUrl, Orgs.Name, Orgs.OrgState, Orgs.OrgCountry, Countries.iContinent FROM Orgs INNER JOIN Countries ON Orgs.OrgCountry=Countries.Country WHERE iContinent=6 AND Name IS NOT NULL ORDER BY OrgCountry, OrgState, Name";
$rows = sql_run_select($db_connection, $sql);
for ($i=0; $i<= $rows-1; $i=$i+1){
  $OrgURL= $gp_db_array[$i]["OrgUrl"];
  $Name = $gp_db_array[$i]["Name"];
  $Name0 = strtolower($Name);
  $Name1 = ucwords($Name0);
  $fixed_name = Encoding::toUTF8($Name1);
  //$state = $gp_db_array[$i]["State"];
  $country = $gp_db_array[$i]["OrgCountry"];
  $countryfix=strtolower($country);
  $realcountry=ucwords($countryfix);
 if ($OrgURL == ""){
  echo  "<p>".$fixed_name.", ".$realcountry."</p>";
  }else{
  echo  "<a href=".$OrgURL.">".$fixed_name."</a> ".$realcountry."";
  }
echo "<br/>";
}
//while ($result = mysql_fetch_array($array, MYSQL_ASSOC)){
//foreach ($result as $thing){//need a more descriptive variable than $thing...
//echo $thing;

/*$string = "http";
foreach ($result as $r) {
strstr("http", "<br/>", $r);
echo $r;
  }
}*/
//}
//}
//}
//echo $test;

?>

</body>

</html>
