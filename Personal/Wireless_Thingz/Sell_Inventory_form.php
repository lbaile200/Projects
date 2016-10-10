<html>
<head>
<link rel="stylesheet" type="text/css" href="bb.css">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
<title>Wireless Thingz Update your inventory</title>

</script>
</head>

<body bgcolor="#FFFFFF">
<?php
echo "<p>Update Inventory item</p>";
$ID=$_GET['ID'];
echo $ID;
?>
<form name="submit_form" action="sell_inventory.php" method="post"><input type="hidden" name="ID" value="<?php $Item_Name=$_GET['ID']; echo $Item_Name; ?>"><br><p>Item Type</p>
   <input type="text" name="Item_Price_Out">Sold Price<br>
   <input type="textarea" rows="5" cols="20" name="Notes">Notes<br>
   <input type="submit"><input type="button" value="Done"
   onclick="window.location.href='show_inventory.php'">
</form>
</body>
</html>
