<head>
<style>
  body{
    background-color: lightblue;
  }
.button{
	position:absolute;
	left:720px;
}
.button {
  padding: 15px 15px;
  font-size: 24px;
  text-align: center;
  cursor: pointer;
  outline: none;
  color: #fff;
  background-color: #4CAF50;
  border: none;
  border-radius: 15px;
  box-shadow: 0 9px #999;
}

.button:hover {background-color: #3e8e41}

.button:active {
  background-color: #3e8e41;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}
.rbutton{
	position:absolute;
	left:850px;
}
.rbutton {
  padding: 15px 15px;
  font-size: 24px;
  text-align: center;
  cursor: pointer;
  outline: none;
  color: #fff;
  background-color: #4CAF50;
  border: none;
  border-radius: 15px;
  box-shadow: 0 9px #999;
}

.rbutton:hover {background-color: #3e8e41}

.rbutton:active {
  background-color: #3e8e41;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}
</style>
</head>
<?php
session_start();
if(!isset($_SESSION['puser']))
	header("Location:pdash.html");
require_once("dbconnect.php");
$sql="SELECT * FROM request,provider WHERE provider.puser=request.pname";
$result=mysqli_query($conn,$sql);
$i=0;
echo "<p align='center'><font size='6pt'>";
while($e=$result->fetch_assoc())
{
	if($i==0)
	{
	echo "the new request is from::";
	echo $e['cname']." ";
	echo "regarding"." ".$e['stype']."<br><br>";
	$i++;
	}
}
echo "</font></p>";
echo'<html>
<body>
<form action="accepted.php" method="GET">
	<input type="submit" name="accept" class="button" value="accept">
</form>
<form action="rejected.php" method="GET">
	<input type="submit" name="reject" class="rbutton" value="reject">
</form>
</body>
</html>';
?>