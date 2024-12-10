<?php
include 'header.php';
include 'navbar.php';
include 'sidebar_menu.php';

$act = (isset($_GET['act']) ? $_GET['act'] : '');

//สร้างเงื่อนไขในการเรียกใช้ไฟล์
if ($act == 'add') {
    include 'equipment_form_add.php';
} else if ($act == 'delete') {
    include 'equipment_delete.php';
} else if ($act == 'edit') {
    include 'equipment_form_edit.php';
} else {
    include 'equipment_list.php';
}

include 'footer.php';
