<html>
<head>
<link href='https://fonts.googleapis.com/css?family=Oswald:300' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" href="/FTP_ROOT/WT_Inventory/bb.css">
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
<title>Battlebitching displayed easy</title>
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

<?php
 $con=mysqli_connect("localhost","root","Purplefishland7.","WT_Inventory");
 // Check connection
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$sort=$_GET["sort"];
$result = mysqli_query($con,"SELECT ID, Item_Type, Item_Name, Item_Price_Out, Carrier FROM Inventory WHERE Status='Ready' ORDER BY $sort ASC");
//$drop = mysqli_query($con, "DELETE FROM main $user WHERE user LIKE $row");
//while($row = mysqli_fetch_array($result))
//{
echo "<table class=TFtable border='0' width='100%'>
<tr>
<th><a href=show_inventory_CLIENTSIDE.php?sort=Item_Name>Item</a></th>
<th><a href=show_inventory_CLIENTSIDE.php?sort=Item_Type>Type</a></th>
<th><a href=show_inventory_CLIENTSIDE.php?sort=Item_Price_Out>Price</a></th>
<th><a href=show_inventory_CLIENTSIDE.php?sort=Carrier>Carrier</a></th>
</tr>";
while($row = mysqli_fetch_array($result))
{
echo "<tr>";
echo "<td><div contenteditable='False' tabindex='2'>" . $row['Item_Name'] . "</div></td>";
echo "<td><div contenteditable='False' tabindex='3'>" . $row['Item_Type'] . "</div></td>";
echo "<td><div contenteditable='False' tabindex='4'>" . $row['Item_Price_Out'] . "</div></td>";
echo "<td><div contenteditable='False' tabindex='5'>" . $row['Carrier'] . "</div></td>";
echo "</tr>";
}
echo "</table>";
mysqli_close($con);
//}

?>

</div>
</body>
</html>
