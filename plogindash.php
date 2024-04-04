<?php
session_start();
if(!isset($_SESSION['puser']))
  header("Location:pdash.html");
?>
<html>
<body>
welcome <?php 
echo $_SESSION['puser']."<br><br><br>";
require_once("dbconnect.php");
$sql="SELECT * FROM request,provider WHERE provider.puser=request.pname";
$result=mysqli_query($conn,$sql);
$result_check=mysqli_num_rows($result);
$puser=$_SESSION['puser'];
if($result_check)
{
while($e=$result->fetch_assoc())
{
  $stype=$e['stype'];
  $a=$e['pcount'];
  $ccount=$e['ccount'];
}

if($a==0)
{
  if($result_check>0)
  {
    echo "you have 1 new request<br>";
    echo "click here to view<br>";
    echo '<form action="paccept.php" method="POST"><input type="submit" name="view" value="view"></form>';
    echo "<br><br>";
  }
}
else
{
  if($ccount=='0')
  {
  echo "is the request for ".'<b>'.$stype.'</b>'." been completed?<br>";
  echo '<form action="pupdate.php"><input type="submit" name="yes" value="yes"></form>';
  }
}
echo "<br><br>";
if($ccount=='1')
{
  echo "";
}
else
{
  echo 'click here to update your status;
  <form action="pavail.php" method="GET">
    <input type="radio" name="avail" value="available">available<br>
    <input type="radio" name="avail" value="not available">not available<br>
    <input type="submit"><br><br>
    </form>
    </body>
    </html>';
}
}
else
  echo "no requests<br>";
?>
<html>
<body>
<form action="sdestroy.php">
  <p align="right">
  <input type="submit" value="logout">
  </p>
</form>
<form action="pdelete.php" method="SESSION">
  click to delete yout account <input type="submit" name="delete" value="delete">
</form>
</body>
</html>