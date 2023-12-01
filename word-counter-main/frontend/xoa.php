<?php
$servername = "localhost";
$username = "root";
$password = "02022004";
$database = "web1";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $record_id = $_POST['record_id'];

    $delete_query = $conn->prepare("DELETE FROM dulieu WHERE iddulieu = ?");
    $delete_query->bind_param("i", $record_id);
    $delete_query->execute();
    $delete_query->close();
    echo "<script>
    alert('Xóa bản ghi thành công!');
    window.location.href = document.referrer;
  </script>";
}

$conn->close();
?>
