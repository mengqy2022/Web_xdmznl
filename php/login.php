<?php
session_start();

$servername = "115.24.3.211";
$username = "mengqingyao";
$password = "mengqy416";
$dbname = "mengqingyao";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}

$username = $_POST['login-email']; // 用于邮箱登录
$password = $_POST['login-password'];

// 查询用户
$stmt = $conn->prepare("SELECT * FROM xdmznl WHERE email = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    
    // 验证密码
    if (password_verify($password, $row['password'])) {
        $_SESSION['user_id'] = $row['id'];
        
        header("Location: ../Log.html");
        exit(); // 确保后续代码不再执行
    } else {
        echo "密码错误!";
    }
} else {
    echo "用户不存在!";
}

$stmt->close();
$conn->close();
?>
