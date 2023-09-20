<?php session_start();?>
<html><center>
<?php
include "connect_server.php";
$user=$_POST["user"];
$pass=$_POST["pass"];
$sql = "SELECT * from user_member where username like '$user' and password like '$pass'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {   
    $row = $result->fetch_assoc();
    $_SESSION["username"] = $user;
    $_SESSION["status_user"] = $row['status_member']; 
    print "<script>alert('login Complete')</script>" ;
    print "<script>window.location='view.php';</script>";
   
}else{
    print "<script>alert('Username or Password Incorect')</script>" ;
    print "<script>window.location='login.php';</script>";
}
?></html>