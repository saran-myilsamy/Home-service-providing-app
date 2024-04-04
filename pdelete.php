<?php
session_start();
if(!isset($_SESSION['puser']))
	header("Location:pdash.html");
require_once("dbconnect.php");
$a=$_SESSION['puser'];
$sql = "DELETE FROM provider WHERE puser='$a'";
if ($conn->query($sql) === TRUE) {
    $sql1="DELETE FROM service WHERE puser='$a'";
    mysqli_query($conn,$sql1);
    session_destroy();
	header("refresh:1;url=pdash.html");
}
else
{
  $msg=$conn->error;
			echo '<html>
}
<head>
<script>
page="'.$msg.'";
alert(page);
</script>
</head>
<body>

</body>
</html>';
header("refresh:0.1;url=pdash.html");
}
$conn->close(); 
?>