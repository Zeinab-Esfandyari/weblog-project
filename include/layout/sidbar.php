<?php

$query = "SELECT * FROM categories";
$categories = $db->query($query);

?>

<!-- Sidebar Section -->
<aside class="col-lg-4 blog-sidebar">

    <!-- Search Section -->
    <div class="card sidebar-card search-card">
        <div class="card-body">
            <div class="sidebar-section-title">
                <i class="bi bi-search"></i>
                <p class="fw-bold fs-6 mb-0">جستجو در وبلاگ</p>
            </div>

            <form action="search.php" method="GET">
                <div class="input-group sidebar-search-group">
                    <input type="text" name="search" class="form-control" placeholder="موضوع مورد نظر را جستجو کنید..."
                        aria-label="جستجو در وبلاگ" />

                    <button class="btn btn-secondary sidebar-search-btn" type="submit" aria-label="جستجو">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Categories Section -->
    <div class="card mt-4 sidebar-card categories-card">

        <div class="card-header sidebar-card-header">
            <i class="bi bi-grid"></i>
            <span class="fw-bold fs-6">دسته‌بندی مطالب</span>
        </div>

        <ul class="list-group list-group-flush p-0 sidebar-category-list">
            <?php if ($categories -> rowCount() > 0) : ?>
            <?php foreach ($categories as $category) : ?>

            <li class="list-group-item sidebar-category-item">
                <a class="link-body-emphasis text-decoration-none sidebar-category-link"
                    href="index.php?category=<?= $category['id'] ?>">

                    <span><?= $category['title'] ?></span>
                    <i class="bi bi-chevron-left"></i>

                </a>
            </li>

            <?php endforeach ?>
            <?php endif ?>
        </ul>

    </div>

    <?php
        $invalidInputName = '';
$invalidInputEmail = '';
$message = '';

if(isset($_POST['subscribe'])) {
    if(empty(trim($_POST['name']))) {
        $invalidInputName = 'فیلد نام الزامیست';
    } elseif(empty(trim($_POST['email']))) {
        $invalidInputEmail = 'فیلد ایمیل الزامیست';
    } else {
        $name = $_POST['name'];
        $email = $_POST['email'];

        $subscribInsert = $db ->prepare("INSERT INTO subscribers (name,email) VALUES (:name ,:email)");
        $subscribInsert ->execute(['name' => $name , 'email' => $email ]);

        $message = "عضویت شما با موفقیت انجام شد";
    }
}
?>

    <!-- Newsletter Section -->
    <div class="card mt-4 sidebar-card newsletter-card">
        <div class="card-body">

            <div class="sidebar-section-title">
                <i class="bi bi-envelope-paper"></i>
                <p class="fw-bold fs-6 mb-0">عضویت در خبرنامه</p>
            </div>

            <p class="sidebar-description">
                برای دریافت تازه‌ترین مطالب وبلاگ در خبرنامه عضو شوید.
            </p>

            <div class="text-success sidebar-success-message">
                <?= $message ?>
            </div>

            <form method="POST">

                <div class="mb-3">
                    <label class="form-label">نام</label>

                    <input type="text" name="name" class="form-control" placeholder="نام خود را وارد کنید" />

                    <div class="form-text text-danger">
                        <?= $invalidInputName ?>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">ایمیل</label>

                    <input type="email" name="email" class="form-control" placeholder="example@email.com" />

                    <div class="form-text text-danger">
                        <?= $invalidInputEmail ?>
                    </div>
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" name="subscribe" class="btn btn-secondary sidebar-subscribe-btn">

                        <i class="bi bi-send me-1"></i>
                        عضویت در خبرنامه

                    </button>
                </div>

            </form>
        </div>
    </div>

    <!-- About Section -->
    <div class="card mt-4 sidebar-card about-card">
        <div class="card-body">

            <div class="sidebar-section-title">
                <i class="bi bi-info-circle"></i>
                <p class="fw-bold fs-6 mb-0">درباره ما</p>
            </div>

            <p class="text-justify sidebar-about-text">
                لورم ایپسوم متن ساختگی با تولید سادگی
                نامفهوم از صنعت چاپ و با استفاده از
                طراحان گرافیک است. چاپگرها و متون بلکه
                روزنامه و مجله در ستون و سطرآنچنان که
                لازم است و برای شرایط فعلی تکنولوژی مورد
                نیاز و کاربردهای متنوع با هدف بهبود
                ابزارهای کاربردی می باشد.
            </p>

        </div>
    </div>

</aside>