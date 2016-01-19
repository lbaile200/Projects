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

//simple form to take University name
echo
 '<form action="" method="post" name="submit">
  University: <input type="text" name="location"><br>
  <input type="submit" name="submit" value="submit">
 </form>';

//Take data input from form to our actual function
if (isset($_POST['submit'])){
 $loc=$_POST['location'];

//this will pull out spaces and replace with + sign to comply with google API
 $locrep = str_replace(" ", "+", $loc);

//feed our fancy (corrected) location to google using their API.  Should probably strip key and use variable, who has time for that?
 $url=file_get_contents("https://maps.googleapis.com/maps/api/place/textsearch/json?query=$locrep&key=AIzaSyDvd4rwvfYzF5X1bwF3FIf6Ibn46XbFkq0");

//API changed to PLACES API.  Change is small.  https://developers.google.com/places/web-service/search
 $output=json_decode($url);
  $lat=$output->results[0]->geometry->location->lat;//this is case sensitive, be careful
  $lon=$output->results[0]->geometry->location->lng;
  $id=$output->results[0]->place_id;
  $adr=file_get_contents("https://maps.googleapis.com/maps/api/place/details/json?&placeid=$id&key=AIzaSyDvd4rwvfYzF5X1bwF3FIf6Ibn46XbFkq0");
 $output1=json_decode($adr, true);

 foreach ($output1['result'] as $finder){
 foreach ($finder['website'] as $finder1){
 if ($finder1 !== ''){
 $url1 = $finder1;
}
}

 }
 foreach ($output1['result']['address_components'] as $thing){//need a more descriptive variable than $thing...
 foreach ($thing['types'] as $type){
  if($type == 'administrative_area_level_3'){
  $city = $thing['long_name'];
}
  if($type == 'administrative_area_level_1'){
  $state = $thing['long_name'];
}
  if($type == 'country'){
  $country = $thing['long_name'];
}
}
}
echo $url1;
echo "<br/>";
echo $country;
echo "<br/>";
echo $state;
echo "<br/>";
echo $city;
echo "<br/>";
echo $lat;
echo "<br/>";
echo $lon;
}
?>
</body>
</html>
