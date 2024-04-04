<?php
session_start();
$avail=$_GET['avail'];
if($avail=='available')
	$update=1;
else
	$update=0;
if(!isset($_SESSION['puser']))
	header("Location:pdash.html");
else
	$puser=$_SESSION['puser'];
if(!isset($avail))
{
	echo '<html>
<head>
<script>
alert("Press any one");
</script>
</head>
<body>

</body>
</html>';
	header("refresh:1;url=cs.php");
}
else
{
	include_once("dbconnect.php");
	$sql="UPDATE provider SET pavail='$update' WHERE puser='$puser'";
	if($conn->query($sql)==TRUE)
	{
		echo '<html>
<head>
<script>
alert("Successfully updated");
</script>
</head>
<body>

</body>
</html>';
		header("refresh:0.1;url=cs.php");
	}
	else

		
}
?>
