<!DOCTYPE html>
<html>
<script type="text/javascript">
	function loginpage()
	{
		document.getElementById('modalbackground').style.display='block';
		document.getElementById('login').style.display='block';
		document.getElementById('signup').style.display='none';
	}
	function cancel()
	{
		document.getElementById('modalbackground').style.display='none';		
	}
	function signup()
	{
		document.getElementById('modalbackground').style.display='block';
		document.getElementById('login').style.display='none';
		document.getElementById('signup').style.display='block';
	}
</script>
<head>
<link rel="apple-touch-icon-precomposed" sizes="57x57" href="apple-touch-icon-57x57.png" />
	<title>Muzikk</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="music.css">
</head>
<style type="text/css">
</style>
<body style="margin: 0; padding: 0; font-family: Raleway-SemiBold, sans-serif;">
<div id="modalbackground">
	<div id="login" class="up">
		<form name="login" action="" method="POST">
			<table align="center">
				<tr><input placeholder="UserName" type="text" name="username" required></tr>
				<tr><input placeholder="Password" type="password" name="password" required></tr>
			</table>
			<input type="submit" class="button" name="logup">
			<button class="button" style="margin-left: 20px;" onclick="cancel()">Cancel</button>
			<p>Don't Have Account ? <x onclick="signup()">Click Here</x></p>
		</form>
	</div>
	<div id="signup" class="up">
					<form name="signups" action="" method="POST">
						<table align="center">
							<tr><input placeholder="Name" type="text" name="name" required></tr>
							<tr><input placeholder="UserName" type="text" name="username" required></tr>
							<tr><input placeholder="Email" type="email" name="email" required></tr>							
							<tr><input placeholder="Password" type="password" name="pass" required></tr>
							<tr><input placeholder="Confirm Password" type="password" name="confpass" required></tr>
							<tr><input type="radio" name="gender" value="Male" checked="checked">Male<input type="radio" name="gender" value="Female">Female</tr>
						</table>
					<input type="submit" class="button" name="signin" style="margin-top: 20px;">
					<button class="button" style="margin-left: 20px;" onclick="cancel()">Cancel</button>
					</form>
	</div>
	</div>
	<div id="navbar">
		<div id="logo"><font face="Bunch Blossoms Personal Use" size="6px"><a href="Home.html">Muzikk&hearts;</a></font></div>
		<div id="logsign"><b><a href="#" onclick="loginpage()">LogIn</a><a>|</a><a href="#" onclick="signup()">SignUp</a></b></div>
	</div>
	<div id="main">	
		<h1 align="center" style="color: white; margin-top: 0; padding-top: 100px;">Discover What's Trending</h1>
		<h3 align="center" style="color: white">Keep Playing</h3>
	</div>
	<div id="footer">
		<div id="logo" style="width: 33.333%">
			<font face="Bunch Blossoms Personal Use" size="6px"><a href="Home.html">Muzikk&hearts;</a></font>
		</div>
		<div id="footercontent"><b><a href="#">AboutUs</a><a>|</a><a href="#">Help</a></b>
		
		<a href="#" class="fa fa-facebook"></a>
		<a href="#" class="fa fa-instagram"></a>
		</div>
	</div>
</body>
</html>


<?php
if(isset($_POST['logup']))
{
	$conn=mysqli_connect("localhost","root","") or die("Could Not Connect");
mysqli_select_db($conn,"Muzikk");
$username=$_POST["username"];
$password=$_POST["password"];
$query="select * from register where username='$username' and password='$password'";
$run=mysqli_query($conn,$query);
if(mysqli_num_rows($run)==1)
{
	echo "<script>window.open('userhome.html','_self')</script>";
}
else
{
	echo"<script>alert('Incorrect Username or Password');</script>";
}
}
else if(isset($_POST['signin']))
{
	
$conn=mysqli_connect("localhost","root","") or die("could not connect");
mysqli_select_db($conn,"Muzikk")
or mysqli_query($conn,"create database muzikk");
mysqli_select_db($conn,"Muzikk");
$name=$_POST["name"];
$username=$_POST["username"];
$email=$_POST["email"];
$pass=$_POST["pass"];
$conf=$_POST["confpass"];
$gender=$_POST["gender"];
$checkuser="select * from register where username='$username'";
$checkemail="select * from register where email='$email'";
$runuser=mysqli_query($conn,$checkuser);
$runemail=mysqli_query($conn,$checkemail);
$cntuser=mysqli_num_rows($runuser);
$cntemail=mysqli_num_rows($runemail);
if($cntuser>0 && $cntemail>0 )
{
  echo "<script>alert('Username And Email Already Exist.Choose Another');</script>";
}
else if($cntuser>0)
{
  echo "<script>alert('Username Already Exist.Choose Another');</script>";
}
else if($cntemail>0 )
{
  echo "<script>alert('Email Already Exist.Choose Another');</script>";
}
else
{
  if($pass==$conf)
  {
	 $sql="INSERT INTO register (name,username,email,password,gender) VALUES ('$name','$username','$email','$pass','$gender')";
	 if (mysqli_query($conn,$sql))
	 {
      echo "<script>alert('Registration succesful!');</script>";
    }
    else
    {
   		$ql= "create table register(name VARCHAR(20),username VARCHAR(20),email VARCHAR(20),password VARCHAR(20),gender VARCHAR(20))";
   		if(mysqli_query($conn,$ql))
   		{
    		if (mysqli_query($conn,$sql))
    		{
    			   echo "<script>alert('Registration succesful!');location='home.html';</script>";
			
			}
		}
	}
}
else
{
	echo '<script language="javascript">';
	echo 'alert("Password Did Not MATCH")';
	echo '</script>';
}}
}
?>