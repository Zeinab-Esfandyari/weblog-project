<?php
include "../../include/layout/header.php";


$categories = $db->query('SELECT * FROM categories');
$invalidInputTitle = '';
$invalidInputAuthor = '';
$invalidInputImage = '';
$invalidInputBody = '';
if (isset($_POST['addPost'])) {

    if(empty(trim($_POST['title']))) {
        $invalidInputTitle = 'فیلد عنوان مقاله الزامیست...';
    }
    if(empty(trim($_POST['author']))) {
        $invalidInputAuthor = 'فیلد نویسنده مقاله الزامیست...';
    }
    if(empty(trim($_FILES['image']['name']))) {
        $invalidInputImage = 'فیلد عکس مقاله الزامیست...';
    }
    if(empty(trim($_POST['body']))) {
        $invalidInputBody = 'فیلد متن مقاله الزامیست...';
    }

    if(!empty(trim($_POST['title'])) && !empty(trim($_POST['author'])) && !empty(trim($_FILES['image']['name'])) && !empty(trim($_POST['body']))) {
        $title = $_POST['title'];
        $author = $_POST['author'];
        $body = $_POST['body'];
        $categoryId = $_POST['categoryId'];


        $nameImage = time() . '_' . $_FILES['image']['name'];
        $tmpName = $_FILES['image']['tmp_name'];
        if(move_uploaded_file($tmpName, "../../../uploads/posts/$nameImage")) {
            $postInsert = $db->prepare(" INSERT INTO posts (title , author ,category_id , body , image) VALUES (:title , :author ,:category_id , :body , :image)");
            $postInsert -> execute(['title' => $title , 'author' => $author , 'category_id' => $categoryId , 'body' => $body , 'image' => $nameImage]);
        } else {
            echo "Upload Error";
        }

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
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 admin-dashboard-main">

            <div
                class="admin-page-header d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">

                <div>
                    <span class="admin-page-eyebrow">مدیریت محتوا</span>
                    <h1 class="admin-page-title">ایجاد مقاله</h1>
                    <p class="admin-page-description">
                        اطلاعات مقاله جدید را وارد کنید
                    </p>
                </div>

            </div>

            <!-- Create Posts -->
            <section class="admin-dashboard-section mt-4">

                <div class="admin-section-header">

                    <div>
                        <span class="admin-section-eyebrow">محتوای جدید</span>
                        <h4 class="admin-section-title">اطلاعات مقاله</h4>
                    </div>

                    <i class="bi bi-file-earmark-plus admin-section-icon"></i>

                </div>

                <div class="admin-form-card">

                    <form method="post" class="row g-4 admin-form" enctype="multipart/form-data">

                        <div class="col-12 col-sm-6 col-md-4 admin-form-group">

                            <label class="form-label admin-form-label">
                                عنوان مقاله
                            </label>

                            <input type="text" name="title" class="form-control admin-form-control" />

                            <div class="form-text text-danger admin-form-error">
                                <?= $invalidInputTitle ?>
                            </div>

                        </div>

                        <div class="col-12 col-sm-6 col-md-4 admin-form-group">

                            <label class="form-label admin-form-label">
                                نویسنده مقاله
                            </label>

                            <input type="text" name="author" class="form-control admin-form-control" />

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

                                <option
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

                            <input class="form-control admin-form-control admin-file-input" name="image" type="file" />

                            <div class="form-text text-danger admin-form-error">
                                <?= $invalidInputImage ?>
                            </div>

                        </div>

                        <div class="col-12 admin-form-group">

                            <label for="formFile" class="form-label admin-form-label">
                                متن مقاله
                            </label>

                            <textarea class="form-control admin-form-control admin-textarea" name="body"
                                rows="6"></textarea>

                            <div class="form-text text-danger admin-form-error">
                                <?= $invalidInputBody ?>
                            </div>

                        </div>

                        <div class="col-12 admin-form-actions">

                            <button type="submit" name="addPost" class="btn btn-dark admin-primary-btn">
                                <i class="bi bi-plus-lg"></i>
                                ایجاد مقاله
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