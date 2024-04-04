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
	$dob=$_POST['dob'];
	$dob_arr=explode('-', $dob);
	$phone=$_POST['phone'];
	$phlen=strlen($phone);
	$passlen=strlen($password);
	$serve=$_POST['serve'];
	if(empty($serve))
	{
		echo '<html>
<head>

<script>
alert("Select atleast any one of the service");
</script>
</head>
<body>

</body>
</html>';
header("refresh:0.1;url=psignup.html");
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
		$sql = "INSERT INTO provider(puser, ppass, pname, pphone, pavail, pplace, pemail, DOB) VALUES ('$uname','$password','$username','$phone','1','$place','$email','$dob')";
		if ($conn->query($sql) === TRUE ) {
    	
			echo '<html>
<head>

<script>
alert("You have created a new account");
</script>
</head>
<body>

</body>
</html>';
    	    	for($pos = 0; $pos < sizeof($serve); $pos++ ) 
			$conn -> query("insert into service(puser, stype,id) values('".$uname."','".$serve[$pos]."','')");
			header("refresh:0.5;url=pdash.html");
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
    		//echo "Error: "."<br>" . $conn->error;
    		header("refresh:0.5;url=psignup.html");
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
			
			header("refresh:0.5;url=psignup.html");
		}
		}
		else
		{
				echo '<html>
<head>
<script>
alert("Invalid phone number);
</script>
</head>
<body>

</body>
</html>';
			header("refresh:0.5;url=psignup.html");		
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
			header("refresh:0.5;url=psignup.html");
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
			header("refresh:0.5;url=psignup.html");
		}
	}
}
else
	header("Location:psignup.html");
$conn->close();

?>