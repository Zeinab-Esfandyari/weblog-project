
<?php
session_start();
include(__DIR__ . "/../config.php");
include(__DIR__ . "/../db.php");


$path = $_SERVER['REQUEST_URI'];

if(!isset($_SESSION['email'])) {
    if(str_contains($path, 'pages')) {
        header("location:../auth/login.php?err_msg=ابتدا باید وارد سیستم شوید");
    } else {
        header("location:./pages/auth/login.php?err_msg=ابتدا باید وارد سیستم شوید");
    }

    exit();
}
?>

<!DOCTYPE html>
<html dir="rtl" lang="fa">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>php tutorial || blog project || webprog.io</title>

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="./assets/css/bootstrap-icons.css" />

    <!-- Bootstrap -->
    <link href="./assets/css/bootstrap.min.css" rel="stylesheet" />

    <?php if (str_contains($path, 'pages')) : ?>

    <link rel="stylesheet" href="../../assets/css/bootstrap-icons.css" />
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../../assets/css/style.css" />

    <?php else: ?>

    <link rel="stylesheet" href="./assets/css/bootstrap-icons.css" />
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="./assets/css/style.css" />

    <?php endif ?>

</head>

<body class="admin-body">

    <!-- Admin Header -->
    <header class="navbar sticky-top flex-md-nowrap p-0 shadow-sm admin-header">

        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-5 admin-header-brand"
            href="/weblog-project/admin-panel/index.php">

            <span class="admin-header-brand-icon">
                <i class="bi bi-grid-1x2-fill"></i>
            </span>

            <span class="admin-header-brand-text">
                پنل مدیریت
            </span>

        </a>

        <div class="admin-header-actions">

            <button class="ms-2 nav-link px-3 text-white d-md-none admin-menu-toggle"
                type="button"
                data-bs-toggle="offcanvas"
                data-bs-target="#sidebarMenu">

                <i class="bi bi-justify-left"></i>

            </button>

        </div>

    </header>
