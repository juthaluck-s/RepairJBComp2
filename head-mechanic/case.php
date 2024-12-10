<?php
include 'header.php';
include 'navbar.php';
include 'sidebar_menu.php';
$act = (isset($_GET['act']) ? $_GET['act'] : '');

//สร้างเงื่อนไขในการเรียกใช้ไฟล์
if ($act == 'add') {
    include 'case_form_add.php';
} else if ($act == 'doing') {
    include 'case_list_doing.php';
} else if ($act == 'ass') {
    include 'case_form_assessment.php';
} else if ($act == 'assign') {
    include 'case_form_assign.php';
} else {
    include 'case_list.php';
}

include 'footer.php';
