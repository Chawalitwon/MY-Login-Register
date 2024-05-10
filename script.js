//=======================================================Part Login=============================================================//
// การตรวจสอบสำหรับแบบฟอร์มเข้าสู่ระบบ
$(document).ready(function () {
    $("#loginForm").validate({
        rules: {
            username: {
                required: true,
            },
            password: {
                required: true,
            }
        },
        messages: {
            username: {
                required: "<span class='text-danger'>กรุณาป้อนชื่อผู้ใช้งาน</span>",
            },
            password: {
                required: "<span class='text-danger'>กรุณาป้อนรหัสผ่าน</span>",
            }
        },
        submitHandler: function (form) {
            $.ajax({
                url: 'verify_login.php',
                type: 'POST',
                data: $(form).serialize(),
                success: function (response) {
                    var result = JSON.parse(response);
                    if (result.status == 'success' && result.role == 'admin') {
                        Swal.fire({
                            icon: "success",
                            title: "เข้าสู่ระบบสำเร็จ",
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            window.location = "admin.php";
                        });
                    } else if (result.status == 'success' && result.role == 'user') {
                        Swal.fire({
                            icon: "success",
                            title: "เข้าสู่ระบบสำเร็จ",
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            window.location = "user.php";
                        });
                    } else if (result.status == 'error') {
                        Swal.fire({
                            icon: "error",
                            title: "ไม่สามารถเข้าสู่ระบบได้",
                            text: result.message,
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            window.location = "index.php";
                        });
                    }
                }
            });
        }
    });

    //=======================================================Part Register=============================================================//
    // ตรวจสอบที่กำหนดเองสำหรับฟิลด์รหัสผ่าน
    $.validator.addMethod("passwordFormat", function (value, element) {
        // ตรวจสอบว่าค่าประกอบด้วยอักษรตัวพิมพ์ใหญ่อย่างน้อยหนึ่งตัว ตัวพิมพ์เล็กหนึ่งตัว ตัวเลขหนึ่งตัว และอักขระพิเศษหนึ่งตัว
        return /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()_+])(?=.*[^\da-zA-Z]).{8,}$/.test(value);
    }, "Passwords must contain at least one uppercase letter, one lowercase letter, one digit, and one special character");

    // การตรวจสอบสำหรับแบบฟอร์มลงทะเบียน
    $("#RegisterForm").validate({
        rules: {
            firstname: {
                required: true,
            },
            lastname: {
                required: true,
            },
            username: {
                required: true,

            },
            email: {
                required: true,
            },
            password: {
                required: true,
                minlength: 8,
                passwordFormat: true
            },
            confirmPassword: {
                required: true,
                minlength: 8,
                equalTo: "#password"
            }
        },
        messages: {
            firstname: {
                required: "<span class='text-danger'>กรุณาป้อนชื่อ</span>"
            },
            lastname: {
                required: "<span class='text-danger'>กรุณาป้อนนามสกุล</span>"
            },
            username: {
                required: "<span class='text-danger'>กรุณาป้อนชื่อผู้ใช้งาน</span>"
            },
            email: {
                required: "<span class='text-danger'>กรุณาป้อนที่อยู่อีเมล</span>",
                email: "<span class='text-danger'>กรุณาป้อนที่อยู่อีเมลที่ถูกต้อง</span>"
            },
            password: {
                required: "<span class='text-danger'>กรุณาป้อนรหัสผ่าน</span>",
                minlength: "<span class='text-danger'>รหัสผ่านต้องมีความยาวอย่างน้อย 8 ตัวอักษร</span>",
                passwordFormat: "<span class='text-danger'>รหัสผ่านต้องมีอักษรตัวพิมพ์ใหญ่อย่างน้อย 1 ตัว ตัวพิมพ์เล็ก 1 ตัว ตัวเลข 1 ตัว และอักขระพิเศษ 1 ตัว</span>"

            },
            confirmPassword: {
                required: "<span class='text-danger'>ยืนยันรหัสผ่าน</span>",
                minlength: "<span class='text-danger'>รหัสผ่านต้องมีความยาวอย่างน้อย 8 ตัวอักษร</span>",
                equalTo: "<span class='text-danger'>รหัสผ่านไม่ตรงกัน</span>"
            }
        },
        submitHandler: function(form) {
            $.ajax({
              url: 'verify_register.php',
              type: 'POST',
              data: $(form).serialize(),
              dataType: 'json',
              success: function(response) {
                if (response.status === 'success') {
                  Swal.fire({
                    icon: 'success',
                    title: 'การลงทะเบียน',
                    text: response.message,
                    showConfirmButton: false,
                    timer: 1500
                  }).then(function() {
                    window.location.href = 'index.php';
                  });
                } else {
                  Swal.fire({
                    icon: 'error',
                    title: 'ไม่สามารถลงทะเบียนได้',
                    text: response.message,
                    showConfirmButton: false,
                    timer: 1500
                  }).then(function() {
                    window.location.href = 'index.php';
                  });
                }
              },
              error: function(jqXHR, textStatus, errorThrown) {
                Swal.fire({
                  icon: 'error',
                  title: 'Error',
                  text: errorThrown,
                  showConfirmButton: false,
                  timer: 1500
                });
              }
            });
          }   
    });

    //=======================================================Part Forgotpassword=============================================================//
    // การตรวจสอบสำหรับแบบฟอร์มรีเซ็ตรหัสผ่าน
    $("#ForgotpasswordForm").validate({
        rules: {
            email: {
                required: true,
            }
        },
        messages: {
            email: {
                required: "<span class='text-danger'>กรุณาป้อนที่อยู่อีเมลของคุณ</span>",
                email: "<span class='text-danger'>กรุณาป้อนที่อยู่อีเมลที่ถูกต้อง</span>"
            }
        },
        submitHandler: function (form) {
            form.submit();
        }

    });
});