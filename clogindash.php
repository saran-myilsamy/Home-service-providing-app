<?php
session_start();
if(!isset($_SESSION['cuser']))
  header("Location:cdash.html");
?>
<html>
<body>
<head>
<style>
  body{
     background:lightgreen;
  }
  input[type=text],select{
    width:300px;
    font-size: 20px;
    padding:12px 20px;
    margin:11px 0;
    display:inline-block;
    border:4px solid #ccc;
    border-radius:4px;
    box-sizing:border-box;
  }
.top{
  position:absolute;
  top:10px;
  right:16px;
}
.topr{
  position:absolute;
  top:10px;
  right:130px;
}
body {
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
 
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
<a href="chistory.php">History</a>
</div>
</div>

<div id="pop2" class="overlay">
<div class="pop">
  <h2>you have deleted your account</h2>
  <a class="close" href="cdelete.php">&times;</a>
</div>
</div>
<div id="pop1" class="overlay">
<div class="pop">
  <h2>sucessfully logout </h2>
  <a class="close" href="sdestroy.php">&times;</a>
</div>
</div>

<p style="font-size:30px; text-align: center;">
Welcome <?php 
echo $_SESSION['cuser'];
?>
</p>
<form action="ccheck.php"  method="POST">
<center>
<div class="custom-select" style="width:300px;">
  
<h2><b>select your service</b></h2>
<select name="cservice">
  <option value="carpentry">carpentry</option>
  <option value="plumbing">plumbing</option>
  <option value="electrition">electrition</option>
</select><br><br><br>
</div>
  <input type="submit" class="button" name="check" value="check"><br>
</center>
</form> 
<p style="font-size:30px; text-align: center;">
<?php
$a=$_SESSION['cuser'];
require_once("dbconnect.php");
$sql="SELECT paccept,stype FROM request WHERE cname='$a'";
$result=mysqli_query($conn,$sql);
//$msg=null;
$result_check=mysqli_num_rows($result);
//$i=0;
if($result_check){
if($conn->query($sql))
{
  while($e=$result->fetch_assoc())
  {
  $a1=$e['paccept'];
  $b=$e['stype'];
  }
  if($a1=="accepted")
  {
    echo "<br>Your Request For ".'<b>'.$b.'</b>'." Has Been ".'<b>'."Accepted".'</b><br>';
    $sql1="SELECT pcount FROM request WHERE cname='$a'";
    mysqli_query($conn,$sql1);
    while($e1=$result->fetch_assoc())
    {
      $a1=$e1['pcount'];
    }
    if($a1==0)
    {
    if($result_check>0)
    {
        echo "<br>Is The Request For ".'<b>'.$b.'</b>'." Has Been Completed?<br>";
        echo '<form action="cupdate.php"><center><input type="submit" name="yes" value="yes" class="button"></center></form>';
    }
    }
    $sql8="SELECT cphone FROM customer,request WHERE request.cname=customer.cuser";
    $result8=mysqli_query($conn,$sql8);
    while($e8=$result8->fetch_assoc())
    {
      $a8=$e8['cphone'];
    }
    echo'<p style="font-size:30px; text-align: center;">';
    echo "Provider Phone Number:".$a8;
    echo '</p>';
  }
  elseif($a1=="rejected")
  {
    echo "<br>Sorry Your Request For ".'<b>'.$b.'</b>'." Has Been ".'<b>'."Rejected".'</b>';
    $sql1="DELETE FROM request WHERE cname='$a'";
    mysqli_query($conn,$sql1);
  }
  elseif($a1=='')

    
    echo "<br>Your Request For <br><b>".$b."</b> Is Still Pending ";
    
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
        header("refresh:0.1;url=clogindash.php");
      

}
}
else
  echo "<br>No Request Placed Yet";
//final updation
  $sql4="SELECT * FROM request WHERE cname='$a'";
  $result1=mysqli_query($conn,$sql4);
  $result_check1=mysqli_num_rows($result1);
  if($result_check1>0)
  {
  if ($conn->query($sql4) == TRUE) 
  {
    $result=mysqli_query($conn,$sql4);
    while($e=$result->fetch_assoc())
    {
      $pupdate=$e['pupdate'];
      $cupdate=$e['cupdate'];
      $provider=$e['pname'];
    }
    if($pupdate=='1' && $cupdate=='1')
    {
      echo '<form action="final.php" method="POST">
          <input type="hidden" name="provider" value="'.$provider.'">';
      echo '<p  style="font-size:30px; text-align:center;">click here to complete your request<br></p>';
      echo '<center><input type="submit" name="submit" class="button">
          </center></form>';
    }
  } 
  else {
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
header("refresh:0.1;url=clogindash.php");
 }     
}
  /*$sql5="SELECT * FROM history WHERE cname='$a'";
  $result5=mysqli_query($conn,$sql5);
  $result_check5=mysqli_num_rows($result5);
  if($result_check5>0)
  {
    echo "<br>Click here to view your history";
    echo '<form action=chistory.php method="GET"><center><input type="submit" name="submit" value="view" class="button"></form></center>';
  }*/
?>
</p>
</body>
</html>



