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
    $phienam = $_POST['phienam'];
    $loaitu = $_POST['loaitu'];
    $nghia = $_POST['nghia'];
    $vidu = $_POST['vidu'];

    $thoi_gian = date("Y-m-d H:i:s");

    $insert_query = $conn->prepare("INSERT INTO dulieu (phienam, loaitu, nghia, vidu) VALUES (?, ?, ?, ?)");
    $insert_query->bind_param("ssss", $phienam, $loaitu, $nghia, $vidu);
    $insert_query->execute();
    $insert_query->close();

    echo "<script>
    alert('Thêm nội dung thành công!');
    window.location.href = document.referrer;
  </script>";
}

$conn->close();
?>
