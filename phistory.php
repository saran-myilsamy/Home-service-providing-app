<head>
<style>
	body{
background:lightblue;
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
session_start(); 
if(!isset($_SESSION['puser']))
	header("Location:index.hml");
else
{
	$a=$_SESSION['puser'];
	require_once("dbconnect.php");
	$sql5="SELECT * FROM history WHERE pname='$a'";
	$result5=mysqli_query($conn,$sql5);
	$result_check5=mysqli_num_rows($result5);
	echo "<p align='center' style='font-size:30px;'>History</p>";
	if($result_check5>0)
	{
echo "<table>
			<tr>
			<th>Your Name</th>
			<th>Customer Name</th>
			<th>Service Type</th>
			<th>Date</th>
			</tr>";
			$e5=$result5->fetch_assoc();
		while($result_check5>0)
		{
			echo'<tr>
    		<td>'.$e5['pname'].'</td>
    		<td>'.$e5['cname'].'</td>
    		<td>'.$e5['stype'].'</td>
    		<td>'.$e5['date'].'</td>
  			</tr>';
  			echo "<br>";
  			$result_check5--;
		}
	echo "</table>";
	}
	else{
		echo '<html>
<head>

<script>
alert("No Request Placed Yet/You May Have Pending Request");
</script>
</head>
<body>

</body>
</html>';
header("refresh:0.1;url=cs.php");
	}	 
}
?>