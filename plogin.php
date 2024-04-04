<?php
session_start();
require_once("dbconnect.php");
if(isset($_POST['submit']))
{
	$username=$_POST['username'];
	$password=$_POST['password'];
	if(empty($username)||empty($password))
	{
		echo "<p align='center'><font size='10pt'>there are empty fields</font></p>";
		header("refresh:2;url=pdash.html");
	}
	else
	{
		$sql="SELECT * FROM provider WHERE puser='$username'";
		$result=mysqli_query($conn,$sql);
		$result_check=mysqli_num_rows($result);
		$row=mysqli_fetch_assoc($result);
		if($result_check==0){
			echo '<html>
					<html>
                   <head>
                   <script>
                  alert("Youre not an existing provider");
                 </script>
                 </head>
                 <body>
                </body>
                </html>
                 ';
			header("refresh:0.1;url=pdash.html");
		}
		else
		{
				/*/$hashpcheck=password_hash($password,PASSWORD_DEFAULT);
				echo $hashpcheck."<br>";
				echo $row['ppass']."<br>";*/
				if($password!==$row['ppass'])
				{
					echo '<html>
					<html>
                   <head>
                   <script>
                  alert("Invalid password");
                 </script>
                 </head>
                 <body>
                </body>
                </html>
                 ';
					header("refresh:0.1;url=pdash.html");
				}
				else
				{
					$_SESSION['puser']=$row['puser'];
					echo'<html>
					<html>
                   <head>
                   <script>
                  alert("Login success");
                 </script>
                 </head>
                 <body>
                </body>
                </html>
                 ';
					header("refresh:0.1;url=cs.php");
				}
			}
		}
	}
//}
else
{
	echo '<html>
					<html>
                   <head>
                   <script>
                  alert("Please press submit button");
                 </script>
                 </head>
                 <body>
                </body>
                </html>
                 ';
	header("refresh:0.5;url=pdash.html");
}
?>