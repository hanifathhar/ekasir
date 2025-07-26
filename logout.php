<?php
session_start();
session_destroy();
include("page/config/config.php");


$user = $_SESSION['username'];
$pass = $_SESSION['password'];

echo "<script>document.location='index.php'</script>\n";
?>