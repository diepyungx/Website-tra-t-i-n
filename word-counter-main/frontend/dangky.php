<?php
$servername = "localhost";
$username = "root";
$password = "02022004";
$database = "web1";

// Kết nối đến cơ sở dữ liệu
$conn = new mysqli($servername, $username, $password, $database);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Lấy dữ liệu từ form đăng ký
$username = $_POST['username'];
$email = $_POST['email'];

// Kiểm tra xem tài khoản đã tồn tại chưa
$sql_check = "SELECT * FROM users WHERE username = '$username' OR email = '$email'";
$result_check = $conn->query($sql_check);

if ($result_check->num_rows > 0) {
    echo "Tài khoản đã tồn tại. Vui lòng chọn tên khác.";
} else {
    // Thêm tài khoản vào cơ sở dữ liệu
    $sql_insert = "INSERT INTO users (username, email) VALUES ('$username', '$email')";
    
    if ($conn->query($sql_insert) === TRUE) {
        echo "Tài khoản đã được thêm thành công!";
    } else {
        echo "Error: " . $sql_insert . "<br>" . $conn->error;
    }
}

// Đóng kết nối
$conn->close();
?>
