<?php session_start();?>
<?php
include "connect_server.php";
session_destroy();
print "<script>alert('Logout finish')</script>" ;
print "<script>window.location='view.php';</script>" ;
?>