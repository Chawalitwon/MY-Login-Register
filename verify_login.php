<?php
session_set_cookie_params(3600, '/', '', false, true);
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('connection.php');


if (!isset($_SESSION['token']) || !isset($_POST['token']) || $_SESSION['token'] !== $_POST['token']) {
    die(json_encode(array('status' => 'error', 'message' => 'CSRF token mismatch')));
    header("Location: index.php");
    exit();
}

if (isset($_POST['submit'])) {
    $username = htmlspecialchars($_POST['username']);
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT id, username, password, salt FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($stmt->rowCount() == 1) {
        $salt = $row['salt'];
        $hashed_password = password_hash($password . $salt, PASSWORD_ARGON2I);
        if (password_verify($password . $salt, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];

            $stmt = $pdo->prepare("SELECT role FROM user_roles WHERE user_id = ?");
            $stmt->execute([$row['id']]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row['role'] == 'admin') {
                // ผู้ดูแลระบบ เข้าสู่ระบบสำเร็จ
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['role'] = 'admin'; // เพิ่ม session สำหรับผู้ดูแลระบบ
                die(json_encode(array('status' => 'success', 'role' => 'admin')));
            } else {
                // ผู้ใช้ เข้าสู่ระบบสำเร็จ
                $_SESSION['user_id'] = $row['id'];
                // $_SESSION['role'] = 'user'; // เพิ่ม session สำหรับผู้ใช้ทั่วไป
                die(json_encode(array('status' => 'success', 'role' => 'user')));
            }
        } else {
            // ชื่อผู้ใช้ หรือ รหัสผ่านไม่ถูกต้อง
            die(json_encode(array('status' => 'error', 'message' => 'ชื่อผู้ใช้ หรือ รหัสผ่านไม่ถูกต้อง')));
        }
    } else {
        // ไม่สามารถเข้าสู่ระบบได้โปรดกรอกข้อมูลใหม่อีกครั้ง
        die(json_encode(array('status' => 'error', 'message' => 'โปรดกรอกข้อมูลใหม่อีกครั้ง')));
    }
} else {
    // ไม่พบพารามิเตอร์การส่ง
    die(json_encode(array('status' => 'error', 'message' => 'Submit parameter not found')));
}
