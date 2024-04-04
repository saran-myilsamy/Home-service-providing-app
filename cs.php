<?php
session_start();
if(!isset($_SESSION['puser']))
  header("Location:pdash.html");
?>
<head>
<style>
  body {
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
  background:lightblue;
}

.topnav {
  overflow: hidden;
  background-color: #333;
}


.topnav a {
  float: right;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

.topnav a:hover {
  background-color: white;
  color: black;
}
.button {
  padding: 15px 25px;
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
.overlay {
  position: fixed;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  background: rgba(0, 0, 0, 0.7);
  transition: opacity 500ms;
  visibility: hidden;
  opacity: 0;
}
.overlay:target {
  visibility: visible;
  opacity: 1;
}

.pop {
  margin: 70px auto;
  padding: 20px;
  background: #fff;
  border-radius: 5px;
  width: 30%;
  position: relative;
  transition: all 5s ease-in-out;
}

.pop h2 {
  text-align: center;
  margin-top: 0;
  color: #333;
  font-family: Tahoma, Arial, sans-serif;
}
.pop .close {
  position: absolute;
  top: 20px;
  right: 30px;
  transition: all 200ms;
  font-size: 30px;
  font-weight: bold;
  text-decoration: none;
  color: #333;
}
.pop .close:hover {
  color: #06D85F;
}
.pop .content {
  max-height: 30%;
  overflow: auto;
}

@media screen and (max-width: 700px){
  .box{
    width: 70%;
  }
  .pop{
    width: 70%;
  }
}

</style>
</head>
<div class="topnav">
  <div class="box">
<a href="#pop1">logout</a>
<a href="#pop2">delete account</a>
<a href="phistory.php">History</a>
</div>
</div>

<div id="pop2" class="overlay">
<div class="pop">
  <h2>you have deleted your account</h2>
  <a class="close" href="pdelete.php">&times;</a>
</div>
</div>
<div id="pop1" class="overlay">
<div class="pop">
  <h2>sucessfully logout </h2>
  <a class="close" href="sdestroy.php">&times;</a>
</div>
</div>
<br><br>
<html>
<body>
<p align="center"  style="font-size:30px;">
welcome <?php 
echo $_SESSION['puser']."<br><br><br>";
require_once("dbconnect.php");
$sql="SELECT * FROM request,provider WHERE provider.puser=request.pname";
$result=mysqli_query($conn,$sql);
$result_check=mysqli_num_rows($result);
$puser=$_SESSION['puser'];
$isthis='';
$stype='';
$a='';
$ccount='';
$paccept='';
if($result_check>0)
{
while($e=$result->fetch_assoc())
{
  $stype=$e['stype'];
  $a=$e['pcount'];
  $ccount=$e['ccount'];
  $isthis=$e['isthis'];
  $paccept=$e['paccept'];
}
}
else
  echo "<br>no requests<br>";
if($a==0)
{
  if($result_check>0)
  {
    echo "<p align='center'>you have 1 new request<br></p>";
    echo "<p align='center'>click here to view<br></p>";
    echo '<form action="paccept.php" method="POST"><center><input type="submit" class="button" name="view" value="view"></center></form>';

    echo "<br><br>";
  }
}
else
{
  if($isthis==0)
  {
     $sql8="SELECT pphone FROM provider,request WHERE request.pname=provider.puser";
    $result8=mysqli_query($conn,$sql8);
    while($e8=$result8->fetch_assoc())
    {
      $a8=$e8['pphone'];
    }
  echo "is the request for ".'<b>'.$stype.'</b>'." been completed?<br>";
  echo '<form action="pupdate.php"><center><input type="submit" name="yes" class="button" value="yes"></center></form>';

  echo'<p style="font-size:30px; text-align: center;">';
    echo "customers phone number:".$a8;
    echo '</p>';
 }

}
echo "<br><br>";
if($ccount=='1')
{
  echo '<p style="font-size:30px; text-align:center;">no new requests<br></p>';
}
else
{
 echo '<center>
click here to update your status<br><br>
<form action="pavail.php" method="GET" >
  <input type="radio" name="avail" value="available">available<br><br>
  <input type="radio" name="avail" value="not available">not available<br><br>
  <input type="submit" value="submit" class="button"><br><br>';
}
if($paccept=="rejected")
{
  echo '<center>
click here to update your status<br><br>
<form action="pavail.php" method="GET" >
  <input type="radio" name="avail" value="available">available<br><br>
  <input type="radio" name="avail" value="not available">not available<br><br>
  <input type="submit" value="submit" class="button"><br><br></form>';
}
//new change(history)
/*$sql5="SELECT * FROM history WHERE pname='$puser'";
  $result5=mysqli_query($conn,$sql5);
  $result_check5=mysqli_num_rows($result5);
  if($result_check5>0)
  {
    echo "<br>Click here to view your history";
    echo '<form action=phistory.php method="GET"><center><input type="submit" name="submit" class="button" value="view"></form></center>';
  }*/
?>