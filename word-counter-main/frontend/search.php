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

// Lấy giá trị từ biến POST
$domainName = $_POST['domain'];

// Query tìm kiếm trong cơ sở dữ liệu
$sql = "SELECT * FROM dulieu WHERE phienam LIKE '%$domainName%'";
$result = $conn->query($sql);

// Lưu lịch sử tìm kiếm
$thoi_gian = date("Y-m-d H:i:s");
$insert_query = $conn->prepare("INSERT INTO lichsu (tukhoa, thoigian) VALUES (?, ?)");
$insert_query->bind_param("ss", $domainName, $thoi_gian);
$insert_query->execute();

$insert_query->close();

// Kiểm tra và hiển thị kết quả
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["phienam"] . "</td>";
        echo "<td>" . $row["loaitu"] . "</td>";
        echo "<td>" . $row["nghia"] . "</td>";
        echo "<td>" . $row["vidu"] . "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='4'>Không có dữ liệu</td></tr>";
}

// Hiển thị lịch sử tìm kiếm
$lich_su_query = $conn->query("SELECT * FROM lichsu ORDER BY thoigian DESC LIMIT 10");
$lichsu = $lich_su_query->fetch_all(MYSQLI_ASSOC);

echo "<h2>Lịch sử tìm kiếm gần đây:</h2>";
echo "<ul>";
foreach ($lichsu as $lichsu_row) {
    echo "<li>{$lichsu_row['tukhoa']} - {$lichsu_row['thoigian']}</li>";
}
echo "</ul>";

// Đóng kết nối MySQL
$conn->close();
?>
