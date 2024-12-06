<?php
// Trả về JSON
header('Content-Type: application/json');
require_once("../../../config.php");
require_once("../../../Backend/common/pdo.php");
require_once("../../../Backend/common/function.php");
require_once("../../model/admin/admin.php");
require_once("../../model/client/client.php");

$data = json_decode(file_get_contents("php://input"), true); // Đọc dữ liệu JSON từ body

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy dữ liệu orderItemId và lý do từ JSON
    $orderItemId = (int)$data['orderItemId']; // Lấy orderItemId
    $reason = $data['reason']; // Lý do hủy
    // checkloi($orderItemId);
    if ($orderItemId && $reason) {
        // Kiểm tra và thực hiện xử lý hủy mặt hàng
        // Ví dụ: gọi hàm hủy mặt hàng trong DB
        $gioHang = new Model_Client;
        $result = $gioHang->cancelOrderItem($orderItemId, $reason);
        $gioHang->UpdateQuantitykhihuydonhang($orderItemId);

        // checkloi($result);
        if ($result) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Không thể hủy mặt hàng']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Dữ liệu không hợp lệ']);
    }
}
