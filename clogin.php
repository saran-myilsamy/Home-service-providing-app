<head>
	<style>
		body{
			 background:lightgreen;
		}
	</style>
</head>
<?php
session_start();
require_once("dbconnect.php");
if(isset($_POST['submit']))
{
	$username=$_POST['username'];
	$password=$_POST['password'];
	if(empty($username)||empty($password))
	{
		echo "there are empty fields";
		header("refresh:2;url=cdash.html");
	}
	else
	{
		$sql="SELECT * FROM customer WHERE cuser='$username'";
		$result=mysqli_query($conn,$sql);
		$result_check=mysqli_num_rows($result);
		$row=mysqli_fetch_assoc($result);
		if($result_check<1){
			echo '<html>
					<html>
                   <head>
                   <script>
                  alert("Youre not an existing user");
                 </script>
                 </head>
                 <body>
                </body>
                </html>
                 ';
			header("refresh:0.1;url=cdash.html");
		}
		else
		{
			//if($row=mysqli_fetch_assoc($result)){
				//$hashpcheck=password_verify($password,$row['cpass']);
				if($password!==$row['cpass']) {
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
					header("refresh:0.1;url=cdash.html");
				}
				else
				{
					$_SESSION['cuser']=$row['cuser'];
					
                  echo '<html>
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
					header("refresh:0.1;url=clogindash.php");
				}
			}
		}
	}
//}
else
{
	echo'<html>
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
	header("refresh:0.1;url=pdash.html");
}
?>