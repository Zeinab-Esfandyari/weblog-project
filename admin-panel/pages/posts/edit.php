<?php
include "../../include/layout/header.php";

if(isset($_GET['id'])) {
    $postId = $_GET['id'];
    $post = $db->prepare('SELECT * FROM posts WHERE id = :id');
    $post ->execute(['id' => $postId]);
    $post = $post->fetch();

    $categories = $db->query('SELECT * FROM categories');
}


$invalidInputTitle = '';
$invalidInputAuthor = '';
$invalidInputBody = '';
if (isset($_POST['editPost'])) {

    if(empty(trim($_POST['title']))) {
        $invalidInputTitle = 'فیلد عنوان مقاله الزامیست...';
    }
    if(empty(trim($_POST['author']))) {
        $invalidInputAuthor = 'فیلد نویسنده مقاله الزامیست...';
    }

    if(empty(trim($_POST['body']))) {
        $invalidInputBody = 'فیلد متن مقاله الزامیست...';
    }



    if(!empty(trim($_POST['title'])) && !empty(trim($_POST['author'])) && !empty(trim($_POST['body']))) {
        $title = $_POST['title'];
        $author = $_POST['author'];
        $body = $_POST['body'];
        $categoryId = $_POST['categoryId'];


        if (!empty(trim($_FILES['image']['name']))) {
            $nameImage = time() . '_' . $_FILES['image']['name'];
            $tmpName = $_FILES['image']['tmp_name'];
            if(move_uploaded_file($tmpName, "../../../uploads/posts/$nameImage")) {

                $postUpdate = $db->prepare("UPDATE posts SET title=:title , author=:author , body=:body , category_id=:categoryId , image=:image WHERE id=:id");
                $postUpdate -> execute(['title' => $title , 'author' => $author , 'body' => $body , 'categoryId' => $categoryId , 'id' => $postId , 'image' => $nameImage]);
            } else {
                echo "Upload Error";
            }

        } else {

            $postUpdate = $db->prepare("UPDATE posts SET title=:title , author=:author , body=:body , category_id=:categoryId WHERE id=:id");
            $postUpdate-> execute(['title' => $title , 'author' => $author , 'body' => $body , 'categoryId' => $categoryId , 'id' => $postId]);
        }
        header("location:index.php");
        exit();
    }
}





?>

<div class="container-fluid admin-dashboard">

    <div class="row admin-dashboard-layout">

        <!-- Sidebar Section -->
        <?php
            include "../../include/layout/sidbar.php";
?>

        <!-- Main Section -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mb-5 admin-dashboard-main">

            <div
                class="admin-page-header d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">

                <div>
                    <span class="admin-page-eyebrow">مدیریت محتوا</span>
                    <h1 class="admin-page-title">ویرایش مقاله</h1>
                    <p class="admin-page-description">
                        اطلاعات مقاله موردنظر را ویرایش کنید
                    </p>
                </div>

            </div>

            <!-- Edit Posts -->
            <section class="admin-dashboard-section mt-4">

                <div class="admin-section-header">

                    <div>
                        <span class="admin-section-eyebrow">به‌روزرسانی محتوا</span>
                        <h4 class="admin-section-title">اطلاعات مقاله</h4>
                    </div>

                    <i class="bi bi-pencil-square admin-section-icon"></i>

                </div>

                <div class="admin-form-card">

                    <form method="post" class="row g-4 admin-form" enctype="multipart/form-data">

                        <div class="col-12 col-sm-6 col-md-4 admin-form-group">

                            <label class="form-label admin-form-label">
                                عنوان مقاله
                            </label>

                            <input type="text" name="title" class="form-control admin-form-control"
                                value="<?= $post['title'] ?>" />

                            <div class="form-text text-danger admin-form-error">
                                <?= $invalidInputTitle ?>
                            </div>

                        </div>

                        <div class="col-12 col-sm-6 col-md-4 admin-form-group">

                            <label class="form-label admin-form-label">
                                نویسنده مقاله
                            </label>

                            <input type="text" name="author" class="form-control admin-form-control"
                                value="<?= $post['author'] ?>" />

                            <div class="form-text text-danger admin-form-error">
                                <?= $invalidInputAuthor ?>
                            </div>

                        </div>

                        <div class="col-12 col-sm-6 col-md-4 admin-form-group">

                            <label class="form-label admin-form-label">
                                دسته بندی مقاله
                            </label>

                            <select name="categoryId" class="form-select admin-form-control">

                                <?php if ($categories->rowCount() > 0): ?>

                                <?php foreach($categories as $category): ?>

                                <option <?= ($category['id'] == $post['category_id']) ? 'selected' : '' ?>
                                    value="<?= $category['id'] ?>">

                                    <?= $category['title'] ?>

                                </option>

                                <?php endforeach ?>

                                <?php endif ?>

                            </select>

                        </div>

                        <div class="col-12 col-sm-6 col-md-4 admin-form-group">

                            <label for="formFile" class="form-label admin-form-label">
                                تصویر مقاله
                            </label>

                            <input name="image" class="form-control admin-form-control admin-file-input" type="file" />

                        </div>

                        <div class="col-12 admin-form-group">

                            <label for="formFile" class="form-label admin-form-label">
                                متن مقاله
                            </label>

                            <textarea class="form-control admin-form-control admin-textarea" name="body"
                                rows="8"><?= $post['body'] ?></textarea>

                            <div class="form-text text-danger admin-form-error">
                                <?= $invalidInputBody ?>
                            </div>

                        </div>

                        <div class="col-12 admin-current-image-section">

                            <label class="form-label admin-form-label">
                                تصویر فعلی مقاله
                            </label>

                            <div class="admin-current-image-wrapper">

                                <img class="rounded admin-current-image"
                                    src="../../../uploads/posts/<?=  $post['image']  ?>"
                                    width="300" />

                            </div>

                        </div>

                        <div class="col-12 admin-form-actions">

                            <button name="editPost" type="submit" class="btn btn-dark admin-primary-btn">
                                <i class="bi bi-check-lg"></i>
                                ذخیره تغییرات
                            </button>

                        </div>

                    </form>

                </div>

            </section>

        </main>

    </div>

</div>

<?php
    include "../../include/layout/footer.php";
?>