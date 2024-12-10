<?php
include 'header.php';
include 'navbar.php';
include 'sidebar_menu.php';

$act = (isset($_GET['act']) ? $_GET['act'] : '');

//สร้างเงื่อนไขในการเรียกใช้ไฟล์
if ($act == 'add') {
    include 'department_form_add.php';
} else if ($act == 'delete') {
    include 'department_delete.php';
} else if ($act == 'edit') {
    include 'department_form_edit.php';
} else {
    include 'department_list.php';
}

include 'footer.php';
