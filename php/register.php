<?php

$servername = "115.24.3.211";
$username = "mengqingyao";
$password = "mengqy416";
$dbname = "mengqingyao";

// 创建连接
$conn = new mysqli($servername, $username, $password, $dbname);

// 检查连接
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}

// 获取表单数据
$username = $_POST['reg-username'];
$email = $_POST['reg-email'];
$phone = $_POST['reg-phone']; // 新增手机号变量
$password = password_hash($_POST['reg-password'], PASSWORD_DEFAULT); // 加密密码

// 检查用户名、邮箱或手机号是否已注册
$stmt = $conn->prepare("SELECT * FROM xdmznl WHERE username = ? OR email = ? OR phone = ?");
$stmt->bind_param("sss", $username, $email, $phone);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo "用户名、邮箱或手机已被注册!";
} else {
    // 插入新用户
    $stmt = $conn->prepare("INSERT INTO xdmznl (username, email, phone, password) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $username, $email, $phone, $password);
    if ($stmt->execute()) {
        echo "注册成功! 请验证您的邮箱以完成注册。";
    } else {
        echo "注册失败: " . $stmt->error;
    }
}

$stmt->close();
$conn->close();
?>
