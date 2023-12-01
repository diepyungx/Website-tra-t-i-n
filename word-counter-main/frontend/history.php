<?php
// Thông tin kết nối MySQL
$servername = "localhost";
$username = "root";
$password = "02022004";
$database = "web1";

// Kết nối đến MySQL
$conn = new mysqli($servername, $username, $password, $database);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Truy vấn cơ sở dữ liệu để lấy dữ liệu từ bảng lichsu
$sql = "SELECT * FROM lichsu ORDER BY thoigian DESC LIMIT 10";
$result = $conn->query($sql);

// Mảng để lưu trữ dữ liệu
$data = array();

// Kiểm tra và đổ dữ liệu vào mảng
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = array(
            'tukhoa' => $row['tukhoa'],
            'thoigian' => $row['thoigian']
        );
    }
}

// Đóng kết nối MySQL
$conn->close();

// Xuất dữ liệu dưới dạng JSON
header('Content-Type: application/json');
echo json_encode($data);
?>
