<?php

include 'header.php';
include 'navbar.php';
include 'sidebar_menu.php';
$act = (isset($_GET['act']) ? $_GET['act'] : '');

//สร้างเงื่อนไขในการเรียกใช้ไฟล์
if ($act == 'report') {
    include 'report_list.php';
} else if ($act == 'asmclose') {
    include 'report_form_assessment_close.php';
} else if ($act == 'asm1') {
    include 'report_form_assessment_1.php';
} else if ($act == 'asm2') {
    include 'report_form_assessment_2.php';
} else if ($act == 'asm3') {
    include 'report_form_assessment_3.php';
} else if ($act == 'asm4') {
    include 'report_form_assessment_4.php';
} else if ($act == 'asm5') {
    include 'report_form_assessment_5.php';
} else {
    include 'case.php';
}
include 'footer.php';