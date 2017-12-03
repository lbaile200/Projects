<html>
<head>
<link rel="stylesheet" type="text/css" href="bb.css">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
<title>Wireless Thingz Inventory</title>
<script type="text/javascript" src="js/jquery-1.11.0.js"></script>
<script type="text/javascript">
	  $(document).ready(function () {
      $('#btnHide').click(function () {
          //$('td:nth-child(2)').hide();
          // if your table has header(th), use this
          $('td:nth-child(3),th:nth-child(3)').hide();
      });
  });


      $(document).ready(function () {
          $('.editbtn').click(function () {
              var currentTD = $(this).parents('tr').find('td');
              if ($(this).html() == 'Edit') {
                  currentTD = $(this).parents('tr').find('td');
                  $.each(currentTD, function () {
                      $(this).prop('contenteditable', false)
                  });
              } else {
                 $.each(currentTD, function () {
                      $(this).prop('contenteditable', false)
                  });
              }


<body bgcolor="#FFFFFF">

</script>
<script>
function newwindow(myurl,xsize,ysize)
  {
   istr="";
   istr="scrollbars,resizable,WIDTH=" + xsize + ",HEIGHT=" + ysize;
   //alert(istr);
   newwin=window.open(myurl,"",istr);
  }
</script>

<!BEGIN MAIN TABLE-->
<p>
<a href=/FTP_ROOT/WT_Inventory/main_form.php>Add more inventory</a>
&nbsp / &nbsp
<a href=/FTP_ROOT/WT_Inventory/show_inventory.php>Show UN-sold inventory</a>
</p>
<?php
 $con=mysqli_connect("localhost","root","Purplefishland7.","WT_Inventory");
 // Check connection
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$sort=$_GET["sort"];

$result = mysqli_query($con,"SELECT ID, Item_Type, Item_Name, Item_Price_Out, Cash_Price, Number, Trade_Price, Carrier, Status, Date_Purchased_In, Imei_Meid, Associate, Notes FROM Inventory WHERE Status='SOLD' ORDER BY $sort ASC");

//$drop = mysqli_query($con, "DELETE FROM main $user WHERE user LIKE $row");
//while($row = mysqli_fetch_array($result))
//{
echo "<table class=TFtable border='0' width='100%'>
<tr>
<th><a href=show_sold_inventory.php?sort=ID>ID</a></th>
<th><a href=show_sold_inventory.php?sort=Item_Type>Type</a></th>
<th><a href=show_sold_inventory.php?sort=Item_Name>Item</a></th>
<th><a href=show_sold_inventory.php?sort=Carrier>Carrier</a></th>
<th><a href=show_sold_inventory.php?sort=Status>Status</a></th>
<th><a href=show_sold_inventory.php?sort=Associate>Associate</a></th>
<th><a href=show_sold_inventory.php?sort=Date_Purchased_In>Date Purchased</a></th>
<th><a href=show_sold_inventory.php?sort=Item_Price_Out>Retail Value</a></th>
<th><a href=show_sold_inventory.php?sort=Cash_Price>Cash Value</a></th>
<th><a href=show_sold_inventory.php?sort=Trade_Price>Trade Value</a></th>
<th>IMEI/MEID</th>

<th>Notes</th>

</tr>";
while($row = mysqli_fetch_array($result))
{
echo "<tr>";
echo "<td><div contenteditable='False' tabindex='1'>" . $row['ID'] . "</div></td>";
echo "<td><div contenteditable='False' tabindex='2'>" . $row['Item_Type'] . "</div></td>";
echo "<td><div contenteditable='False' tabindex='3'>" . $row['Item_Name'] . "</div></td>";
echo "<td><div contenteditable='False' tabindex='3'>" . $row['Carrier'] . "</div></td>";
echo "<td><div contenteditable='False' tabindex='4'>" . $row['Status'] . "</div></td>";
echo "<td><div contenteditable='False' tabindex='4'>" . $row['Associate'] . "</div></td>";
echo "<td><div contenteditable='False' tabindex='4'>" . $row['Date_Purchased_In'] . "</div></td>";
echo "<td><div contenteditable='False' tabindex='4'>" . $row['Item_Price_Out'] . "</div></td>";
echo "<td><div contenteditable='False' tabindex='4'>" . $row['Cash_Price'] . "</div></td>";
//echo "<td><div contenteditable='False' tabindex='4'>" . $row['Number'] . "</div></td>";
echo "<td><div contenteditable='False' tabindex='4'>" . $row['Trade_Price'] . "</div></td>";

echo "<td><div contenteditable='False' tabindex='4'>" . $row['Imei_Meid'] . "</div></td>";
echo "<td><div contenteditable='False' tabindex='4'>" . $row['Notes'] . "</div></td>";
$ID=$row['ID'];
$alink="javascript:newwindow(\"update_inventory_form.php?ID=".$ID." &sw=0\",500,700)";
  echo "<td><p><a href='".$alink."'>".EDIT."</p></td>\n";
$alink="javascript:newwindow(\"delete_inventory.php?ID=".$ID." &sw=0\",500,500)";
  echo "<td><p><a href='".$alink."'>".DELETE."</p></td>\n";

echo "</tr>";
}
echo "</table>";
mysqli_close($con);
//}


?>
<a href=/FTP_ROOT/WT_Inventory/main_form.php>Add more inventory</a>
</div>
</body>
</html>
