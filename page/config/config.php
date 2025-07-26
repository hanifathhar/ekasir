<?php

$servername="localhost";
$username="root";
$password="rahasia";

/*
$servername="192.168.2.5";
$username="prg#s3rv3r#pro";
$password="s3rv3r#2019%root.&";
*/

$databasename="dbsimretail";

$conn=mysqli_connect($servername,$username,$password,$databasename);

if(!$conn){
    die("Koneksi Gagal Tersambung");
}
?>