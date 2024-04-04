<head>
	<style>
		body{
		 background:lightgreen;
		}
	</style>
</head>

<?php
require_once("dbconnect.php");
$password=$_POST['password'];
$passlen=strlen($password);
$uname=$_POST['uname'];
if(!isset($_POST['submit']))
{
	header("Location:cforgot.php");
}
if($passlen>=6)
{
	$sql="UPDATE customer SET cpass='$password' WHERE cuser='$uname'";
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
		header("refresh:0.1;url=cdash.html");
	}
	echo
		$conn->error;
}
else
	{
		echo '<html>
<head>
<script>
alert("minimum of length 6");
</script>
</head>
<body>

</body>
</html>';
		header("refresh:0.1;url=cforgot.php");
	}
?>