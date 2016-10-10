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
$Item_Type=$_POST["Item_Type"];//find correct var for this
$Item_Name =$_POST["Item_Name"];
//$Item_Cost_In=$_POST["Item_Cost_In"];
$Item_Price_Out=$_POST["Item_Price_Out"];
$Cash_Price=$_POST["Cash_Price"];
$Number=$_POST["Number"];
$Trade_Price=$_POST["Trade_Price"];
$Carrier=$_POST["Carrier"];
$Status=$_POST["Status"];
$Imei_Meid=$_POST["Imei_Meid"];
$Associate=$_POST["Associate"];
$Notes=$_POST["Notes"];
// figure out how to add yes/no for dm field
//commenting out SET init='init', for now
if ($Item_Type != ""){
$sql="UPDATE Inventory SET Item_Type='$Item_Type' WHERE ID='$ID'";
if (!mysqli_query($con,$sql)) {
	die('Error: ' .mysqli_error($con));
}
else{
echo $ID;
echo "updated";
}
} if ($Item_Name != ""){
$sql="UPDATE Inventory SET Item_Name='$Item_Name' WHERE ID='$ID'";
if (!mysqli_query($con,$sql)) {
	die('Error: ' .mysqli_error($con));
}
else{
echo $ID;
echo "updated";
}
/*} if ($Item_Cost_In != ""){
$sql="UPDATE Inventory SET Item_Cost_In='$ItemCost_In' WHERE ID='$ID'";
if (!mysqli_query($con,$sql)) {
	die('Error: ' .mysqli_error($con));
}
else{
echo $ID;
echo "updated";
}
*/} if ($Item_Price_Out != ""){
$sql="UPDATE Inventory SET Item_Price_Out='$Item_Price_Out' WHERE ID='$ID'";
if (!mysqli_query($con,$sql)) {
	die('Error: ' .mysqli_error($con));
}
else{
echo $ID;
echo "updated";
}
} if ($Cash_Price != ""){
$sql="UPDATE Inventory SET Cash_Price='$Cash_Price' WHERE ID='$ID'";
if (!mysqli_query($con,$sql)) {
	die('Error: ' .mysqli_error($con));
}
else{
echo $ID;
echo "updated";
}
} if ($Number != ""){
$sql="UPDATE Inventory SET Number='$Number' WHERE ID='$ID'";
if (!mysqli_query($con,$sql)) {
	die('Error: ' .mysqli_error($con));
}
else{
echo $ID;
echo "updated";
}
} if ($Trade_Price != ""){
$sql="UPDATE Inventory SET Trade_Price='$Trade_Price' WHERE ID='$ID'";
if (!mysqli_query($con,$sql)) {
	die('Error: ' .mysqli_error($con));
}
else{
echo $ID;
echo "updated";
}
} if ($Carrier != ""){
$sql="UPDATE Inventory SET Carrier='$Carrier' WHERE ID='$ID'";
if (!mysqli_query($con,$sql)) {
	die('Error: ' .mysqli_error($con));
}
else{
echo $ID;
echo "updated";
}
} if ($Status != ""){
$sql="UPDATE Inventory SET Status='$Status' WHERE ID='$ID'";
if (!mysqli_query($con,$sql)) {
	die('Error: ' .mysqli_error($con));
}
else{
echo $ID;
echo "updated";
}
} if ($Imei_Meid != ""){
$sql="UPDATE Inventory SET Imei_Meid='$Imei_Meid' WHERE ID='$ID'";
if (!mysqli_query($con,$sql)) {
	die('Error: ' .mysqli_error($con));
}
else{
echo $ID;
echo "updated";
}
} if ($Associate != ""){
$sql="UPDATE Inventory SET Associate='$Associate' WHERE ID='$ID'";
if (!mysqli_query($con,$sql)) {
	die('Error: ' .mysqli_error($con));
}
else{
echo $ID;
echo "updated";
}
} if ($Notes !=""){
$sql="UPDATE Inventory SET Notes='$Notes' WHERE ID='$ID'";
if (!mysqli_query($con,$sql)) {
	die('Error: ' .mysqli_error($con));
}
else{
echo $ID;
echo "updated";
}
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

