<?php
header('Content-Type: application/json');
require_once("../../../config.php");
require_once("../../../Backend/common/pdo.php");
require_once("../../../Backend/common/function.php");
require_once("../../model/admin/admin.php");

if (isset($_GET['payStatus'], $_GET['statusId'], $_GET['orderId'])) {
    $payStatus = $_GET['payStatus'];
    $statusId = $_GET['statusId'];
    $orderId = $_GET['orderId'];
    // echo "thanh cong";

    $data = [
        "payStatusId" => $payStatus,
        "statusId" => $statusId,
        "orderId" => $orderId,
    ];
    $dk = "orderId=" . $orderId;
    $kq = (new Model_Admin)->updateOrder('orders', $data, $dk);
    // $sizeId = $_GET['size'];
    if ($kq) {
        echo json_encode(array('status' => 'success', 'message' => 'Cập nhật thành công'));
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'Cập nhật thất bại'));
    }
}

if (isset($_GET['variationId'])) {
    $variationId = $_GET['variationId'];
    // echo $variationId;

    $dataSize = (new Model_Admin)->getAllSizeVariationByVariationId($variationId);
    $dataImage = (new Model_Admin)->getAllImageVariationByVariationId($variationId);

    if ($dataSize || $dataImage) {
        echo json_encode(array('status' => 'success', 'message' => 'Lấy thành công', "dataSize" => $dataSize, "dataImage" => $dataImage));
    } else {
        echo json_encode(array('status' => 'success', 'message' => 'Chưa có size vui lòng thêm dữ liệu '));
    }
}
if (isset($_GET['deleteVariationId'])) {
    $variationId = $_GET['deleteVariationId'];
    // echo $variationId;
    // die();
    $dk = "variationId=" . $variationId;

    $kq = (new Model_Admin)->DeleteVariation("variations", $dk);

    if ($kq) {
        echo json_encode(array('status' => 'success', 'message' => 'Xóa thành công'));
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'Xóa Không thành công'));
    }
}
if (isset($_GET['addSize'])) {

    $variationId = $_GET['addSize'] ?? "";
    $sizeCode = $_GET['sizeCode'] ? $_GET['sizeCode'] : null;
    $size = $_GET['size'] ? $_GET['size'] : null;
    $quantity = $_GET['soluong'] ? $_GET['soluong'] : null;


    $data__new = [
        "sizeCode" => $sizeCode,
        "size" => $size,
        "quantity" => $quantity,
        "variationId" => $variationId,
    ];
    // checkloi($data__new);

    $kq = (new Model_Admin)->addSize("sizevariations", $data__new);

    if ($kq) {
        echo json_encode(array('status' => 'success', 'message' => 'Thêm thành công'));
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'Thêm Không thành công'));
    }
}



// +++++++++++++++++++++++

if (isset($_POST) && isset($_FILES['images'])) {
    // Kiểm tra xem có tệp nào được gửi không
    if (!isset($_FILES['images']) || empty($_FILES['images']['name'][0])) {
        $response['status'] = 'error';
        $response['message'] = 'Không có tệp nào được tải lên';
        echo json_encode($response);
        exit;
    }

    $totalFiles = count($_FILES['images']['tmp_name']);

    // Kiểm tra nếu số lượng tệp vượt quá 4
    if ($totalFiles > 7) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Bạn chỉ có thể tải lên tối đa 4 hình ảnh mỗi lần'
        ]);
        exit; // Dừng xử lý
    }

    $variationId = $_POST['variationId'] ?? '';
    $uploadedFilesData = []; // Mảng chứa dữ liệu các tệp đã tải lên

    foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
        $fileName = $_FILES['images']['name'][$key];
        $fileType = $_FILES['images']['type'][$key];
        $fileTmpName = $_FILES['images']['tmp_name'][$key];
        $fileError = $_FILES['images']['error'][$key];
        $fileSize = $_FILES['images']['size'][$key];

        // Kiểm tra lỗi tệp
        if ($fileError !== UPLOAD_ERR_OK) {
            $response['status'] = 'error';
            $response['message'] = "Lỗi khi tải lên tệp: $fileName";
            echo json_encode($response);
            exit;
        }

        // Kiểm tra định dạng tệp
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        if (!in_array($fileType, $allowedTypes)) {
            $response['status'] = 'error';
            $response['message'] = "Tệp không hợp lệ: $fileName. Chỉ hỗ trợ JPEG, PNG, GIF.";
            echo json_encode($response);
            exit;
        }

        // Tạo đường dẫn lưu trữ tệp
        $uploadDir = '../../../Image/variationImage/';

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true); // Tạo thư mục nếu chưa tồn tại
        }
        $newFilePath = $uploadDir . basename($fileName);

        // Di chuyển tệp đến thư mục đích
        if (move_uploaded_file($fileTmpName, $newFilePath)) {
            $cleanedPath = $imagePath = str_replace("../../../", "", $newFilePath);
            // Tạo mảng dữ liệu cho tệp hiện tại
            $uploadedFilesData[] = [
                'image' => $cleanedPath,
                'variationId' => $variationId, // Thêm variationId nếu cần
            ];

            // Gọi hàm insert vào database
            $kq = (new Model_Admin)->addImageVariation('variationimages', $uploadedFilesData[$key]);

            // Kiểm tra kết quả trả về từ insert
            if (!$kq) {
                $response['status'] = 'error';
                $response['message'] = "Không thể lưu dữ liệu vào cơ sở dữ liệu cho tệp: $fileName";
                echo json_encode($response);
                exit;
            }
        } else {
            $response['status'] = 'error';
            $response['message'] = "Không thể lưu tệp: $fileName";
            echo json_encode($response);
            exit;
        }
    }

    // Phản hồi thành công
    $response['message'] = 'Tất cả tệp đã được tải lên và lưu vào database thành công';
    echo json_encode($response);
    exit;
}

// ++++++++++++++++

if (isset($_GET['deleteSizeVariation'])) {
    $sizeId = $_GET['deleteSizeVariation'] ?? "";
    $dk = "sizeId=" . $sizeId;

    $kq = (new Model_Admin)->DeleteSize("sizevariations", $dk);

    if ($kq) {
        echo json_encode(array('status' => 'success', 'message' => 'Xóa thành công'));
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'Xóa Không thành công'));
    }
}
if (isset($_GET['DeleteImageVariation'])) {
    $sizeId = $_GET['DeleteImageVariation'] ?? "";
    $dk = "variationimageId=" . $sizeId;

    $kq = (new Model_Admin)->DeleteImageVariation("variationimages", $dk);

    if ($kq) {
        echo json_encode(array('status' => 'success', 'message' => 'Xóa thành công'));
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'Xóa Không thành công'));
    }
}
