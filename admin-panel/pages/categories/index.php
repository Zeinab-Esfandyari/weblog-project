<?php
include "../../include/layout/header.php";

$categories = $db->query('SELECT * FROM categories ORDER BY id DESC');

if(isset($_GET['action']) && isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = $db -> prepare('DELETE FROM categories WHERE  id = :id ');
    $query -> execute(['id' => $id]);

    header("location:index.php");
    exit();

}
?>

<div class="admin-dashboard">
    <div class="admin-dashboard-layout">
        <?php
            include "../../include/layout/sidbar.php";
?>

        <main class="admin-dashboard-main">
            <div class="admin-page-header">
                <div>
                    <span class="admin-page-eyebrow">مدیریت محتوا</span>
                    <h1 class="admin-page-title">دسته‌بندی‌ها</h1>
                    <p class="admin-page-description">
                        مدیریت و سازمان‌دهی دسته‌بندی‌های وبلاگ
                    </p>
                </div>

                <div class="admin-page-toolbar">
                    <a href="./create.php" class="admin-primary-btn">
                        <span>+</span>
                        ایجاد دسته‌بندی
                    </a>
                </div>
            </div>

            <section class="admin-dashboard-section">
                <div class="admin-section-header">
                    <div>
                        <span class="admin-section-eyebrow">محتوا</span>
                        <h2 class="admin-section-title">فهرست دسته‌بندی‌ها</h2>
                    </div>
                    <span class="admin-section-icon">▤</span>
                </div>

                <div class="admin-table-card">
                    <?php if($categories->rowCount() > 0):?>
                    <div class="admin-table-responsive">
                        <table class="admin-data-table">
                            <thead>
                                <tr>
                                    <th>شناسه</th>
                                    <th>عنوان دسته‌بندی</th>
                                    <th>عملیات</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($categories as $category):?>
                                <tr>
                                    <th><?= $category['id'] ?>
                                    </th>
                                    <td>
                                        <span class="admin-table-primary-text">
                                            <?= $category['title'] ?>
                                        </span>
                                    </td>
                                    <td>
                                        <div class="admin-table-actions">
                                            <a href="./edit.php?id=<?= $category['id'] ?> "
                                                class="admin-action-btn admin-edit-btn">
                                                ویرایش
                                            </a>
                                            <a href="index.php?action=delete&id=<?= $category['id'] ?>"
                                                class="admin-action-btn admin-delete-btn">
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
                    <div class="admin-empty-message">
                        <span class="admin-empty-icon">▤</span>
                        <p>دسته‌بندی‌ای یافت نشد...</p>
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