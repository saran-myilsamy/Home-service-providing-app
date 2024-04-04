<?php
session_start();
if(!isset($_SESSION['puser']))
	header("Location:pdash.html");
$puser=$_SESSION['puser'];
require_once("dbconnect.php");
$sql="UPDATE request SET pupdate=1 WHERE pname='$puser'";
if($conn->query($sql))
{
	echo'<html>
					<html>
                   <head>
                   <script>
                  alert("Sucessfully updated");
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
?>