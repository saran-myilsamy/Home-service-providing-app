<?php
session_start();
if(!isset($_SESSION['puser']))
	header("Location:pdash.html");
$puser=$_SESSION['puser'];
require_once("dbconnect.php");
$sql="SELECT puser FROM provider WHERE provider.puser='$puser'";
$result=mysqli_query($conn,$sql);
while($e=$result->fetch_assoc())
{
 	$a=$e['puser'];
 	$sql1="UPDATE request SET paccept='accepted' WHERE pname='$a'";
}
if($conn->query($sql))
	{
		if($conn->query($sql1))
		{
			$sql2="UPDATE request SET pcount=1 WHERE pname='$puser'";
			mysqli_query($conn,$sql2); 
			//updation on providers table pavail=0;
			$sql3="UPDATE provider SET pavail=0 WHERE puser='$puser'";
			mysqli_query($conn,$sql3);
			//blocking provider for availability status updation
			$sql4="UPDATE request SET ccount=1 WHERE pname='$puser'";
			mysqli_query($conn,$sql4);
			echo'<html>
					<html>
                   <head>
                   <script>
                  alert("Successfully accepted");
                 </script>
                 </head>
                 <body>
                </body>
                </html>
                 ';
			header("refresh:0.1;url=cs.php");
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
     header("refresh:0.1;url=cs.php");	
    	
	}
}
else
{
	echo'<html>
					<html>
                   <head>
                   <script>
                  alert("Unknown error");
                 </script>
                 </head>
                 <body>
                </body>
                </html>
                 ';
                 header("refresh:0.1;url=cs.php");
}
/*$sql1="SELECT * FROM request WHERE pname='$puser'";
$result=mysqli_query($conn,$sql1);
if($conn->query($sql))
	{
	while($e=$result->fetch_assoc())
		{

 			$cname=$e['cname'];
 			$pname=$e['pname'];
 			$stype=$e['stype'];
 			$area=$e['area'];
 			$date=$e['date'];
 		}
 		$sql2="INSERT INTO history(id, cname, pname, stype, area, date) VALUES ('','$cname','$pname','$stype','$area','$date')";
 		if($conn->query($sql2))
		{
			echo "successfully accepted";
			header("refresh:2;url=plogindash.php");
		}
		else
			echo $conn->error;
	}
else
	echo "unknown error1";*/
?>