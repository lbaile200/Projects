<html>
<head>
<title>Wireless_Thingz_Inventory</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<body bgcolor="#FFFFFF">

<?php
$con=mysqli_connect("localhost","root","Purplefishland7.","WT_Inventory"); //may not need var$con
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
//need real escape strings for security
$Item_Type=$_POST["Item_Type"];//find correct var for this
$Item_Name =$_POST["Item_Name"];
$Item_Cost_In=$_POST["Item_Cost_In"];
$Item_Price_Out=$_POST["Item_Price_Out"];
$Carrier=$_POST["Carrier"];
$Notes=$_POST["Notes"];
// figure out how to add yes/no for dm field
$sql = "INSERT INTO Inventory (Item_Type, Item_Name, Item_Cost_In, Item_Price_Out, Carrier, Notes, Date_Purchased_In) VALUES ('$Item_Type', '$Item_Name', '$Item_Cost_In', '$Item_Price_Out', '$Carrier', '$Notes', now())";
if (!mysqli_query($con,$sql)) {
	die('Error: ' .mysqli_error($con));
}
else{
echo "Item added";}
mysqli_close($con);
?>
<br/>
<input type="button" value="Add More Inventory"
   onclick="window.location.href='main_form.php'">
<input type="button" value="Done, show me"
   onclick="window.location.href='battlebitchdisplay.php'">

</body>
</html>
