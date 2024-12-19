<?php

include 'header.php';
include 'navbar.php';
include 'sidebar_menu.php';
$act = (isset($_GET['act']) ? $_GET['act'] : '');

//สร้างเงื่อนไขในการเรียกใช้ไฟล์
if ($act == 'report') {
    include 'report_list.php';
} else {
    include 'case.php';
}
include 'footer.php';