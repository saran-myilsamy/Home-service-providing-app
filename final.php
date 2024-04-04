<?php
session_start();
require_once("dbconnect.php");
$provider=$_POST['provider'];
if(!isset($_SESSION['cuser']))
{
	//header("Location:cdash.html");
}
else
{
	$a=$_SESSION['cuser'];
	$sql="UPDATE provider SET pavail=1 WHERE puser='$provider'";
	if ($conn->query($sql) === TRUE) 
	{
    	$sql1="SELECT * FROM request WHERE cname='$a'";
    	$result=mysqli_query($conn,$sql1);
    	while($e=$result->fetch_assoc())
		{
 			$stype=$e['stype'];
 			$area=$e['area'];
 			$date=$e['date'];
		}
		if($conn->query($sql1))
		{
			$sql2="INSERT INTO history(id, cname, pname, stype, area, date) VALUES ('','$a','$provider','$stype','$area','$date')";
			if($conn->query($sql2))
			{
				$sql3="DELETE FROM request WHERE cname='$a'";
				if($conn->query($sql3))
				{
					echo '<html>
<head>
<script>
alert("Your request has been completed");
</script>
</head>
<body>

</body>
</html>';
					header("refresh:1;url=clogindash.php");
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
      header("refresh:1;url=clogindash.php");
  
			}
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
      
  header("refresh:1;url=clogindash.php");
			
		}
	} 
}
else {
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
header("refresh:1;url=clogindash.php");
}
}
?>