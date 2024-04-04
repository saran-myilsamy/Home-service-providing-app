<head>
<style>
	body{
 background:lightgreen;
}
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 2px solid black;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
</head>

<?php
  /*$sql5="SELECT * FROM history WHERE cname='$a'";
  $result5=mysqli_query($conn,$sql5);
  $result_check5=mysqli_num_rows($result5);
  if($result_check5>0)
  {
    echo "<br>Click here to view your history";
    echo '<form action=chistory.php method="GET"><center><input type="submit" name="submit" value="view" class="button"></form></center>';*/
session_start(); 
if(!isset($_SESSION['cuser']))
	header("Location:index.html");
else
{	
	$a=$_SESSION['cuser'];
	require_once("dbconnect.php");
	$sql5="SELECT * FROM history WHERE cname='$a'";
	$result5=mysqli_query($conn,$sql5);
	$result_check5=mysqli_num_rows($result5);
	if($result_check5>0)
	{
echo "<table>
			<tr>
			<th>Your Name</th>
			<th>Provider Name</th>
			<th>Service Type</th>
			<th>Date</th>
			</tr>";
			$e5=$result5->fetch_assoc();
		while($result_check5>0)
		{
			echo'<tr>
    		<td>'.$e5['cname'].'</td>
    		<td>'.$e5['pname'].'</td>
    		<td>'.$e5['stype'].'</td>
    		<td>'.$e5['date'].'</td>
  			</tr>';
  			echo "<br>";
  			$result_check5--;
		}
		echo "</table>";
	}
	else
	{
		echo'<html>
		<head>

<script>
alert("No Request Placed Yet/You May Have Pending Request");
</script>
</head>
<body>

</body>
</html>';
header("refresh:0.1;url=clogindash.php");
	}
}
?>