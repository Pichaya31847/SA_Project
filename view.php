<?php session_start();
$username = $_SESSION["username"];

if (empty($_SESSION["status_user"])) {
    $status_user = 0;
} else {
    $status_user = $_SESSION["status_user"];
}
include "connect_server.php";

if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}
$num_per_page = 20;
$start_from = ($page - 1) * 20;
$search = $_POST['search'];
$query = "SELECT  *  FROM  post_all  WHERE name_post like  '%$search%' and status_post <= '$status_user' ORDER BY id_post DESC limit $start_from,$num_per_page ";
$query_run = mysqli_query($conn, $query);
?>
<html>

<head>
    <title>ระบบประชาสัมพันธ์</title>
    <link rel="icon" type="image/png" href="picture/icon.png">
</head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="CSS/view_home.css">

<body>
    <div class="dropchat_menu">
        <div class="dropdownContent">
            <div class="container_input_text">
                <div class="close-content" onclick="myFunction(this)">
                    <a href="#">
                        <div class="bar1-1"></div>
                        <div class="bar2-1"></div>
                        <div class="bar3-1"></div>
                    </a>
                </div>
                <div class="underline"></div>
                <form enctype="multipart/form-data" method="POST" action="add_post.php" name='frm'>
                    <div class="group" style="position: absolute;margin-left:5rem;margin-top:4.8rem;">
                        <input type="text" name="post_head" required="required" class="popup">
                        <label>หัวข้อโพสต์</label>
                        <span class="bar12"></span>
                    </div>
                    <div class="group" style="position: absolute;margin-left:5rem;margin-top:10rem;">
                        <textarea type="textarea" rows="10" name="post_info" required="required"></textarea>
                        <span class="highlight"></span><span class="bar"></span>
                        <label>เนื้อหาโพสต์</label>
                    </div>

                    <input type="file" name="imageFile" accept="image/*" id="selectedpicture" style="display: none;">


                    <?php if ($status_user == 2) {  ?>
                        <select name="status">
                            <option value="0"><i class="fa fa-globe"></i>สาธารณะ</option>
                            <option value="1">เฉพาะบุคลากรภายใน</option>
                            <option value="2">เฉพาะอาจารย์กับสำนักงาน</option>
                        </select>
                    <?php } else { ?>
                        <select name="status">
                            <option value="0"><i class="fa fa-globe"></i>สาธารณะ</option>
                            <option value="1">เฉพาะบุคลากรภายใน</option>
                        </select>
                    <?php } ?>
                    <button class="bn632-hover bn26" type="submit" style="margin-top: 23.7rem;margin-right: 2rem;float:right;">โพสต์</button>
                </form>
                <button id="picture" onclick="document.getElementById('selectedpicture').click();"><img src="picture/image.png" width="35"></i></button>

            </div>
        </div>
    </div>
    <button onclick="topFunction()" id="myBtn" title="Go to top">Top</button>




    <!-- ######################################################################################################################### -->
    <?php $id_edit = $_GET["edit"];
    if ($id_edit != null) {
        $getid_edit = "SELECT  *  FROM  post_all WHERE id_post like  '$id_edit' ";
        $result_edit = mysqli_query($conn, $getid_edit);
        foreach ($result_edit as $row_edit) { ?>
            <div class="container_show_post">
                <div class="container_input_edit">
                    <div class="close-content_show">
                        <a href="view.php?page=<?php echo $page; ?>">
                            <div class="bar1-1"></div>
                            <div class="bar2-1"></div>
                            <div class="bar3-1"></div>
                        </a>
                    </div>
                    <div class="underline"></div>
                    <div class="content_edit">
                        <form enctype="multipart/form-data" method="POST" action="edit_post.php?main=<?php echo $id_edit; ?>" name='frm'>
                            <div class="group" style="position: absolute;margin-left:5rem;margin-top:4.8rem;;">
                                <input type="text" name="post_head" required="required" class="popup" value="<?php echo $row_edit["name_post"]; ?>">
                                <label>หัวข้อโพสต์</label>
                                <span class="bar12"></span>
                            </div>
                            <div class="group" style="position: absolute;margin-left:5rem;margin-top:10rem;">
                                <textarea type="textarea" rows="10" name="post_info" required="required"><?php echo $row_edit["info_post"]; ?></textarea>
                                <span class="highlight"></span><span class="bar"></span>
                                <label>เนื้อหาโพสต์</label>
                            </div>
                            <input type="file" name="pic_post_file" accept="image/*" id="selectedpic" onchange="document.getElementById('output').src = window.URL.createObjectURL(this.files[0])" style="display: none;">


                            <?php $status_post = $row_edit["status_post"];
                            if ($status_user == 2) {
                                if ($status_post == 0) { ?>
                                    <select name="status">
                                        <option value="0"></i>สาธารณะ</option>
                                        <option value="1">เฉพาะบุคลากรภายใน</option>
                                        <option value="2">เฉพาะอาจารย์กับสำนักงาน</option>
                                    </select>
                                <?php } elseif ($status_post == 1) { ?>
                                    <select name="status">
                                        <option value="1">เฉพาะบุคลากรภายใน</option>
                                        <option value="0">สาธารณะ</option>
                                        <option value="2">เฉพาะอาจารย์กับสำนักงาน</option>
                                    </select>

                                <?php } else { ?>
                                    <select name="status">
                                        <option value="2">เฉพาะอาจารย์กับสำนักงาน</option>
                                        <option value="0"></i>สาธารณะ</option>
                                        <option value="1">เฉพาะบุคลากรภายใน</option>

                                    </select>
                                <?php }
                            } else {
                                if ($status_post == 0) { ?>
                                    <select name="status">
                                        <option value="0"><i class="fa fa-globe"></i>สาธารณะ</option>
                                        <option value="1">เฉพาะบุคลากรภายใน</option>
                                    </select>
                                <?php } else { ?>
                                    <select name="status">
                                        <option value="1">เฉพาะบุคลากรภายใน</option>
                                        <option value="0"><i class="fa fa-globe"></i>สาธารณะ</option>
                                    </select>
                            <?php }
                            } ?>
                            <button class="bn632-hover bn26" type="submit" style="margin-top: 27rem;margin-right: 2rem;float:right;">บันทึก</button>
                            
                        </form>
                        <img id="output" src="picture_post/<?php echo $row_edit["pic_post"]; ?>" width="100" height="100" style="float: left;margin-top:23.5rem;margin-left:5.3rem;">
                        <button id="picture_edit" onclick="document.getElementById('selectedpic').click();"><img src="picture/change-icon.png" width="25"></i></button>
                    </div>

                </div>


            </div>

    <?php }
    } ?>


    <!-- ######################################################################################################################### -->
    <?php
    $id_post = $_GET["id"];
    if ($id_post) {
        $getid_show = "SELECT  *  FROM  post_all WHERE id_post like  '$id_post' ";
        $result_show = mysqli_query($conn, $getid_show);
        foreach ($result_show as $row_show) {


    ?>
            <div class="block_show">

                <div class="close-content_show">
                    <a href="view.php?page=<?php echo $page; ?>">
                        <div class="bar1-1"></div>
                        <div class="bar2-1"></div>
                        <div class="bar3-1"></div>
                    </a>
                </div>
                <div class="underline_show"></div>
                <div class="underline_head"><img src="picture/divider-5556180_960_720.png" width="600"></div>
                <div class="content_show">
                    <div class="heder_show">
                        <?php echo $row_show["name_post"] ?>
                    </div>
                    <?php if ($row_show["pic_post"] != null) { ?>
                        <div class="image_show">
                            <img src="picture_post/<?php echo $row_show["pic_post"]; ?>" width="1000">
                        </div>
                    <?php } ?>
                    <?php $create = $row_show["name_create"];
                    if ($create == $_SESSION['username']) { ?>
                        <a href="view.php?edit=<?php echo $id_post; ?>&page= <?php echo $page; ?>"><button class="bn6323-hover bn26" type="submit" style="margin-top: 34rem;margin-right: 2rem;float:right;">
                                <div class="dropdown_edit_pop">แก้ไข</div>
                            </button></a>
                    <?php } ?>
                    <div class="content_info_show">
                        <textarea rows="20" readonly><?php echo $row_show["info_post"] ?></textarea>
                    </div>

                </div>

            </div>
            <div class="container_show_post">

            </div>

    <?php }
    } ?>
    <!-- ######################################################################################################################### -->
    <div class="banner">
        <img src="picture/banner_sdu.png" style="margin-top: 30px;">
        <div class="search-container">
            <form method="POST" action="view.php">
                <button type="submit"><i class="fa fa-search"></i></button>
                <input type="text" placeholder="Search..." name="search" id="wtf" class="IDK">
            </form>
        </div>
    </div>


    <ul>
        <li class="active"><a href="view.php"><i class="fa fa-fw fa-home"></i> Home</a></li>

        <?php if (empty($_SESSION["username"])) { ?>
            <li class="right"><a href="login.php"><i class="fa fa-sign-in"></i> กรุณาล็อกอิน</a></li>


        <?php } else { ?>
            <li class="icon-menu">

                <div class="menu-icon" onclick="myFunction(this)">
                    <div class="bar1"></div>
                    <div class="bar2"></div>
                    <div class="bar3"></div>
                </div>
            </li>
        <?php } ?>
    </ul>
    <div class="dropdown-menu">
        <div class="menu-content">
            <a class="links" href="#"><i class="fa fa-user-circle-o"></i> Profile</a>
            <div class="dropdownchat"><a class="links" href="#"><i class="fa fa-plus-square-o"></i> เขียนโพสต์</a></div>
            <a class="links" href="logout.php"><i class="fa fa-sign-out"></i> Logout</a>
        </div>
    </div>



    <div class="content_box">
        <table id="table_commu">
            <tr>
                <th>
                    ชื่อโพสต์
                </th>
                <th style="width: 180px;">
                    โดย
                </th>
                <th style="width: 200px;">
                    วันที่โพสต์
                </th>
            </tr>
            <?php
            if ($query_run) {
                foreach ($query_run as $row) {
            ?>
                    <tr>
                        <td id="name_post">
                            <div class="dropdown_show" onclick="myFunction(this)"><a href="view.php?id=<?php echo $row['id_post']; ?>&page=<?php echo $page; ?>" class="title_post"><?php echo $row['name_post']; ?></a></div>
                        </td>
                        <td><?php echo $row['name_create']; ?></td>
                        <td>วันที่โพสต์ <a class="timee"><?php echo $row['dath_create']; ?></a><br>เวลา <a class="timee"><?php echo $row['time_create']; ?></a></td>
                    </tr>
            <?php
                }
            } else {
                echo "<tr><td colspan='3' style='text-align: center;'>ไม่พบข้อมูล</td></tr>";
            }
            ?>
            <?php
            $getid_query = "SELECT  *  FROM  post_all WHERE name_post like  '%$search%' and status_post <= '$status_user' ";
            $result = mysqli_query($conn, $getid_query);
            $total_row = mysqli_num_rows($result);

            $total_pages = ceil($total_row / $num_per_page);
            $n = $page + 4;
            if ($total_row == 0) {
            ?>

                <tr>
                    <td colspan='3' style='text-align: center;'>ไม่พบข้อมูล</td>
                </tr>
            <?php } ?>

            <tr style="background-color: rgba(0,0,0,0.89);">
                <td colspan="3" style="text-align: center;height:67px;">
                    <?php
                    $getid_query = "SELECT  *  FROM  post_all WHERE name_post like  '%$search%' and status_post <= '$status_user' ";
                    $result = mysqli_query($conn, $getid_query);
                    $total_row = mysqli_num_rows($result);

                    $total_pages = ceil($total_row / $num_per_page);
                    $n = $page + 4;
                    ?>
                    <div class="pagination">
                        <?php

                        if ($page > 2) {
                            print "<a href='view.php?page=1'>&laquo;</a> ";
                        }

                        if ($page > 1) {
                            print "<a href='view.php?page=" . ($page - 1) . "'>&lt;</a> ";
                        }

                        if ($page > 2) {
                            $pree_page = $page - 2;
                            print "<a href='view.php?page=" . ($page - 2) . "'>$pree_page</a> ";
                        }

                        if ($page != 1) {
                            $pre_page = $page - 1;
                            print "<a href='view.php?page=" . ($page - 1) . "'>$pre_page</a> ";
                        }

                        print "<a href='view.php?page=" . $page . "' class='active'>$page</a> ";

                        if ($page < $total_pages) {
                            $post_page = $page + 1;
                            print "<a href='view.php?page=" . ($page + 1) . "'>$post_page</a> ";
                        }

                        if ($page < $total_pages - 1) {
                            $postt_page = $page + 2;
                            print "<a href='view.php?page=" . ($page + 2) . "'>$postt_page</a> ";
                        }


                        if ($page < ($total_pages - 1)) {
                            print "<a href='view.php?page=" . ($page + 1) . "'>&gt;</a> ";
                        }

                        if ($page < $total_pages) {
                            print "<a href='view.php?page=" . ($total_pages) . "'>&raquo;</a> ";
                        }

                        ?></div>
                </td>
            </tr>
        </table>
    </div>

</body>
<script>
    function myFunction(x) {
        x.classList.toggle("change");
    }

    let dropdownBtn = document.querySelector('.icon-menu');
    let menuContent = document.querySelector('.menu-content');
    dropdownBtn.addEventListener('click', () => {
        if (menuContent.style.display === "") {
            menuContent.style.display = "block";
        } else {
            menuContent.style.display = "";
        }
    })

    let dropdownchat = document.querySelector('.dropdownchat');
    let dropdownContent = document.querySelector('.dropdownContent');
    dropdownchat.addEventListener('click', () => {
        if (dropdownContent.style.display === "") {
            dropdownContent.style.display = "block";
        } else {
            dropdownContent.style.display = "";
        }
    })


    let close_content = document.querySelector('.close-content');
    close_content.addEventListener('click', () => {
        if (dropdownContent.style.display === "") {
            dropdownContent.style.display = "block";
        } else {
            dropdownContent.style.display = "";
        }
    })

    var mybutton = document.getElementById("myBtn");

    window.onscroll = function() {
        scrollFunction()
    };

    function scrollFunction() {
        if (document.body.scrollTop > 400 || document.documentElement.scrollTop > 400) {
            mybutton.style.display = "block";
        } else {
            mybutton.style.display = "none";
        }
    }

    function topFunction() {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
    }

    function required(x) {
        if (x.post_name.value.length == 0) {
            alert("หัวข้อไม่สามารถเว้นว่างได้");
            return false;
        }

        if (x.post_info.value.length == 0) {
            alert("กรุณาพิมพ์สักนิดนึง");
            return false;
        }

        return true;
    }

    const textarea = document.querySelector("textarea");
    textarea.addEventListener("keyup", e => {
        let scHeight = e.target.scrollHeight;
        textarea.style.height = "auto";
        textarea.style.height = '${scHeight}';
    });
</script>
</html>