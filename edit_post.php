<?php session_start();
date_default_timezone_set("Asia/Bangkok");
include "connect_server.php";
$id_post= $_GET["main"];
$post_head = $_POST['post_head'];
$post_info = $_POST['post_info'];
$post_status = $_POST['status'];
$imgname= $_FILES["pic_post_file"]["name"];
$imgtmpFile = $_FILES["pic_post_file"]["tmp_name"];

if($imgname != null){
$sql = "UPDATE post_all SET name_post ='$post_head' ,status_post = '$post_status', pic_post ='$imgname' , info_post ='$post_info' where id_post = '$id_post' "; 
$result = $conn -> query($sql);
if($result){
    if($imgtmpFile != null){
     if (!copy($imgtmpFile,"picture_post/".$imgname)) {
        print "<script>alert('เกิดข้อผิดพลาดกรุณาลองใหม่ในภายหลัง')</script>" ;
        print "<script>window.location='view.php';</script>";
    }else{
    print "<script>alert('บันทึกเรียบร้อย')</script>" ;
    print "<script>window.location='view.php';</script>";
    }
 
} else{
    print "<script>alert('บันทึกเรียบร้อย')</script>" ;
    print "<script>window.location='view.php';</script>";
 }
}else{
    print "<script>alert('เกิดข้อผิดพลาดกรุณาลองใหม่ในภายหลัง')</script>" ;
    print "<script>window.location='view.php';</script>";
 }}else{
    $sql = "UPDATE post_all SET name_post ='$post_head' ,status_post = '$post_status', info_post ='$post_info' where id_post = '$id_post' "; 
    $result = $conn -> query($sql);
    if($result){
        print "<script>alert('บันทึกเรียบร้อย')</script>" ;
        print "<script>window.location='view.php';</script>";
    }else{
        print "<script>alert('เกิดข้อผิดพลาดกรุณาลองใหม่ในภายหลัง')</script>" ;
        print "<script>window.location='view.php';</script>";
     }
    }
 ?>