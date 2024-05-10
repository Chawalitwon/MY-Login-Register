<?php
session_start();
require_once('connection.php');

if (!isset($_SESSION['token']) || !isset($_POST['token']) || $_SESSION['token'] !== $_POST['token']) {
    die(json_encode(array('status' => 'error', 'message' => 'CSRF token mismatch')));
    header("Location: index.php");
    exit();
}

if (isset($_POST['submit'])) {
    $firstname = htmlspecialchars($_POST['firstname']);
    $lastname = htmlspecialchars($_POST['lastname']);
    $username = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);
    $password = $_POST['password'];
    $salt = bin2hex(random_bytes(16));

    // ตรวจสอบว่ามีชื่อผู้ใช้หรืออีเมลอยู่แล้ว
    $stmt = $pdo->prepare("SELECT COUNT(*) AS count FROM users WHERE username = ? OR email = ?");
    $stmt->execute([$username, $email]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row && $row['count'] > 0) {
        // มีชื่อผู้ใช้หรืออีเมลอยู่แล้ว
        die(json_encode(array('status' => 'error', 'message' => 'ชื่อผู้ใช้หรืออีเมลมีอยู่แล้ว')));
    }

    $hashed_password = password_hash($password . $salt, PASSWORD_ARGON2I);

    $stmt = $pdo->prepare("INSERT INTO users (firstname, lastname, username, email, password, salt) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$firstname, $lastname, $username, $email, $hashed_password, $salt]);
    $user_id = $pdo->lastInsertId();

    $stmt = $pdo->prepare("INSERT INTO user_roles (user_id, role) VALUES (?, 'user')");
    $stmt->execute([$user_id]);

    // การลงทะเบียนสำเร็จ
    die(json_encode(array('status' => 'success', 'message' => 'สำเร็จ')));
} else {
    // คำขอไม่ถูกต้อง
    die(json_encode(array('status' => 'error', 'message' => 'Invalid request')));
}
