
<?php

session_start();

include "../../include/config.php";
include "../../include/db.php";
$invalidInputEmail = '';
$invalidInputPassword = '';
if (isset($_POST['login'])) {
    if (empty(trim($_POST['email']))) {
        $invalidInputEmail = "فیلد ایمیل ضروری است";
    }
    if (empty(trim($_POST['password']))) {
        $invalidInputPassword = "فیلد پسورد ضروری است";
    }

    if (!empty(trim($_POST['email'])) && !empty(trim($_POST['password']))) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $user = $db->prepare("SELECT * FROM users WHERE email=:email AND password=:password");
        $user->execute(['email' => $email , 'password' => $password]);

        if ($user->rowCount() == 1) {
            $_SESSION['email'] = $email;
            header('location:../../index.php');
            exit();
        }

        header("Location:login.php?err_msg=کاربری با این اطلاعات یافت نشد");
        exit();
    }
}

?>

<!DOCTYPE html>
<html dir="rtl" lang="fa">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>php tutorial || blog project || webprog.io</title>

    <!-- <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC+5VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9"
            crossorigin="anonymous"
        /> -->
    <link href="../../assets/css/bootstrap.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="../../assets/css/style.css" />
</head>

<body class="auth admin-body">
    <main class="admin-auth-wrapper">
        <div class="admin-auth-card">
            <div class="admin-auth-brand">
                <div class="admin-auth-brand-icon">W</div>
                <div class="admin-auth-brand-name">webprog.io</div>
                <span class="admin-auth-eyebrow">پنل مدیریت وبلاگ</span>
            </div>

            <div class="admin-auth-heading">
                <h1 class="admin-auth-title">خوش آمدید</h1>
                <p class="admin-auth-description">
                    برای ورود به حساب کاربری خود اطلاعات زیر را وارد کنید.
                </p>
            </div>

            <?php if(isset($_GET['err_msg'])):  ?>
            <div class="admin-auth-error">
                <?= $_GET['err_msg'] ?>
            </div>
            <?php endif ?>

            <form method="post" class="admin-auth-form">
                <div class="admin-form-group">
                    <label class="admin-form-label">ایمیل</label>
                    <input
                        type="email"
                        name="email"
                        class="admin-form-control"
                        placeholder="ایمیل خود را وارد کنید"
                    />
                    <div class="admin-form-error">
                        <?= $invalidInputEmail ?>
                    </div>
                </div>

                <div class="admin-form-group">
                    <label class="admin-form-label">رمز عبور</label>
                    <input
                        type="password"
                        name="password"
                        class="admin-form-control"
                        placeholder="رمز عبور خود را وارد کنید"
                    />
                    <div class="admin-form-error">
                        <?= $invalidInputPassword ?>
                    </div>
                </div>

                <button name="login" class="admin-auth-submit" type="submit">
                    ورود به پنل مدیریت
                </button>
            </form>

            <div class="admin-auth-footer">
                <span>webprog.io</span>
                <span>مدیریت محتوای وبلاگ</span>
            </div>
        </div>
    </main>

    <!-- <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
            crossorigin="anonymous"
        ></script> -->
    <script src="../../assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>
