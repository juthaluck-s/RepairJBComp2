<?php
include 'header.php';
include 'navbar.php';
include 'sidebar_menu.php';

$act = (isset($_GET['act']) ? $_GET['act'] : '');

//สร้างเงื่อนไขในการเรียกใช้ไฟล์
if ($act == 'add') {
    include 'level_form_add.php';
} else if ($act == 'delete') {
    include 'level_delete.php';
} else if ($act == 'edit') {
    include 'level_form_edit.php';
} else {
    include 'level_list.php';
}

include 'footer.php';