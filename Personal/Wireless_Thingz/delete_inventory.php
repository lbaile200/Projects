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
$ID=$_GET["ID"];
$sql = "DELETE FROM Inventory WHERE ID='$ID'";
if (!mysqli_query($con,$sql)) {
	die('Error: ' .mysqli_error($con));
}
else{
echo $ID;
echo "Deleted";
}
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

