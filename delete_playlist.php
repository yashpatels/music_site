<?php



$con = mysqli_connect("localhost","root","") or die("Cannot connect to server.");
mysqli_select_db($con,"music") or die("Cannot Connect to db");

session_start();
$username=$_SESSION["username"];
if($username==''){
   echo "<script>location='home.php';</script>";
}

$name=$_GET['name'];
$delete_qry="DELETE FROM `playlists` WHERE username='$username' AND name='$name'";
mysqli_query($con,$delete_qry);
echo "<script>location='test3.php';</script>";
?>