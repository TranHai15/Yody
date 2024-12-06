<?php
// Trả về JSON
header('Content-Type: application/json');
require_once("../../../config.php");
require_once("../../../Backend/common/pdo.php");
require_once("../../../Backend/common/function.php");
require_once("../../model/admin/admin.php");
require_once("../../model/client/client.php");

// Kiểm tra phương thức HTTP

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy thông tin lý do
    $orderId = (int)$_POST['orderId'];
    $reasons = isset($_POST['reason']) ? $_POST['reason'] : [];
    $additionalReason = isset($_POST['additionalReason']) ? trim($_POST['additionalReason']) : '';

    // checkloi($additionalReason);
    // Kiểm tra nếu `$reasons` không phải mảng
    if (!is_array($reasons)) {
        $reasons = [$reasons]; // Chuyển chuỗi thành mảng
    }
    // checkloi($reasons);
    // Kiểm tra nếu lý do hủy đơn chưa được chọn
    if (empty($reasons) && empty($additionalReason)) {
        echo json_encode([
            'success' => false,
            'message' => 'Vui lòng chọn ít nhất một lý do hủy đơn!'
        ], JSON_UNESCAPED_UNICODE);
        exit;
    }

    // Gộp tất cả các lý do thành một chuỗi
    // Ghép các lý do từ checkbox
    if (!empty($additionalReason)) {
        $cancelReasons .= $cancelReasons ? ", $additionalReason" : $additionalReason; // Thêm lý do bổ sung
    }

    $updateLydo = (new Model_Client)->huydon($reasons, $orderId);
    $kq = (new Model_Client)->cancelOrderAndUpdateQuantity($orderId);
    (new Model_Client)->updateTrangthaiTrongKhihuyBenNgoai($orderId);

    // checkloi($updateLydo);
    if ($updateLydo && $kq) {
        echo json_encode([
            'success' => true,
            'message' => 'Đã gửi yêu cầu hủy đơn hàng!'
        ], JSON_UNESCAPED_UNICODE);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Không thể cập nhật lý do hủy đơn. Vui lòng thử lại!'
        ], JSON_UNESCAPED_UNICODE);
    }
    exit;
}
