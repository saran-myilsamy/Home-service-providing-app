<head>
	<style>
		body{
			 background:lightgreen;
		}
	</style>
</head>
<?php
require_once("dbconnect.php");
if(isset($_POST['submit']))
{
	$uname=str_replace(' ','',$_POST['uname']);
	$username=$_POST['username'];
	$password=$_POST['password'];
	$p1=password_hash($password,PASSWORD_DEFAULT);
	$place=$_POST['place'];
	$email=$_POST['email'];
	$street=$_POST['street'];
	$dob=$_POST['dob'];
	$dob_arr=explode('-', $dob);
	$phone=$_POST['phone'];
	$phlen=strlen($phone);
	$passlen=strlen($password);
	//unnecessary if
	if(empty($uname)||empty($username)||empty($password)||empty($place)||empty($email)||empty($dob)||empty($phone))
	{
		echo "there are empty records<br>";
		echo "you will be redirected to signup page in 2 seconds<br>";
		header("refresh:2;url=csignup.html");
	}
	else
	{
		if($dob_arr[0]<=2000)
		{
		if($passlen>=6)
		{
		if($phlen==10 && preg_match("/^[0-9]*$/",$phone))
		{
		if(preg_match("/^[a-zA-Z]*$/",$username))
		{
		$sql = "INSERT INTO customer(cuser, cname, cpass, cplace, cstreet, email,DOB,cphone) VALUES ('$uname','$username','$password','$place','$street','$email','$dob','$phone')";
		if ($conn->query($sql) === TRUE) {
    								echo '<html>
<head>
<script>
alert("You Have Created New Account");
</script>
</head>
<body>

</body>
</html>';
			header("refresh:0.1;url=cdash.html");
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
    		
    		header("refresh:0.1;url=csignup.html");
		}
		} 
		else
		{
			    								echo '<html>
<head>
<script>
alert("Alphabets are the only characters allowed");
</script>
</head>
<body>

</body>
</html>';
			
			
			header("refresh:0.1;url=csignup.html");
		}
		}
		else
		{
						echo '<html>
<head>
<script>
alert("Invalid phone number");
</script>
</head>
<body>

</body>
</html>';
			
			header("refresh:0.1;url=csignup.html");		
		}
		}
		else
		{
						echo '<html>
<head>
<script>
alert("Minimum password of length 6");
</script>
</head>
<body>

</body>
</html>';
			header("refresh:0.1;url=csignup.html");
		}
		}
		else
		{
						echo '<html>
<head>
<script>
alert("Enter a valid Date Of Birth");
</script>
</head>
<body>

</body>
</html>';
			header("refresh:0.1;url=csignup.html");
		}
	}
}
else
	header("Location:csignup.html");
?>