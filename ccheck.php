<head>
<style>
  body{
     background:lightgreen;
  }
.button {
  padding: 15px 25px;
  position: absolute;
  float:center;
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
.rbutton
{
  position: absolute;
  left:20px;
}

.button:hover {background-color: #3e8e41}

.button:active {
  background-color: #3e8e41;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}
</style>
</head>
<p style="font-size:30px; text-align: center;">
<?php
require_once("dbconnect.php");
session_start();
if(!isset($_SESSION['cuser']))
	header("Location:cdash.html");

$cservice=$_POST['cservice'];
$cuser=$_SESSION['cuser'];
$sql="SELECT provider.puser,provider.pname FROM service,provider,customer WHERE service.stype='$cservice' and service.puser=provider.puser and provider.pavail=1 and provider.pplace=customer.cplace";
$result=mysqli_query($conn,$sql);
if($conn->query($sql))
{
$result_check=mysqli_num_rows($result);


if($result_check>0)
{
	echo '<p style="font-size:30px;align=left">contact name => unique name</p>';
	while($e=$result->fetch_assoc())
	{
		$a=$e['puser'];
		$b=str_repeat('&nbsp;',10); 
		echo "<br>";
		echo '<form action="crequest.php" method="POST"><input type="radio"  name="resu" class="rbutton" value="'.$a.'">'.$b. $e['pname']."=>".$e['puser'];	
		echo '<br>';	
	}
	echo "<br>";
    echo '<input type="submit" name="place request" align="middle" class="button" value="place request">';

}
else
{
	echo '<html>
          <html>
                   <head>
                   <script>
                  alert("No One To Display!");
                 </script>
                 </head>
                 <body>
                </body>
                </html>
                 ';
                 header("refresh:0.1;url=clogindash.php");
}
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
    	


echo '<input type="hidden" name="cs" value="'.$cservice.'">';
$sql1="SELECT cstreet FROM customer WHERE cuser='$cuser'";
$result1=mysqli_query($conn,$sql1);
if($conn->query($sql1))
{
	
	while($e1=$result1->fetch_assoc())
	{
		$a1=$e1['cstreet'];
	}
	//global $a1;
	echo'<input type="hidden" name="cstreet" value="'.$a1.'">
	    	</form>';
}
else
{
	    echo '<html>
          <html>
                   <head>
                   <script>
                  alert("Unknown error");
                 </script>
                 </head>
                 <body>
                </body>
                </html>
                 ';
                  header("refresh:0.1;url=clogindash.php");
}
echo '</p>';
?>