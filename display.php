<?php
include_once("dbconnect.php");
$sql = "SELECT provider.pname,provider.pphone from provider,customer,service where provider.pavail=1 AND customer.cplace=provider.pplace AND service.stype=1";
$records=$conn->query($sql);
if($records->num_rows!=0)
{
    while($e = $records->fetch_assoc()) {
		echo "<br>".$e['pname']."</br>".$e['pphone'];
    }
}
else
	echo '<html>
<head>
<script>
alert("NO results");
</script>
</head>
<body>

</body>
</html>';
$conn->close();
?>
