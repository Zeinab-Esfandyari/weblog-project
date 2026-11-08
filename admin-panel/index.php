<?php
include "./include/layout/header.php";

// entity=comment&action=delete&id=18
if(isset($_GET['entity']) && isset($_GET['action']) && isset($_GET['id'])) {
    $entity = $_GET['entity'];
    $action = $_GET['action'];
    $id = $_GET['id'];


    if ($action == "delete") {
        switch ($entity) {
            case "post":
                $query = $db -> prepare('DELETE FROM posts WHERE id = :id');
                break;
            case "comment":
                $query = $db -> prepare('DELETE FROM comments WHERE id = :id');
                break;
            case "category":
                $query = $db -> prepare('DELETE FROM categories WHERE id = :id');
                break;
        }
    } elseif($action == "approve") {

        $query = $db -> prepare("UPDATE comments SET status = '1' WHERE id = :id");
    }

    $query -> execute(['id' => $id]);
}


$posts = $db->query('SELECT * FROM posts ORDER BY id DESC LIMIT 5');

$comments = $db->query('SELECT * FROM comments ORDER BY id DESC LIMIT 5');

$categories = $db->query('SELECT * FROM categories ORDER BY id DESC');



// echo "<pre>";
// print_r($comments->fetchall());
?>

<div class="container-fluid admin-dashboard">

    <div class="row admin-dashboard-layout">

        <!-- Sidebar Section -->
        <?php
            include "./include/layout/sidbar.php";
?>

        <!-- Main Section -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 admin-dashboard-main">

            <div
                class="admin-page-header d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
                <div>
                    <span class="admin-page-eyebrow">مدیریت وبلاگ</span>
                    <h1 class="admin-page-title">داشبورد</h1>
                    <p class="admin-page-description">نمای کلی فعالیت‌ها و محتوای وبلاگ</p>
                </div>
            </div>

            <!-- Recently Posts -->
            <section class="admin-dashboard-section mt-4">

                <div class="admin-section-header">
                    <div>
                        <span class="admin-section-eyebrow">محتوا</span>
                        <h4 class="admin-section-title">مقالات اخیر</h4>
                    </div>
                    <i class="bi bi-file-earmark-text admin-section-icon"></i>
                </div>

                <div class="admin-table-card">

                    <?php if($posts->rowCount() > 0):?>

                    <div class="table-responsive admin-table-responsive">
                        <table class="table table-hover align-middle admin-data-table">

                            <thead>
                                <tr>
                                    <th>شناسه</th>
                                    <th>عنوان</th>
                                    <th>نویسنده</th>
                                    <th>عملیات</th>
                                </tr>
                            </thead>

                            <tbody>

                                <?php foreach($posts as $post): ?>

                                <tr>
                                    <th><?= $post['id'] ?>
                                    </th>

                                    <td class="admin-table-primary-text">
                                        <?= $post['title'] ?>
                                    </td>

                                    <td>
                                        <?= $post['author'] ?>
                                    </td>

                                    <td>
                                        <div class="admin-table-actions">

                                            <a href="#"
                                                class="btn btn-sm btn-outline-dark admin-action-btn admin-edit-btn">
                                                <i class="bi bi-pencil-square"></i>
                                                ویرایش
                                            </a>

                                            <a href="index.php?entity=post&action=delete&id=<?= $post['id'] ?>"
                                                class="btn btn-sm btn-outline-danger admin-action-btn admin-delete-btn">
                                                <i class="bi bi-trash"></i>
                                                حذف
                                            </a>

                                        </div>
                                    </td>
                                </tr>

                                <?php endforeach ?>

                            </tbody>

                        </table>
                    </div>

                    <?php else: ?>

                    <div class="alert alert-danger admin-empty-message">
                        <i class="bi bi-exclamation-circle me-2"></i>
                        مقاله ای یافت نشد...
                    </div>

                    <?php endif ?>

                </div>

            </section>

            <!-- Recently Comments -->
            <section class="admin-dashboard-section mt-4">

                <div class="admin-section-header">
                    <div>
                        <span class="admin-section-eyebrow">تعامل کاربران</span>
                        <h4 class="admin-section-title">کامنت های اخیر</h4>
                    </div>
                    <i class="bi bi-chat-square-text admin-section-icon"></i>
                </div>

                <div class="admin-table-card">

                    <?php if($comments->rowCount() > 0):?>

                    <div class="table-responsive admin-table-responsive">
                        <table class="table table-hover align-middle admin-data-table">

                            <thead>
                                <tr>
                                    <th>شناسه</th>
                                    <th>نام</th>
                                    <th>متن کامنت</th>
                                    <th>عملیات</th>
                                </tr>
                            </thead>

                            <tbody>

                                <?php foreach($comments as $comment): ?>

                                <tr>
                                    <th><?= $comment['id'] ?>
                                    </th>

                                    <td class="admin-table-primary-text">
                                        <?= $comment['name'] ?>
                                    </td>

                                    <td class="admin-comment-text">
                                        <?= $comment['comment'] ?>
                                    </td>

                                    <td>
                                        <div class="admin-table-actions">

                                            <?php if($comment['status'] == '1'): ?>

                                            <a href="#"
                                                class="btn btn-sm btn-outline-dark disabled admin-action-btn admin-approved-btn">
                                                <i class="bi bi-check-circle"></i>
                                                تایید شده
                                            </a>

                                            <?php else: ?>

                                            <a href="index.php?entity=comment&action=approve&id=<?= $comment['id'] ?>"
                                                class="btn btn-sm btn-outline-info admin-action-btn admin-pending-btn">
                                                <i class="bi bi-clock-history"></i>
                                                در انتظار تایید
                                            </a>

                                            <?php endif ?>

                                            <a href="index.php?entity=comment&action=delete&id=<?= $comment['id'] ?>"
                                                class="btn btn-sm btn-outline-danger admin-action-btn admin-delete-btn">
                                                <i class="bi bi-trash"></i>
                                                حذف
                                            </a>

                                        </div>
                                    </td>
                                </tr>

                                <?php endforeach ?>

                            </tbody>

                        </table>
                    </div>

                    <?php else: ?>

                    <div class="alert alert-danger admin-empty-message">
                        <i class="bi bi-exclamation-circle me-2"></i>
                        کامنتی یافت نشد...
                    </div>

                    <?php endif ?>

                </div>

            </section>

            <!-- Categories -->
            <section class="admin-dashboard-section mt-4">

                <div class="admin-section-header">
                    <div>
                        <span class="admin-section-eyebrow">ساختار محتوا</span>
                        <h4 class="admin-section-title">دسته بندی</h4>
                    </div>
                    <i class="bi bi-folder2-open admin-section-icon"></i>
                </div>

                <div class="admin-table-card">

                    <?php if($categories->rowCount() > 0):?>

                    <div class="table-responsive admin-table-responsive">
                        <table class="table table-hover align-middle admin-data-table">

                            <thead>
                                <tr>
                                    <th>شناسه</th>
                                    <th>عنوان</th>
                                    <th>عملیات</th>
                                </tr>
                            </thead>

                            <tbody>

                                <?php foreach($categories as $category): ?>

                                <tr>
                                    <th><?= $category['id'] ?>
                                    </th>

                                    <td class="admin-table-primary-text">
                                        <?= $category['title'] ?>
                                    </td>

                                    <td>
                                        <div class="admin-table-actions">

                                            <a href="#"
                                                class="btn btn-sm btn-outline-dark admin-action-btn admin-edit-btn">
                                                <i class="bi bi-pencil-square"></i>
                                                ویرایش
                                            </a>

                                            <a href="index.php?entity=category&action=delete&id=<?= $category['id'] ?>"
                                                class="btn btn-sm btn-outline-danger admin-action-btn admin-delete-btn">
                                                <i class="bi bi-trash"></i>
                                                حذف
                                            </a>

                                        </div>
                                    </td>
                                </tr>

                                <?php endforeach ?>

                            </tbody>

                        </table>
                    </div>

                    <?php else :?>

                    <div class="alert alert-danger admin-empty-message">
                        <i class="bi bi-exclamation-circle me-2"></i>
                        دسته بندی یافت نشد...
                    </div>

                    <?php endif ?>

                </div>

            </section>

        </main>

    </div>

</div>

<?php
    include "./include/layout/footer.php";
?>