<head>
	<style>
		body{
			 background:lightgreen;
		}
	</style>
</head>
<?php
require_once("dbconnect.php");
session_start();
if(!isset($_SESSION['cuser']))
	header("Location:cdash.html");
if(!isset($_POST['resu']))
	header("Location:clogindash.php");
$stype=$_POST['cs'];
$cuser=$_SESSION['cuser'];
$puser=$_POST['resu'];
$area=$_POST['cstreet'];
$date=date("Y/m/d");
$sql="INSERT INTO request(pid, cname, pname, stype, paccept, area, date, cupdate, pupdate ,pcount,ccount) VALUES ('','$cuser','$puser','$stype','','$area','$date','','','0','0')";
if($conn->query($sql))
{
	echo '<html>
<head>
<script>
alert("Request Placed Successfully");
</script>
</head>
<body>

</body>
</html>';
	  header("refresh:0.1;url=clogindash.php");
}
else
	{
		$msg=$conn->error;
			echo '<html>
<head>
<script>
page="'.$msg.'";
alert(page);
</script>
</head>
<body>

</body>
</html>';
 header("refresh:0.1;url=clogindash.php");
	}
?>