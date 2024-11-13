<?php

require_once("../../../config.php");
require_once("../../common/function.php");
require_once("../../model/client/client.php");

if (isset($_GET['product'], $_GET['color'], $_GET['size'])) {
    $idProducts = $_GET['product'];
    $idVariations = $_GET['color'];
    // $sizeId = $_GET['size'];
    $sizeId = 1;

    // Kết nối database (sử dụng new mysqli trực tiếp nếu không có hàm Connect())
    $conn = new mysqli(_HOST, _USER, _PASS, _DB, _PORT);
    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }
    $conn->set_charset("utf8");

    // Chuẩn bị câu truy vấn SQL với các tham số truyền vào
    $sql = "SELECT p.*, 
                   v.variationId, 
                   v.image, 
                   v.color, 
                   v.price, 
                   v.descripe, 
                   v.variationCode, 
                   v.sale, 
                   s.sizeId, 
                   s.size
            FROM products AS p
            JOIN variations AS v ON p.productId = v.productId
            JOIN sizevariations AS s ON s.variationId = v.variationId
            WHERE p.productId = ?
              AND v.variationId = ?
              AND s.sizeId = ?";

    // Chuẩn bị và thực hiện câu truy vấn
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        echo json_encode(['error' => 'Lỗi khi chuẩn bị câu truy vấn.']);
        exit;
    }

    $stmt->bind_param("iii", $idProducts, $idVariations, $sizeId);
    if (!$stmt->execute()) {
        echo json_encode(['error' => 'Lỗi khi thực thi câu truy vấn.']);
        exit;
    }

    $result = $stmt->get_result();

    // Xử lý kết quả
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Trả về dữ liệu dưới dạng JSON
        echo json_encode([
            'productId' => $row['productId'],
            'variationId' => $row['variationId'],
            'image' => $row['image'],
            'color' => $row['color'],
            'price' => $row['price'],
            'descripe' => $row['descripe'],
            'variationCode' => $row['variationCode'],
            'sale' => $row['sale'],
            'sizeId' => $row['sizeId'],
            'size' => $row['size']
        ]);
    } else {
        // Trả về lỗi nếu không có dữ liệu
        echo json_encode(['error' => 'Không tìm thấy sản phẩm hoặc dữ liệu không hợp lệ.']);
    }

    // Đóng câu truy vấn và kết nối
    $stmt->close();
    $conn->close();
} else {
    // Trả về lỗi nếu thiếu tham số
    echo json_encode(['error' => 'Thiếu tham số yêu cầu.']);
}
