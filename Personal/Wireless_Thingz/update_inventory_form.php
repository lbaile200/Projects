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
<form name="submit_form" action="update_inventory.php" method="post"><input type="hidden" name="ID" value="<?php $Item_Name=$_GET['ID']; echo $Item_Name; ?>"><br><p>Item Type</p>
<select  <select 
name="Item_Type">Select Inventory Type
    <option value="">Pick One...
    <option value="Phone">Phone
    <option value="Case">Case
    <option value="Cable">Cable
    <option value="Misc">Misc
   </select><br/>
   <input type="text" name="Item_Name">Item Name<br>
   <input type="text" name="Item_Price_Out">Retail Price<br>
   <input type="text" name="Cash_Price">Cash Price<br>
   <input type="text" name="Number">Number of items<br>
   <input type="text" name="Trade_Price">Trade Price<br>
   <input type="text" name="Imei_Meid">IMEI/MEID<br>
<p>Carrier</p>
   <select name="Carrier">Select Carrier
    <option value="">Pick One...
    <option value="Verizon">Verizon
    <option value="ATT">ATT
    <option value="TMobile">T Mobile
    <option value="Sprint">Sprint
    <option value="Cricket">Cricket
    <option value="Boost">Boost
    <option value="US_Cellular">US Cellular
    <option value="Unlocked">Unlocked
    <option value="Generic_CDMA">Generic CDMA
    <option value="Generic_GSM">Generic GSM
   </select><br/>
<p>Status</p>
   <select name="Status">Item Status
    <option value="">Pick One...
    <option value="Processing">Processing
    <option value="Back_Stock">Back Stock
    <option value="Repair">In Repair
    <option value="Ready">Ready to sell
    <option value="Lost_Stolen">Lost/Stolen
    <option value="Misc">Misc.
    <option value="Scrap">Scrap
   </select><br/>
<p>Associate</p>
   <select name="Associate">Associate
    <option value="">Pick One...
    <option value="Lucas">Lucas Bailey
    <option value="Tom">Tom Bailey
    <option value="Tabatha">Tabatha Bailey
    <option value="Joe">Joe Bailey
    <option value="Bruce">Bruce Helms
    <option value="Misc">Misc.
   </select><br/>
   <input type="textarea" rows="5" cols="20" name="Notes">Notes<br>
   <input type="submit"><input type="button" value="Done"
   onclick="window.location.href='show_inventory.php'">
</form>
</body>
</html>
