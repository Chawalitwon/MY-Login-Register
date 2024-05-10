<?php
session_start();
$token = bin2hex(random_bytes(32));
$_SESSION['token'] = $token;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เข้าสู่ระบบ</title>
    <!-- logo -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/logo.png">

    <!-- cdn SweetAlert2-->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css" rel="stylesheet">

    <!-- cdn Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" rel="stylesheet">

    <!-- google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@500&display=swap" rel="stylesheet">

    <!-- style css -->
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <div class="form-container">
            <i class="fas fa-user-circle fa-5x mb-2"></i>
            <h2 class="mb-4 login">เข้าสู่ระบบ</h2>
            <form action="verify_login.php" method="POST" id="loginForm">
                <div class="mb-3">
                    <input type="text" class="form-control" id="username" name="username" placeholder="ชื่อผู้ใช้งาน">
                </div>
                <div class="mb-2">
                    <input type="password" class="form-control" id="password" name="password" placeholder="รหัสผ่าน">
                </div>
                <div class="form-group mb-3 d-flex justify-content-between align-items-center">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="remember">
                        <label class="form-check-label" for="remember">จดจำฉัน</label>
                    </div>
                    <a href="forgot_password.php" class="ml-auto no-underline" id="register-link">ลืมรหัสผ่าน</a>
                </div>
                <div class="mb-3 d-flex justify-content-center">
                    <input type="submit" name="submit" id="submit" class="btn btn-primary w-100 btn_login" value="เข้าสู่ระบบ">
                    <input type="hidden" name="token" value="<?php echo $token; ?>">
                </div>
                <div class="form-group text-center">
                    <label for="register-link">ไม่มีบัญชี? <a href="register.php" class="no-underline" id="register-link">ลงทะเบียน</a></label>
                </div>
            </form>
        </div>
    </div>

    <!-- cdn jquery and validation js -->
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>

    <!-- cdn bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>

    <!-- cdn sweetalert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js"></script>

    <!-- jquery validation -->
    <script src="script.js"></script>
</body>

</html>