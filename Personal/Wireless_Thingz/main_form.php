<html>
<head>
<title>Add_Inventory_WT</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<body bgcolor="#FFFFFF">
<a href="/index.php">back to main site</a>
 <form name="submit_form" action="add_inventory_script.php" method="post">
   <select name="Item_Type">Select Inventory Type
    <option value="Phone">Phone
    <option value="Case">Case
    <option value="Cable">Cable
    <option value="Misc">Misc
   </select><br/>
   <input type="text" name="Item_Name">Item Name<br>
   <input type="text" name="Item_Cost_In">Item Cost (Internal)<br>
   <input type="text" name="Item_Price_Out">Item Price (To customer)<br>
   <select name="Carrier">Select Carrier
    <option value="Verizon">Verizon
    <option value="ATT">ATT
    <option value="TMobile">T Mobile
    <option value="Sprint">Sprint
    <option value="Cricket">Cricket
    <option value="Boost">Boost
    <option value="Unlocked">Unlocked
    <option value="Generic_CDMA">Generic CDMA
    <option value="Generic_GSM">Generic GSM
   </select><br/>
   <select name="Status">Item Status
    <option value="Processing">Processing
    <option value="Repair">In Repair
    <option value="Ready">Ready to sell
    <option value="Scrap">Scrap
   </select><br/>
   <input type="textarea" rows="5" cols="20" name="Notes">Notes<br>
   <input type="submit"><input type="button" value="Done"
   onclick="window.location.href='show_inventory.php'">
</form>



  </form>
</body>
</html>
