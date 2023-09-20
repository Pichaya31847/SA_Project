<?php session_start();
header('Content-Type: text/html; charset=UTF-8');
include "connect_server.php";
$accout_post= $_SESSION["username"];
$post_head = $_POST['post_head'];
$post_info = $_POST['post_info'];
$post_status = $_POST['status'];
$imgname= $_FILES["imageFile"]["name"];
$imgtmpFile = $_FILES["imageFile"]["tmp_name"];
$docname= $_FILES["docFile"]["name"];
$doctmpFile = $_FILES["docFile"]["tmp_name"];
$day = date("d");
$date_on_mount = date("m");

if ($date_on_mount =="01"){
    $date_on_mount = "ม.ค.";
}elseif ($date_on_mount =="02"){
    $date_on_mount = "ก.พ.";
}elseif ($date_on_mount =="03"){
    $date_on_mount = "มี.ค.";
}elseif ($date_on_mount =="04"){
    $date_on_mount = "เม.ย.";
}elseif ($date_on_mount =="05"){
    $date_on_mount = "พ.ค.";
}elseif ($date_on_mount =="06"){
    $date_on_mount = "มิ.ย.";
}elseif ($date_on_mount =="07"){
    $date_on_mount = "ก.ค.";
}elseif ($date_on_mount =="08"){
    $date_on_mount = "ส.ค.";
}elseif ($date_on_mount =="09"){
    $date_on_mount = "ก.ย.";
}elseif ($date_on_mount =="10"){
    $date_on_mount = "ต.ค.";
}elseif ($date_on_mount =="11"){
    $date_on_mount = "พ.ย.";
}elseif ($date_on_mount =="12"){
    $date_on_mount = "ธ.ค.";
}
$year= date("Y")+ 543;
$date_create = $day." ".$date_on_mount." ".$year;
$time_create = date("H:i");

$sql = "INSERT INTO post_all (name_post,dath_create,time_create,name_create,status_post,pic_post,info_post,file_post) values ('$post_head','$date_create','$time_create','$accout_post','$post_status','$imgname','$post_info','$docname')"; 
$result = $conn -> query($sql);
if($result){
    if($imgtmpFile != null){
     if (!copy($imgtmpFile,"picture_post/".$imgname)) {
        print "<script>alert('อัพโหลดไฟล์ไม่สำเร็จกรุณาลองใหม่ในภายหลัง')</script>" ;
        print "<script>window.location='view.php';</script>";
    }elseif(!copy($doctmpFile,"file_post/".$docname)) {
        print "<script>alert('อัพโหลดไฟล์ไม่สำเร็จกรุณาลองใหม่ในภายหลัง')</script>" ;
        print "<script>window.location='view.php';</script>";
    }else{
    print "<script>alert('โพสต์เรียบร้อย')</script>" ;
    print "<script>window.location='view.php';</script>";
    }
 
} else{
    print "<script>alert('โพสต์เรียบร้อย')</script>" ;
    print "<script>window.location='view.php';</script>";
 }
}else{
    print "<script>alert('เกิดข้อผิดพลาดกรุณาลองใหม่ในภายหลัง')</script>" ;
    print "<script>window.location='view.php';</script>";
 }
 ?>

?>