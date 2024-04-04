<?php
session_start();
//unset($_SESSION['puser']);
session_destroy();
header("Location:hinsert.html");
exit();
?>