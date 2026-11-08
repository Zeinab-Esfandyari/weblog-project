
<?php

// include "./include/config.php";
include "./include/db.php";

$query = "SELECT * FROM categories LIMIT 4";
$categories = $db->query($query);

?>

<!DOCTYPE html>
<html dir="rtl" lang="fa">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title> وبلاگ تخصصی</title>

    <link rel="stylesheet" href="./assets/css/bootstrap-icons.css" />
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="./assets/css/style.css" />
</head>

<body class="blog-body">

<div class="container py-4">

    <header class="site-header">

        <!-- Brand -->
        <div class="site-brand-wrap">

            <a href="index.php" class="site-brand text-decoration-none">

                <span class="brand-icon">
                    <i class="bi bi-code-slash"></i>
                </span>

                <span class="brand-text">
                    <span class="brand-title">Zeinab</span>

                    <span class="brand-subtitle">
                        دنیای تکنولوژی و مطالب جذاب
                    </span>
                </span>

            </a>

        </div>

        <!-- Categories -->
        <nav class="site-nav" aria-label="منوی دسته‌بندی مطالب">

            <?php if ($categories -> rowCount() > 0) : ?>

                <?php foreach ($categories as $category) : ?>

                    <a
                        class="site-nav-link <?= (isset($_GET['category'])) && $category['id'] == trim($_GET['category']) ? 'active' : '' ?>"
                        href="index.php?category=<?= $category['id'] ?>"
                    >
                        <?= $category['title'] ?>
                    </a>

                <?php endforeach ?>

            <?php endif ?>

        </nav>

        <!-- Search -->
        <form
            class="site-header-search"
            action="search.php"
            method="GET"
            role="search"
        >

            <div class="search-input-wrapper">

                <i class="bi bi-search search-icon"></i>

                <input
                    type="text"
                    name="search"
                    class="form-control"
                    placeholder="دنبال چه مطلبی می‌گردید؟"
                    aria-label="جستجو در وبلاگ"
                />

                <button
                    class="btn btn-search"
                    type="submit"
                    aria-label="جستجو"
                >
                    جستجو
                    <i class="bi bi-arrow-left"></i>
                </button>

            </div>

        </form>

    </header>
</div>
