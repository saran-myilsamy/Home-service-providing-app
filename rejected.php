<?php
session_start();
if(!isset($_SESSION['puser']))
	header("Location:pdash.html");
$puser=$_SESSION['puser'];
require_once("dbconnect.php");
$sql="SELECT pname FROM provider WHERE provider.puser='$puser'";
$result=mysqli_query($conn,$sql);
if($conn->query($sql))
	{
		 $sql1="UPDATE request SET paccept='rejected',ccount='1',pcount='1' WHERE pname='$puser'";
		if($conn->query($sql1))
		{
			 $sql1="UPDATE request SET isthis=1 WHERE pname='$puser'";
       mysqli_query($conn,$sql1);
			echo '<html>
					<html>
                   <head>
                   <script>
                  alert(" Successfully rejected");
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
	echo '<html>
					<html>
                   <head>
                   <script>
                  alert("unknown error");
                 </script>
                 </head>
                 <body>
                </body>
                </html>
                 ';
                      header("refresh:0.1;url=cs.php");
                      
}
?>