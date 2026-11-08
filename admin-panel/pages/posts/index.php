<?php
include "../../include/layout/header.php";

$posts = $db->query('SELECT * FROM posts ORDER BY id DESC');

if(isset($_GET['action']) && isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = $db -> prepare('DELETE FROM posts WHERE  id = :id ');
    $query -> execute(['id' => $id]);

    header("location:index.php");
    exit();

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
                    <h1 class="admin-page-title">مقالات</h1>
                    <p class="admin-page-description">
                        مدیریت و مشاهده تمام مقالات وبلاگ
                    </p>
                </div>

                <div class="btn-toolbar mb-2 mb-md-0 admin-page-toolbar">

                    <a href="./create.php" class="btn btn-sm btn-dark admin-primary-btn">
                        <i class="bi bi-plus-lg"></i>
                        ایجاد مقاله
                    </a>

                </div>

            </div>

            <!-- Posts -->
            <section class="admin-dashboard-section mt-4">

                <div class="admin-section-header">

                    <div>
                        <span class="admin-section-eyebrow">فهرست محتوا</span>
                        <h4 class="admin-section-title">همه مقالات</h4>
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

                                    <th>
                                        <?= $post['id'] ?>
                                    </th>

                                    <td class="admin-table-primary-text">
                                        <?= $post['title'] ?>
                                    </td>

                                    <td>
                                        <?= $post['author'] ?>
                                    </td>

                                    <td>

                                        <div class="admin-table-actions">

                                            <a href="./edit.php?id=<?= $post['id'] ?>"
                                                class="btn btn-sm btn-outline-dark admin-action-btn admin-edit-btn">

                                                <i class="bi bi-pencil-square"></i>
                                                ویرایش

                                            </a>

                                            <a href="index.php?action=delete&id=<?= $post['id'] ?>"
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

        </main>

    </div>

</div>

<?php
    include "../../include/layout/footer.php";
?>