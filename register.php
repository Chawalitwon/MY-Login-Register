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
    <title>ลงทะเบียน</title>
    <!-- logo -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/logo.png" >

    <!-- cdn SweetAlert2-->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css" rel="stylesheet">

    <!-- cdn Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" rel="stylesheet" >

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
            <h2 class="mb-4 login">ลงทะเบียน</h2>
            <form action="verify_register.php" method="POST" id="RegisterForm">
                <div class="row g-2 mb-3">
                    <div class="col-md">
                        <input type="text" class="form-control" id="firstname" name="firstname" placeholder="ชื่อ">
                    </div>
                    <div class="col-md">
                        <input type="text" class="form-control" id="lastname" name="lastname" placeholder="นามสกุล">
                    </div>
                </div>
                <div class="mb-3">
                    <input type="text" class="form-control" id="username" name="username" placeholder="ชื่อผู้ใช้งาน">
                </div>
                <div class="mb-3">
                    <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="อีเมล">
                </div>

                <div class="row g-2 mb-3">
                    <div class="col-md">
                        <input type="password" class="form-control" id="password" name="password" placeholder="รหัสผ่าน">
                    </div>
                    <div class="col-md">
                        <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="ยืนยันรหัสผ่าน">
                    </div>
                </div>

                <div class="mb-3 d-flex justify-content-center">
                    <input type="submit" name="submit" class="btn btn-primary w-100 btn_login" value="ลงทะเบียน">
                    <hr>
                    <input type="hidden" name="token" value="<?php echo $token; ?>">
                </div>
                <div class="form-group text-center">
                    <label for="register-link">มีบัญชี? <a href="login.php" class="no-underline" id="register-link">เข้าสู่ระบบ</a></label>

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