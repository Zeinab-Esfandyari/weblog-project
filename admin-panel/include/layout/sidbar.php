
<?php
$path = $_SERVER['REQUEST_URI'];
?>

<div class="sidebar admin-sidebar border border-right col-md-3 col-lg-2 p-0">

    <div class="offcanvas-md offcanvas-end admin-sidebar-offcanvas" tabindex="-1" id="sidebarMenu">

        <div class="offcanvas-header admin-sidebar-header">
            <div class="admin-sidebar-brand">
                <i class="bi bi-grid-1x2-fill"></i>
                <span>پنل مدیریت</span>
            </div>

            <button type="button"
                class="btn-close admin-sidebar-close"
                data-bs-dismiss="offcanvas"
                data-bs-target="#sidebarMenu">
            </button>
        </div>

        <div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto admin-sidebar-body">

            <div class="admin-sidebar-label">
                منوی اصلی
            </div>

            <ul class="nav flex-column pe-3 admin-sidebar-menu">

                <li class="nav-item admin-sidebar-item">
                    <a class="nav-link text-decoration-none admin-sidebar-link <?= str_contains($path, 'admin-panel/index.php') && !str_contains($path, 'pages') ? 'text-secondary admin-sidebar-link-active' : '' ?>"
                        href="/weblog-project/admin-panel/index.php">

                        <i class="bi bi-house-fill admin-sidebar-icon"></i>
                        <span>داشبورد</span>
                    </a>
                </li>

                <li class="nav-item admin-sidebar-item">
                    <a class="nav-link text-decoration-none admin-sidebar-link <?= str_contains($path, 'posts') ? 'text-secondary admin-sidebar-link-active' : '' ?>"
                        href="/weblog-project/admin-panel/pages/posts/index.php">

                        <i class="bi bi-file-earmark-image-fill admin-sidebar-icon"></i>
                        <span>مقالات</span>
                    </a>
                </li>

                <li class="nav-item admin-sidebar-item">
                    <a class="nav-link text-decoration-none admin-sidebar-link <?= str_contains($path, 'categories') ? 'text-secondary admin-sidebar-link-active' : '' ?>"
                        href="/weblog-project/admin-panel/pages/categories/index.php">

                        <i class="bi bi-folder-fill admin-sidebar-icon"></i>
                        <span>دسته بندی</span>
                    </a>
                </li>

                <li class="nav-item admin-sidebar-item">
                    <a class="nav-link text-decoration-none admin-sidebar-link <?= str_contains($path, 'comments') ? 'text-secondary admin-sidebar-link-active' : '' ?>"
                        href="/weblog-project/admin-panel/pages/comments/index.php">

                        <i class="bi bi-chat-left-text-fill admin-sidebar-icon"></i>
                        <span>کامنت ها</span>
                    </a>
                </li>

                <li class="admin-sidebar-divider"></li>

                <li class="nav-item admin-sidebar-item">
                    <a class="nav-link text-decoration-none admin-sidebar-link admin-sidebar-logout"
                        href="/weblog-project/admin-panel/pages/auth/logout.php">

                        <i class="bi bi-box-arrow-right admin-sidebar-icon"></i>
                        <span>خروج</span>
                    </a>
                </li>

            </ul>

        </div>

    </div>

</div>
