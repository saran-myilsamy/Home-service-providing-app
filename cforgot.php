<!DOCTYPE html>
<html>
<style>
body {
  background:lightgreen;
  font-family: Arial, Helvetica, sans-serif;}
* {box-sizing: border-box}
input[type=password]{
	width: 300px;
  padding: 15px;
  margin: 11px 0 22px 0;
  display: inline-block;
  border: none; 
  background: #f1f1f1;
}
input[type=password]:focus{
	 background-color: #ddd;
  outline: none;
}
.container {
  width:480px;
  margin: 20px auto 0;
  background: lightyellow;
  padding: 90px;
  box-sizing: border-box;
  height: auto;
  position:relative;
  box-shadow: 0 0 10px rgba(150,150,150,0.5) ;
}
.button {
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: auto;
  opacity: 0.9;
}

.button:hover {
  opacity:1;
}
}
</style>
</head>

<?php
if(!isset($_GET['submit']))
	header("Location:cforgot.html");
require_once("dbconnect.php");
$uname=$_GET['uname'];
$email=$_GET['email'];
$dob=$_GET['dob'];
$phone=$_GET['phone'];
$sql="SELECT * FROM customer WHERE cuser='$uname'";
$result=mysqli_query($conn,$sql);
$result_check=mysqli_num_rows($result);
if($result_check>0)
{
	if($conn->query($sql))
	{
	while($e=$result->fetch_assoc())
		{
		$uname1=$e['cuser'];
		$email1=$e['email'];
		$dob1=$e['DOB'];
		$phone1=$e['cphone'];
		}
	if($uname===$uname1 && $email===$email1 && $dob===$dob1 && $phone==$phone1)
	{
		echo '<form action="cf.php" method="POST" >
		 <div class="container">
		 <div class="form">
			 <label for="psw"><b>Password</b></label><br>
         <input type="password" placeholder="minimum length of 6" name="password" required><br><br>
         </div>
			  <input type="hidden" name="uname" value="'.$uname.'">
			  <input type="submit" name="submit" class="button" value="Submit">
			  </div>
			  </form>';
			}
	else
	{
		echo '<html>
<head>
<script>
alert("Try again");
</script>
</head>
<body>

</body>
</html>';
		header("refresh:0.1;url=cforgot.html");
	}
	}
	else{
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
header("refresh:0.1;url=cforgot.html");
      
	}
}
else
{
	echo '<html>
<head>
<script>
alert("No existing user");
</script>
</head>
<body>

</body>
</html>';
	header("refresh:0.1;url=cdash.html");
}
?>