<head>
  <style>
    body{
       background:lightgreen;
    }
  </style>
</head>

<?php
session_start();
if(!isset($_SESSION['cuser']))
	header("Location:cdash.html");
$cuser=$_SESSION['cuser'];
require_once("dbconnect.php");
$sql="UPDATE request SET cupdate=1 WHERE cname='$cuser'";
if($conn->query($sql))
{
   echo '<html>
          <html>
                   <head>
                   <script>
                  alert("Successfully updated");
                 </script>
                 </head>
                 <body>
                </body>
                </html>
                 ';
	header("refresh:0.1;url=clogindash.php");
}
else
{
 	$msg=$conn->error;
  echo '<html>
          <html>
                   <head>
                   <script>
                  page="'.$msg.'";
                  alert(page);
                 </script>
                 </head>
                 <body>
                </body>
                </html>
                 ';
                   header("refresh:0.1;url=clogindash.php");  
               }

?>