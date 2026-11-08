<?php
include "../../include/layout/header.php";


$invalidInputTitle = '';
if (isset($_POST['addCategory'])) {

    if (empty(trim($_POST['title']))) {
        $invalidInputTitle = 'فیلد عنوان دسته بندی الزامیست...';
    }
    if (!empty(trim($_POST['title']))) {
        $title = $_POST['title'];

        $categoryInsert = $db->prepare("INSERT INTO categories (title) VALUES (:title)");
        $categoryInsert -> execute(['title' => $title]);


    }
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
                    <h1 class="admin-page-title">ایجاد دسته‌بندی</h1>
                    <p class="admin-page-description">
                        یک دسته‌بندی جدید برای سازمان‌دهی مطالب وبلاگ ایجاد کنید.
                    </p>
                </div>
            </div>

            <section class="admin-dashboard-section">
                <div class="admin-section-header">
                    <div>
                        <span class="admin-section-eyebrow">دسته‌بندی‌ها</span>
                        <h2 class="admin-section-title">اطلاعات دسته‌بندی</h2>
                    </div>
                    <span class="admin-section-icon">▤</span>
                </div>

                <div class="admin-form-card">
                    <form method="post" class="admin-form">
                        <div class="admin-form-group">
                            <label class="admin-form-label">عنوان دسته‌بندی</label>
                            <input type="text" name="title" class="admin-form-control" />
                            <div class="admin-form-error">
                                <?= $invalidInputTitle ?>
                            </div>
                        </div>

                        <div class="admin-form-actions">
                            <button type="submit" name="addCategory" class="admin-primary-btn">
                                ایجاد دسته‌بندی
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