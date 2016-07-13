<html>
<head>
<title>pagerduty_display</title>
</head>
<body bgcolor="#FFFFFF">
<?php
//set our timezone to something sane.
date_default_timezone_set('America/Kentucky/Monticello');
//the current iteration of the script does not know that weekend pages start at 7:00 PM.  I propose a rule change, as I am lazy.
$con=mysqli_connect("localhost", "root", "Purplefishland7.", "Pagerduty");
//check connection
if (mysqli_connect_errno())
{echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$user=$_POST["User"];
//the below function gathers a sum.  A few things to be worked out, this does not do our correct 'page' math and any page that took less than 1 minute is assumed as 0 minutes.
echo "<h2>Total time spent on trouble pages</h2>";
//total weekend minutes spent
$sum_weekend = mysqli_query($con, "SELECT SUM(Duration) AS SUM, COUNT(Incident) AS COUNT FROM Pages WHERE Resolved_By='".$user."' AND WEEKDAY(Opened_On) BETWEEN 5 AND 6");
while ($row = mysqli_fetch_array($sum_weekend)) {
echo "".$row['SUM']." <b>Weekend</b> Minutes Spent total(beta)";
echo "<br/>";
echo "".$row['COUNT']." <b>Weekend</b> Pages total(beta)";
}
//total weekday minutes spent
echo "<br/>";
$sum_weekday = mysqli_query($con, "SELECT SUM(Duration) AS SUM, COUNT(Incident) AS COUNT FROM Pages WHERE Resolved_By='".$user."' AND WEEKDAY(Opened_On) BETWEEN 0 AND 4");
while ($row = mysqli_fetch_array($sum_weekday)) {
  echo "".$row['SUM']." <b>Weekday</b> Minutes Spent total(beta)";
  echo "<br/>";
  echo "".$row['COUNT']." <b>Weekday</b> Pages total(beta)";}
//total minutes spent
echo "<br/>";
$sum = mysqli_query($con, "SELECT SUM(Duration) AS SUM, COUNT(Incident) AS COUNT FROM Pages WHERE Resolved_By='".$user."'");
while ($row = mysqli_fetch_array($sum)) {
  echo "".$row['SUM']."  Minutes Spent total(beta)";
  echo "<br/>";
  echo "".$row['COUNT']."  Pages total(beta)";}
echo "<br/>";
//begin main tables
$user=$_POST["User"];
$result = mysqli_query($con, "SELECT Duration, Incident, Opened_On, Resolved_On, Resolved_By FROM Pages WHERE Resolved_By='".$user."'AND Resolved_On >= '*-*-* 1:00' AND WEEKDAY(Opened_On) BETWEEN 0 AND 4");
echo "<table border='0' width='50%'>
</hr>
<h1>Weekday Pages (after 9:00 PM)</h1>
<tr>
<th>Incident</th>
<th>Opened_On</th>
<th>Solved_On</th>
<th>Solved_By</th>
<th>Duration</th>
</tr>";
while ($row = mysqli_fetch_array($result)) {
echo "<tr>";
echo "<td>" . $row ['Incident'] . "</divi></td>";
echo "<td>" . $row ['Opened_On'] . "</divi></td>";
echo "<td>" . $row ['Resolved_On'] . "</divi></td>";
echo "<td>" . $row ['Resolved_By'] . "</divi></td>";
echo "<td>" . $row ['Duration'] . "</divi></td>";
echo "</tr>";
}

$user=$_POST["User"];
$result1 = mysqli_query($con, "SELECT Duration, Incident, Opened_On, Resolved_On, Resolved_By FROM Pages WHERE Resolved_By='".$user."'AND Resolved_On >= '*-*-* 19:00' AND WEEKDAY(Opened_On) BETWEEN 5 AND 6");
echo "<table border='0' width='50%'>
</hr>
<h1>Weekend Pages (after 7:00 PM)</h1>
<tr>
<th>Incident</th>
<th>Opened_On</th>
<th>Solved_On</th>
<th>Solved_By</th>
<th>Duration</th>
<th>Minutes</th>
</tr>";
/*
while ($row = mysqli_fetch_array($result1)) {
  foreach($row ['Duration'] as $a){
    echo $a;
    if ($a < "15"){
      $a == "15";
    }
      echo $a;

      }

    echo $time;
*/
while ($row = mysqli_fetch_array($result1)){
echo "<tr>";
echo "<td>" . $row ['Incident'] . "</divi></td>";
echo "<td>" . $row ['Opened_On'] . "</divi></td>";
echo "<td>" . $row ['Resolved_On'] . "</divi></td>";
echo "<td>" . $row ['Resolved_By'] . "</divi></td>";
echo "<td>" . $row ['Duration'] . "</divi></td>";
echo "</tr>";

}

/*$sql="SELECT Duration FROM Pages WHERE Resolved_By='".$user."' AND Resolved_On >= '*-*-* 21:00';";
echo $sql;
echo '<br/>';
$result=mysqli_query($con, $sql);
while ($row = mysql_fetch_array($result)) {
$row_incident = $row['incident'];
echo $row_incident;
}
*/
/*if ($result->num_rows > 0){
 //output each row
 while($row = $result->fetch_assoc()) {
  echo "<br> Incident:".$row["incident"]." - Opened: ".$row["Opened_On"]." - Closed: ".$row["Closed_On"]." - Duration: ".$row["Duration"]."";
}
}
*/
mysqli_close($con);

?>
</body>
</html>
