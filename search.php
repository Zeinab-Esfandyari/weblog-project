<?php
include "./include/layout/header.php";
// include "./include/config.php";
// include "./include/db.php";

if (isset($_GET['search'])) {
    $keyword = $_GET['search'];
    $posts = $db->prepare('SELECT * FROM posts WHERE title LIKE :keyword');
    $posts ->execute(['keyword' => "%$keyword%"]);
}

?>

<main class="search-page">

    <!-- Content Section -->
    <section class="search-content-section mt-4">

        <div class="row g-4">

            <!-- Posts Content -->
            <div class="col-lg-8 search-results-content">

                <div class="row">
                    <div class="col">

                        <!-- Search Heading -->
                        <div class="search-results-heading">
                            <div class="search-heading-icon">
                                <i class="bi bi-search"></i>
                            </div>

                            <div class="search-heading-content">
                                <span class="section-eyebrow">نتایج جستجو</span>

                                <h2 class="search-page-title">
                                    مطالب مرتبط با جستجوی شما
                                </h2>

                                <p class="search-keyword">
                                    عبارت جستجو:
                                    <strong>[ <?= $keyword ?>
                                        ]</strong>
                                </p>
                            </div>
                        </div>

                        <?php if($posts->rowCount() == 0): ?>

                        <div class="alert alert-danger search-empty-message">
                            <i class="bi bi-exclamation-circle me-2"></i>
                            مقاله مورد نظر پیدا نشد !!!!
                        </div>

                        <?php else: ?>

                        <div class="row g-4">

                            <?php foreach($posts as $post) : ?>

                            <?php
                                        $categoryId = $post['category_id'];
                                $postCategory = $db-> query("SELECT * FROM categories WHERE id = $categoryId") ->fetch();
                                ?>

                            <div class="col-sm-6">

                                <article class="card post-card blog-post-card search-post-card h-100">

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
                                                <?= $post['author']; ?>
                                            </p>

                                        </div>

                                    </div>

                                </article>

                            </div>

                            <?php endforeach ?>

                        </div>

                        <?php endif ?>

                    </div>
                </div>

            </div>

            <!-- Sidebar Section -->
            <?php include "include/layout/sidbar.php"; ?>

        </div>

    </section>

</main>

<?php
include "./include/layout/footer.php";
?>