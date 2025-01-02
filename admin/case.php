<?php
include 'header.php';
include 'navbar.php';
include 'sidebar_menu.php';
$act = (isset($_GET['act']) ? $_GET['act'] : '');
if ($act == 'view') {
    include 'case_form_view.php';
} else {
    include 'case_list_all.php';
}
include 'footer.php';
