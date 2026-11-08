<?php
include "../../include/layout/header.php";
$comments = $db->query('SELECT * FROM comments ORDER BY id DESC');

if(isset($_GET['action']) && isset($_GET['id'])) {
    $action = $_GET['action'];
    $id = $_GET['id'];

    if ($action == "delete") {
        $query = $db -> prepare('DELETE FROM comments WHERE id = :id');
        $query -> execute(['id' => $id]);

    } else {

        $query = $db -> prepare("UPDATE comments SET status = '1' WHERE id = :id");
        $query -> execute(['id' => $id]);
    }
    header('location:index.php');
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
                    <h1 class="admin-page-title">مدیریت کامنت‌ها</h1>
                    <p class="admin-page-description">
                        مشاهده، بررسی و مدیریت نظرات کاربران وبلاگ
                    </p>
                </div>
            </div>

            <section class="admin-dashboard-section">
                <div class="admin-section-header">
                    <div>
                        <span class="admin-section-eyebrow">تعامل کاربران</span>
                        <h2 class="admin-section-title">فهرست کامنت‌ها</h2>
                    </div>
                    <span class="admin-section-icon">☷</span>
                </div>

                <div class="admin-table-card">
                    <?php if($comments->rowCount() > 0):?>
                    <div class="admin-table-responsive">
                        <table class="admin-data-table">
                            <thead>
                                <tr>
                                    <th>شناسه</th>
                                    <th>نام</th>
                                    <th>متن کامنت</th>
                                    <th>وضعیت و عملیات</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($comments as $comment): ?>
                                <tr>
                                    <th><?= $comment['id'] ?>
                                    </th>
                                    <td>
                                        <span class="admin-table-primary-text">
                                            <?= $comment['name'] ?>
                                        </span>
                                    </td>
                                    <td>
                                        <div class="admin-comment-text">
                                            <?= $comment['comment'] ?>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="admin-table-actions">
                                            <?php if($comment['status']): ?>
                                            <a href="#" class="admin-action-btn admin-approved-btn disabled">
                                                تایید شده
                                            </a>
                                            <?php else: ?>
                                            <a href="index.php?action=approve&id=<?= $comment['id'] ?>"
                                                class="admin-action-btn admin-pending-btn">
                                                در انتظار تأیید
                                            </a>
                                            <?php endif ?>

                                            <a href="index.php?action=delete&id=<?= $comment['id'] ?>"
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
                        <span class="admin-empty-icon">☷</span>
                        <p>کامنتی یافت نشد...</p>
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