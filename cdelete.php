<head>
	<style >
		body{
			 background:lightgreen;
		}
	</style>
</head>
<?php
session_start();
if(!isset($_SESSION['cuser']))
	header("Location:cdash.html");
require_once("dbconnect.php");
$a=$_SESSION['cuser'];
$sql = "DELETE FROM customer WHERE cuser='$a'";
if ($conn->query($sql) === TRUE) {
    session_destroy();
	header("refresh:1;url=cdash.html");
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
    header("refresh:1;url=cdash.html");
}
$conn->close(); 
?>