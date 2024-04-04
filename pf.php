<?php
require_once("dbconnect.php");
$password=$_POST['password'];
$passlen=strlen($password);
$uname=$_POST['uname'];
if(!isset($_POST['submit']))
{
	header("Location:pforgot.php");
}
if($passlen>=6)
{
	$sql="UPDATE provider SET ppass='$password' WHERE puser='$uname'";
	if($conn->query($sql))
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
		header("refresh:0.1;url=pdash.html");
	}
	else
	{
		$msg=$conn->error;
		echo'<html>
		<head>

<script>
page="'.$msg.'";
alert(page);
</script>
</head>
<body>

</body>
</html>';
header("refresh:0.1;url=pforgot.html");
	}
}
else
	{
		echo '<html>
<head>
<script>
alert("minimum password length 6");
</script>
</head>
<body>

</body>
</html>';
		header("refresh:0.1;url=pforgot.php");
	}
?>