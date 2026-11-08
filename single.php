<?php
include "./include/layout/header.php";

if (isset($_GET['post'])) {
    $postId = $_GET['post'];
    $post = $db->prepare('SELECT * FROM posts WHERE id = :id');
    $post->execute(['id' => $postId]);
    $post = $post->fetch();
}

?>

<main class="single-post-page">

    <!-- Content -->
    <section class="single-content-section mt-4">

        <div class="row g-4">

            <!-- Posts & Comments Content -->
            <?php if(empty($post)): ?>

            <div class="col-lg-8">
                <div class="alert alert-danger single-empty-message">
                    <i class="bi bi-exclamation-circle me-2"></i>
                    مقاله ای یافت نشد...
                </div>
            </div>

            <?php else: ?>

            <div class="col-lg-8">

                <div class="row justify-content-center">

                    <?php
                            $categoryId = $post['category_id'];
                $postCategory = $db-> query("SELECT * FROM categories WHERE id = $categoryId") ->fetch();
                ?>

                    <!-- Post Section -->
                    <div class="col-12">

                        <article class="card article-card single-article-card">

                            <div class="single-article-image-wrapper">
                                <img src="./uploads/posts/<?= $post['image'] ?>"
                                    class="card-img-top single-article-image"
                                    alt="<?= $post['title']; ?>" />
                            </div>

                            <div class="card-body single-article-body">

                                <div class="single-article-meta">
                                    <span class="single-article-category">
                                        <i class="bi bi-grid"></i>
                                        <?= $postCategory['title'] ?>
                                    </span>
                                </div>

                                <h1 class="card-title fw-bold single-article-title">
                                    <?= $post['title']; ?>
                                </h1>

                                <div class="single-article-divider"></div>

                                <div class="card-text single-article-text">
                                    <?= ($post['body'])?>
                                </div>

                                <div class="single-article-author">
                                    <i class="bi bi-person-circle"></i>
                                    <span>نویسنده:</span>
                                    <strong><?= $post['author'] ?></strong>
                                </div>

                            </div>

                        </article>

                    </div>

                    <hr class="mt-4 single-section-divider" />

                    <!-- Comment Section -->
                    <div class="col-12">

                        <?php
                        $invalidInputName = '';
                $invalidInputComment = '';
                $message = '';

                if(isset($_POST['postComment'])) {
                }

                if(empty(trim($_POST['name']))) {
                    $invalidInputName = 'فیلد نام الزامیست';
                } elseif(empty(trim($_POST['comment']))) {
                    $invalidInputComment = 'فیلد متن کامنت الزامیست';
                } else {
                    $name = $_POST['name'];
                    $comment = $_POST['comment'];

                    $commentInsert = $db -> prepare("INSERT INTO comments (name , comment ,post_id) VALUES (:name , :comment , :post_id)");
                    $commentInsert -> execute(['name' => $name , 'comment' => $comment , 'post_id' => $postId]);

                    $message = "کامنت شما با موفقیت ثبت شد و بعد از تایید نمایش داده میشود ";
                }
                ?>

                        <!-- Comment Form -->
                        <div class="card comment-form-card">

                            <div class="card-body">

                                <div class="sidebar-section-title comment-section-title">
                                    <i class="bi bi-chat-square-text"></i>
                                    <p class="fw-bold fs-5 mb-0">
                                        ارسال دیدگاه
                                    </p>
                                </div>

                                <p class="comment-form-description">
                                    نظر خود را درباره این مقاله با ما به اشتراک بگذارید.
                                </p>

                                <form method="POST">

                                    <div class="text-success comment-success-message">
                                        <?= $message ?>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">نام</label>

                                        <input type="text" name="name" class="form-control"
                                            placeholder="نام خود را وارد کنید" />

                                        <div class="form-text text-danger">
                                            <?= $invalidInputName ?>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">متن دیدگاه</label>

                                        <textarea class="form-control" name="comment" rows="4"
                                            placeholder="دیدگاه خود را بنویسید..."></textarea>

                                        <div class="form-text text-danger">
                                            <?= $invalidInputComment ?>
                                        </div>
                                    </div>

                                    <button type="submit" name="postComment" class="btn btn-dark comment-submit-btn">

                                        <i class="bi bi-send me-1"></i>
                                        ارسال دیدگاه

                                    </button>

                                </form>

                            </div>

                        </div>

                        <hr class="mt-4 single-section-divider" />

                        <!-- Comment Content -->
                        <?php
                    $postId = $post['id'];
                $comments = $db ->prepare("SELECT * FROM comments WHERE post_id = :id AND status = '1'");
                $comments->execute(['id' => $postId ]);
                ?>

                        <div class="comments-list-section">

                            <div class="comments-list-heading">
                                <i class="bi bi-chat-dots"></i>

                                <p class="fw-bold fs-6 mb-0">
                                    دیدگاه‌ها
                                    <span class="comments-count">
                                        <?= $comments->rowCount() ?>
                                    </span>
                                </p>
                            </div>

                            <?php if($comments->rowCount() > 0): ?>

                            <?php foreach($comments as $comment): ?>

                            <div class="card comment-card mb-3">

                                <div class="card-body">

                                    <div class="d-flex align-items-center comment-user-info">

                                        <img src="./assets/images/profile.png" width="45" height="45" alt="user-profile"
                                            class="comment-user-avatar" />

                                        <h5 class="card-title me-2 mb-0 comment-user-name">
                                            <?= $comment['name'] ?>
                                        </h5>

                                    </div>

                                    <p class="card-text comment-text pt-3 pr-3">
                                        <?= $comment['comment'] ?>
                                    </p>

                                </div>

                            </div>

                            <?php endforeach ?>

                            <?php else: ?>

                            <div class="alert alert-danger comments-empty-message" role="alert">
                                <i class="bi bi-chat-square me-2"></i>
                                نظری برای این مقاله ثبت نشده است...
                            </div>

                            <?php endif ?>

                        </div>

                    </div>

                </div>

            </div>

            <?php endif ?>

            <!-- Sidebar -->
            <?php
                include "./include/layout/sidbar.php";
?>

        </div>

    </section>

</main>

<!-- Footer -->
<?php
include "./include/layout/footer.php";
?>