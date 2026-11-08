<?php
include "./include/layout/header.php";
// include "./include/config.php";
include "./include/db.php";

if(isset($_GET['category'])) {
    $categoryId = $_GET['category'];
    $posts = $db->prepare("SELECT * FROM posts WHERE category_id = :id   ORDER BY id DESC");
    $posts->execute(['id' => $categoryId]);

} else {
    $posts = $db->query("SELECT * FROM posts ORDER BY id DESC");
}

// print_r($post->fetchAll());

?>

<main class="blog-main">

    <?php include "./include/layout/slider.php"; ?>

    <!-- Content Section -->
    <section class="blog-content-section mt-4">
        <div class="row g-4">

            <!-- Posts Content -->
            <div class="col-lg-8 blog-posts-content">

                <div class="blog-section-heading">
                    <div>
                        <span class="section-eyebrow">مطالب وبلاگ</span>
                        <h2 class="blog-section-title">آخرین مقالات</h2>
                        <p class="blog-section-description">
                            جدیدترین مطالب و آموزش‌های منتشرشده در وبلاگ
                        </p>
                    </div>
                </div>

                <div class="row g-4">

                    <?php if ($posts->rowCount() > 0) : ?>

                    <?php foreach($posts as $post) : ?>

                    <?php
                                $categoryId = $post['category_id'];
                        $postCategory = $db-> query("SELECT * FROM categories WHERE id = $categoryId") ->fetch();
                        ?>

                    <div class="col-sm-6">

                        <article class="card post-card blog-post-card h-100">

                            <div class="post-image-wrapper">
                                <img src="./uploads/posts/<?= $post['image'] ?>"
                                    class="card-img-top post-card-image"
                                    alt="<?= $post['title']; ?>" />

                                <span class="post-category-badge">
                                    <?= $postCategory['title'] ?>
                                </span>
                            </div>

                            <div class="card-body post-card-body">

                                <h5 class="card-title fw-bold post-card-title">
                                    <?= $post['title']; ?>
                                </h5>

                                <p class="card-text post-card-excerpt">
                                    <?= substr($post['body'], 0, 500) . "..." ?>
                                </p>

                                <div class="post-card-footer">

                                    <a href="single.php?post=<?= $post['id'] ?>"
                                        class="btn btn-sm btn-dark post-read-more">

                                        مشاهده مطلب
                                        <i class="bi bi-arrow-left"></i>

                                    </a>

                                    <p class="post-author mb-0">
                                        <i class="bi bi-person"></i>
                                        نویسنده:
                                        <?= $post['author'] ?>
                                    </p>

                                </div>

                            </div>

                        </article>

                    </div>

                    <?php endforeach ?>

                    <?php else : ?>

                    <div class="col-12">
                        <div class="alert alert-danger blog-empty-message">
                            <i class="bi bi-info-circle me-2"></i>
                            مقاله‌ای یافت نشد...
                        </div>
                    </div>

                    <?php endif ?>

                </div>
            </div>

            <!-- Sidebar -->
            <?php
                include "./include/layout/sidbar.php";
?>

        </div>
    </section>

</main>

<?php
include "./include/layout/footer.php";
?>