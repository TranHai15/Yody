<?php
//  kiem tra xem phuong thuc gui la phuong thuc nao

function isGet()
{
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        return true;
    } else {
        return false;
    }
}
function View($past, $view, $data = [])
{
    extract($data);
    require_once "$past/$view.php";
}

function isPost()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        return true;
    } else {
        return false;
    }
}
// kiem tra phan quyen


function isEmpty($value)
{
    // Kiểm tra nếu giá trị không rỗng và độ dài lớn hơn 6 ký tự
    if (!empty($value) && strlen($value) > 6) {
        return true;
    } else {
        return false;
    }
}

function checkloi($data)
{
    echo "<pre>";
    var_dump($data);
    echo "</pre>";
    die;
}

// 

// ham loc du lieu dau vao va xu ly
function filter()
{
    $array = [];
    if (isGet()) {
        foreach ($_GET as $key => $value) {
            $array[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
        }
    }
    if (isPost()) {
        foreach ($_POST as $key => $value) {
            $array[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
        }
    }
    return $array;
}

function isNumber($number)
{
    // loc du lieu xem no co phai kieu so nguyen ko
    $checkNumber = filter_var($number, FILTER_VALIDATE_INT);
    return $checkNumber;
}
// ham kiem tra so thuc
function isFloat($float)
{
    $checkFloat = filter_var($float, FILTER_VALIDATE_FLOAT);
    return $checkFloat;
}



function setsession($key, $value)
{
    //khoi tao session va gan gia tri cho no
    $_SESSION[$key] = $value;
}

// ham doc thong bao

function getsession($key)
{
    // kiem tra xem co ton tai session hay ko
    if (isset($_SESSION[$key])) {
        $value = $_SESSION[$key]; //gan vao mot bien de luu tru gia tri lai 1 lan
        unset($_SESSION[$key]); // Xóa thông báo sau khi lấy để chỉ hiển thị một lần
        return $value; // tra ve lai ket qua da gan truoc do
    } else {
        return null;
    }
}

function showNotification($sessionKey)
{
    if (isset($_SESSION[$sessionKey])) {
        $message = $_SESSION[$sessionKey];
        unset($_SESSION[$sessionKey]); // Xóa thông báo sau khi hiển thị
        echo "
        <section class='notification'>
            <div>
                <p>{$message}</p>
            </div>
        </section>
        ";
    }
}

function replaceSpacesWithHyphen($string)
{
    // Loại bỏ dấu tiếng Việt
    $vietnameseChars = [
        'à',
        'á',
        'ạ',
        'ả',
        'ã',
        'â',
        'ầ',
        'ấ',
        'ậ',
        'ẩ',
        'ẫ',
        'ă',
        'ằ',
        'ắ',
        'ặ',
        'ẳ',
        'ẵ',
        'è',
        'é',
        'ẹ',
        'ẻ',
        'ẽ',
        'ê',
        'ề',
        'ế',
        'ệ',
        'ể',
        'ễ',
        'ì',
        'í',
        'ị',
        'ỉ',
        'ĩ',
        'ò',
        'ó',
        'ọ',
        'ỏ',
        'õ',
        'ô',
        'ồ',
        'ố',
        'ộ',
        'ổ',
        'ỗ',
        'ơ',
        'ờ',
        'ớ',
        'ợ',
        'ở',
        'ỡ',
        'ù',
        'ú',
        'ụ',
        'ủ',
        'ũ',
        'ư',
        'ừ',
        'ứ',
        'ự',
        'ử',
        'ữ',
        'ỳ',
        'ý',
        'ỵ',
        'ỷ',
        'ỹ',
        'đ',
        'À',
        'Á',
        'Ạ',
        'Ả',
        'Ã',
        'Â',
        'Ầ',
        'Ấ',
        'Ậ',
        'Ẩ',
        'Ẫ',
        'Ă',
        'Ằ',
        'Ắ',
        'Ặ',
        'Ẳ',
        'Ẵ',
        'È',
        'É',
        'Ẹ',
        'Ẻ',
        'Ẽ',
        'Ê',
        'Ề',
        'Ế',
        'Ệ',
        'Ể',
        'Ễ',
        'Ì',
        'Í',
        'Ị',
        'Ỉ',
        'Ĩ',
        'Ò',
        'Ó',
        'Ọ',
        'Ỏ',
        'Õ',
        'Ô',
        'Ồ',
        'Ố',
        'Ộ',
        'Ổ',
        'Ỗ',
        'Ơ',
        'Ờ',
        'Ớ',
        'Ợ',
        'Ở',
        'Ỡ',
        'Ù',
        'Ú',
        'Ụ',
        'Ủ',
        'Ũ',
        'Ư',
        'Ừ',
        'Ứ',
        'Ự',
        'Ử',
        'Ữ',
        'Ỳ',
        'Ý',
        'Ỵ',
        'Ỷ',
        'Ỹ',
        'Đ'
    ];

    $latinChars = [
        'a',
        'a',
        'a',
        'a',
        'a',
        'a',
        'a',
        'a',
        'a',
        'a',
        'a',
        'a',
        'a',
        'a',
        'a',
        'a',
        'a',
        'e',
        'e',
        'e',
        'e',
        'e',
        'e',
        'e',
        'e',
        'e',
        'e',
        'e',
        'i',
        'i',
        'i',
        'i',
        'i',
        'o',
        'o',
        'o',
        'o',
        'o',
        'o',
        'o',
        'o',
        'o',
        'o',
        'o',
        'o',
        'o',
        'o',
        'o',
        'o',
        'o',
        'u',
        'u',
        'u',
        'u',
        'u',
        'u',
        'u',
        'u',
        'u',
        'u',
        'u',
        'y',
        'y',
        'y',
        'y',
        'y',
        'd',
        'A',
        'A',
        'A',
        'A',
        'A',
        'A',
        'A',
        'A',
        'A',
        'A',
        'A',
        'A',
        'A',
        'A',
        'A',
        'A',
        'A',
        'E',
        'E',
        'E',
        'E',
        'E',
        'E',
        'E',
        'E',
        'E',
        'E',
        'E',
        'I',
        'I',
        'I',
        'I',
        'I',
        'O',
        'O',
        'O',
        'O',
        'O',
        'O',
        'O',
        'O',
        'O',
        'O',
        'O',
        'O',
        'O',
        'O',
        'O',
        'O',
        'O',
        'U',
        'U',
        'U',
        'U',
        'U',
        'U',
        'U',
        'U',
        'U',
        'U',
        'U',
        'Y',
        'Y',
        'Y',
        'Y',
        'Y',
        'D'
    ];

    $string = str_replace($vietnameseChars, $latinChars, $string);

    // Chuyển chuỗi về chữ thường
    $string = strtolower($string);

    // Tách chuỗi thành mảng các từ
    $wordsArray = explode(" ", $string);

    // Nối các từ với dấu gạch ngang
    $hyphenatedString = implode("-", $wordsArray);

    return $hyphenatedString;
}

// kiem tra so dien thoai

function isPhone($phone)
{
    $checkZero = false;
    if ($phone[0] == '0') {
        $checkZero = true;
        $phone = substr($phone, 1);
    }
    $checkNumber = false;
    if (isNumber($phone) && (strlen($phone) == 9)) {
        $checkNumber = true;
    }
    if ($checkZero && $checkNumber) {
        return true;
    }
    return false;
}




//ham, chay cau truy van
// Hàm thực thi câu lệnh SQL
function query($sql, $data = [], $check = false)
{
    // Kết nối với cơ sở dữ liệu
    $pdo = Connect();
    $result = '';

    try {
        // Chuẩn bị câu lệnh truy vấn
        $stmt = $pdo->prepare($sql);

        // Thực thi câu lệnh
        if (!empty($data)) {
            $result = $stmt->execute($data);
        } else {
            $result = $stmt->execute();
        }
    } catch (PDOException $e) {
        // Hiển thị thông báo lỗi chi tiết
        echo "Lỗi: " . $e->getMessage() . "<br>";
        // echo "Dòng: " . $e->getLine() . "<br>";
        // echo "Tập tin: " . $e->getFile() . "<br>";
        // echo "Mã lỗi: " . $e->getCode() . "<br>";
        return false;
    }

    // Trả về đối tượng nếu $check là true
    if ($check) {
        return $stmt;
    }

    return $result;
}


// kiem tra email
function isEmail($email)
{
    $checkEmail = filter_var($email, FILTER_VALIDATE_EMAIL);
    return $checkEmail;
}

// ham loia bo khoang trang de validate

function removespace($strings)
{
    // Loại bỏ khoảng trắng ở đầu và cuối chuỗi
    $string = trim($strings);
    // Loại bỏ tất cả các khoảng trắng trong chuỗi
    $stingnospace = preg_replace('/\s+/', '', $string);
    return $stingnospace;
}

// ham insert into 
function insert($table, $data)
{

    //lay ra ca tu khoa ki cua mang
    $keys = array_keys($data);
    // noi cac tu khoa key lai thanh mot mang
    $truong = implode(",", $keys);
    // cung noi nhung them dau  ,:
    $value = ":" . implode(',:', $keys);
    // cau lenh truy van

    $sql = "INSERT INTO  $table ( $truong )VALUES( $value )";
    $kq = query($sql, $data);

    return $kq;
}
function insertWhere($table, $data, $dk)
{

    //lay ra ca tu khoa ki cua mang
    $keys = array_keys($data);
    // noi cac tu khoa key lai thanh mot mang
    $truong = implode(",", $keys);
    // cung noi nhung them dau  ,:
    $value = ":" . implode(',:', $keys);
    // cau lenh truy van

    $sql = "INSERT INTO  $table ( $truong )VALUES( $value ) WHERE $dk";
    $kq = query($sql, $data);

    return $kq;
}

// ham update

function update($table, $data, $dieukien = "")
{
    $update = ' ';
    foreach ($data as $key => $value) {
        $update .= $key . '= :' . $key . ',';
    }
    $update = trim($update, ',');

    if (!empty($dieukien)) {
        $sql = 'UPDATE ' . $table . ' SET ' . $update . ' WHERE ' . $dieukien;
    } else {
        $sql = 'UPDATE ' . $table . ' SET ' . $update;
    }

    $kq = query($sql, $data);
    return $kq;
}


// ham xoa delete
function delete($table, $dieukien)
{
    if (!empty($dieukien)) {
        $sql = 'DELETE FROM ' . $table . ' WHERE ' . $dieukien;
    } else {
        $sql = 'DELETE FROM ' . $table;
    }
    $kq = query($sql);
    return $kq;
}

// lay nhieu dong du lieu

function getRaw($sql)
{
    $kq = query($sql, [], true);
    if (is_object($kq)) {
        $data = $kq->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
}


// ham lay mot dong du lieu
function getOne($sql)
{
    $kq = query($sql, [], true);
    if (is_object($kq)) {
        $data = $kq->fetch(PDO::FETCH_ASSOC);
        return $data;
    }
}

// dem so dong du lieu

function getRows($sql)
{
    $kq = query($sql, [], true);
    if (!empty($kq)) {
        return $kq->rowCount();
    }
}


// lay du lieu va dem dong 
function get_user_data($email, $check = 0)
{
    $pdo = Connect();
    $sql = "SELECT * FROM users WHERE email=:email";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();
    if ($check === 0) {
        return $stmt->rowCount();
    } else {
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

// kiem tra mat khau nhap vao =va ma hoa mat khau vao dataabae

function password_hasd_check($passwordinput, $email)
{
    $pass = get_user_data($email, 33);

    if (!$pass || !isset($pass['password'])) {
        return false; // Trả về false nếu không tìm thấy người dùng hoặc không có mật khẩu
    }

    $password = $pass['password'];
    return password_verify($passwordinput, $password);
}

function xuLyUploadFile($file, $thuMucLuu = 'Image/', $duongDanMacDinh = null)
{
    // Kiểm tra xem file có được tải lên không
    if (isset($file) && $file['size'] > 0) {
        // Đảm bảo thư mục lưu trữ tồn tại
        if (!is_dir($thuMucLuu)) {
            mkdir($thuMucLuu, 0777, true);
        }

        $duongDanFile = $thuMucLuu . '/' . basename($file['name']);

        // Di chuyển file vào thư mục đích
        if (move_uploaded_file($file['tmp_name'], $duongDanFile)) {
            return $duongDanFile; // Trả về đường dẫn của file vừa upload
        } else {
            echo "Có lỗi xảy ra khi upload file.";
            return null;
        }
    } else {
        // Nếu không có file mới, trả về đường dẫn mặc định
        return $duongDanMacDinh;
    }
}