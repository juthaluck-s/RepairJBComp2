<?php

session_start();

//ถ้าไม่มีการล็อกอิน
if (empty($_SESSION['ref_level_id']) && empty($_SESSION['staff_id'])) {
    header('Location: ../logout.php');
}

if (isset($_SESSION['ref_level_id']) && isset($_SESSION['staff_id']) && $_SESSION['ref_level_id'] != '4') {
    header('Location: ../logout.php');
}

require_once '../config/condb.php';

//คิวรี่ข้อมูลคน login
$memberDetail = $condb->prepare("SELECT * FROM tbl_member WHERE m_id=:m_id");
//bindParam
$memberDetail->bindParam(':m_id', $_SESSION['staff_id'], PDO::PARAM_INT);
$memberDetail->execute();
$memberData = $memberDetail->fetch(PDO::FETCH_ASSOC);

// คิวรี่ข้อมูลแผนก
$queryDepartment = $condb->prepare("SELECT * FROM `tbl_department`");
$queryDepartment->execute();
$rsDepartment = $queryDepartment->fetchAll();

// คิวรี่ข้อมูลตำแหน่ง
$queryPosition = $condb->prepare("SELECT * FROM `tbl_position`");
$queryPosition->execute();
$rsPosition = $queryPosition->fetchAll();

$queryLevel = $condb->prepare("SELECT * FROM `tbl_level`");
$queryLevel->execute();
$rsLevel = $queryLevel->fetchAll();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ระบบการแจ้งซ่อมองค์กรเจบีคอมพ์ | Dashboard</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../assets/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../assets/dist/css/adminlte.min.css">
    <!-- summernote -->
    <link rel="stylesheet" href="../assets/plugins/summernote/summernote-bs4.min.css">

    <!-- DataTables -->
    <link rel="stylesheet" href="../assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

    <!-- sweet alert -->
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@100..900&family=Sarabun:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="../assets/dist/css/more.css">




</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Preloader กด F5 จะมีตัว A ขึ้นมา -->
        <!-- <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="../assets/dist/img/Logo JB Comp2.png" alt="JBCompLogo" height="200"
                width="200">
        </div> -->