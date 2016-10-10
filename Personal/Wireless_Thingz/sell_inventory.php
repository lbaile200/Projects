<html>
<head>
<title>Update!</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<body bgcolor="#FFFFFF">

<?php

$con=mysqli_connect("localhost","root","Purplefishland7.","WT_Inventory"); //may not need var$con
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
//need real escape strings for security
$ID=$_POST["ID"];
$Notes=$_POST["Notes"];
$Item_Price_Out=$_POST["Item_Price_Out"];
// figure out how to add yes/no for dm field
//commenting out SET init='init', for now
$sql="UPDATE Inventory SET Sold=1 WHERE ID='$ID'";
if (!mysqli_query($con,$sql)) {
	die('Error: ' .mysqli_error($con));
}
if ($Item_Type != ""){
$sql="UPDATE Inventory SET Item_Type='$Item_Type' WHERE ID='$ID'";
if (!mysqli_query($con,$sql)) {
	die('Error: ' .mysqli_error($con));
}
}else{
echo $ID;
echo "updated";
}
 if ($Item_Price_Out != ""){
$sql="UPDATE Inventory SET Item_Price_Out='$Item_Price_Out' WHERE ID='$ID'";
if (!mysqli_query($con,$sql)) {
	die('Error: ' .mysqli_error($con));
}
}else{
echo $ID;
echo "updated";
} if ($Notes !=""){
$sql="UPDATE Inventory SET Notes='$Notes' WHERE ID='$ID'";
if (!mysqli_query($con,$sql)) {
	die('Error: ' .mysqli_error($con));
}
}else{
echo $ID;
echo "updated";

																																					}
/*
$sql = "UPDATE Inventory 
	SET Item_Type='$Item_Type', Item_Name='$Item_Name', Item_Cost_In='$Item_Cost_In', Item_Price_Out='$Item_Price_Out', Cash_Price='$Cash_Price', Trade_Price='$Trade_Price', Carrier='$Carrier', Status='$Status', Imei_Meid='$Imei_Meid', Associate='$Associate', Notes='$Notes' 
	WHERE ID='$ID' ";
if (!mysqli_query($con,$sql)) {
	die('Error: ' .mysqli_error($con));
}
else{
echo $ID;
echo "updated";
}
*/
mysqli_close($con);
		
/*
$RealUser=$_POST['user'];
$init=$_POST['init'];
echo $init;
echo $RealUser;
*/
?>
</body>
</html> 

