<?php
require_once("Backend/common/pdo.php");
require_once("Backend/common/function.php");
require_once("Backend/model/client/client.php");



ob_start();
class Controller_Client
{
    public function Header($file = "header")
    {
        $Client = new Model_Client;
        // // lay toàn bộ category
        $category = $Client->getAllCategories();
        // var_dump($category)
        // var_dump($category)
        // lấy toàn bộ child category
        $child = $Client->getAllChildCategories();
        // lấy toàn bộ common category
        $common = $Client->getAllCommonCategories();


        View(FRONTEND, $file, [
            "category" => $category,
            "child" => $child,
            "common" => $common,
        ]);
    }
    public function List($file = "Home")
    {
        $Client = new Model_Client;
        $TopProduct = $Client->getAllProducts();
        // $TopProduct = $Client->getAllProducts();
        $getAllSp = $Client->getAll();
        // checkloi($getAllSp);
        $slides =  $Client->get_Slide_Imgs();
        // $slides =  $Client->get_Slide_Imgs();

        View(FRONTEND__CLIENT, $file, ["slides" => $slides, "TopProduct" => $TopProduct, "getAllSp" => $getAllSp]);
    }


    public function detail($file = "detail")
    {
        $idVariation = $_GET['color'] ?? "";
        $Client = new Model_Client;
        $idProduct = $Client->viewProduct($idVariation);
        // checkloi($idProduct);
        $Client->updateViewProduct($idProduct['productId']);
        $OneVariations = $Client->getAllVariationsWhereProductIdWhereVariationId($idVariation);
        $productId = $OneVariations['productId'];
        $AllVariation = $Client->getAllVariationWhereProductId($productId);
        $AllSize = $Client->getAllSizeWhereProductIdWhereVariationId($idVariation);
        $AllImage = $Client->getAllImageWhereProductIdWhereVariationId($idVariation);
        $TopProduct = $Client->get4productsWhereViewDesc();
        $category = $Client->getAllCategories();
        // var_dump($category)
        // var_dump($category)
        // lấy toàn bộ child category
        $child = $Client->getAllChildCategories();
        // checkloi($OneVariations);
        // checkloi($OneVariations['productId']);

        $comment = $Client->getAllCommentWhereProductId($productId);
        // checkloi($comment);
        View(
            FRONTEND__CLIENT,

            $file,
            [
                "OneVariations" => $OneVariations,
                "AllImage" => $AllImage,
                "AllSize" => $AllSize,
                "AllVariation" => $AllVariation,
                "category" => $category,
                "child" => $child,
                "TopProduct" => $TopProduct,
                "comment" => $comment
            ]
        );
    }

    public function search($file = "category")
    {
        $search = trim(htmlspecialchars($_GET['sr'] ?? ""));

        $kq = (new Model_Client)->searchProducts($search);
        $category = (new Model_Client)->getAllCategories();

        // checkloi($kq);
        View(FRONTEND__CLIENT, $file, ["search" => $search, "kq" => $kq,  "category" => $category]);
    }
    public function locCategory($file = 'category')
    {
        $id = $_GET['id'] ?? '';
        $kq = (new Model_Client)->categoryLoc($id);
        $category = (new Model_Client)->getAllCategories();
        View(FRONTEND__CLIENT, $file, ["kq" => $kq, "category" => $category]);
    }

    public function dodulieuraCart($file = 'cart')
    {

        $giohang = new Model_Client;
        $id = $_GET['id'] ?? "";
        if ($id === 'vodanh') {
            $cartId = [];
            $dulieu = [];
            $tongTienPhaiTra = ['total' => null];
            View(FRONTEND__CLIENT, $file, ["cartId" => $cartId, "dulieu" => $dulieu, "tongTienPhaiTra" => $tongTienPhaiTra]);
        }
        $cartId = $giohang->getRaCartIdTrongCart($id);
        $dulieu = $giohang->getCartItemsWithProductName($cartId['cartid']);
        // checkloi($cartId);
        $tongTienPhaiTra = $giohang->tongtienTrongtotal_price($cartId['cartid']);
        View(FRONTEND__CLIENT, $file, ["cartId" => $cartId, "dulieu" => $dulieu, "tongTienPhaiTra" => $tongTienPhaiTra]);
    }
    public function dodulieuraPay($file = 'pay')
    {
        $giohang = new Model_Client;
        $id = $_GET['id'] ?? "";
        $cartId = $giohang->getRaCartIdTrongCart($id);
        $dulieu = $giohang->getCartItemsWithProductNameId($cartId['cartid']);
        // checkloi($cartId);
        $tongTienPhaiTra = $giohang->tongtienTrongtotal_price($cartId['cartid']);
        $dataAllProvince = $giohang->getAllProvince();
        View(FRONTEND__CLIENT, $file, ["cartId" => $cartId, "dulieu" => $dulieu, "tongTienPhaiTra" => $tongTienPhaiTra, 'dataAllProvince' => $dataAllProvince]);
    }
    public function register()
    {
        if (isPost()) {
            $data = filter();
            // var_dump($data);
            $name = removespace($data['userName']);
            $email = removespace($data['email']);
            $pass = removespace($data['password']);
            // var_dump($name, $email, $pass);

            // kiểm tra tên có hợp lệ không
            $check_name = isEmpty($data['userName']);
            $check_email = isEmail($data['email']);
            $check_pass = isEmpty($data['password']);

            $check_ton_tai = get_user_data($email);

            // var_dump($check_ton_tai);
            if ($check_ton_tai > 0) {
                setsession('errorEmail', 'Email đã tồn tại');
                View(FRONTEND__CLIENT, "register", []);
            } else {

                if ($check_name) {
                    setsession('oldname', value: $name);
                    if ($check_email) {
                        setsession('oldemail', value: $email);
                        if ($check_pass) {
                            // thêm dữ liệu vào database
                            $pass = password_hash($pass, PASSWORD_DEFAULT);
                            $active = 1;
                            $role = 0;
                            $data_user = [
                                'name' => $name,
                                'email' => $email,
                                'password' => $pass,
                                'avata' => "https://i.pinimg.com/736x/e6/bc/04/e6bc0435c6f92265c1de8697b17a521f.jpg",
                                'active' => $active,
                                'createAt' => (date('Y-m-d H:i:s')),
                                'role' => $role,
                            ];

                            $ketQua = insert('users',  $data_user);

                            View(FRONTEND__CLIENT, 'login', []);

                            if ($ketQua) {
                                setsession('acount', 'Tạo tài khoản thành công');
                            } else {
                                setsession('acount',  'Tạo tài khoản thất bại');
                            }
                        } else {
                            setsession('errorPass',  "Mật khẩu phải dài hơn 6 kí tự");
                        }
                    } else {
                        setsession('errorEmail',  'Email không đúng định dạng');
                    }
                } else {
                    setsession('errorName',  'Tên phải dài hơn 6 kí tự');
                }
                View(FRONTEND__CLIENT, 'register', []);
            }
        }
    }

    public function login()
    {
        if (isPost()) {
            $data = filter();
            // var_dump($data);
            $email = removespace($data['email']);
            $pass = removespace($data['password']);
            // var_dump($name, $email, $pass);

            // kiểm tra tên có hợp lệ không
            $check_email = isEmail($data['email']);
            $check_pass = isEmpty($data['password']);

            $check_ton_tai = get_user_data($email);

            // var_dump($check_ton_tai);
            if ($check_ton_tai < 0) {
                setsession('errorEmail', 'Email không tồn tại');
                View(FRONTEND__CLIENT, "login", []);
            } else {
                if ($check_email) {
                    setsession("login__email", $email);
                    if ($check_pass) {
                        $check_password = password_hasd_check($pass, $email);
                        if ($check_password) {
                            $data__user = get_user_data($email, 77);
                            $name = $data__user['name'];
                            $avata = $data__user['avata'];
                            $role = $data__user['role'];
                            $userId = $data__user['userId'];
                            setsession('nameUser', $name);
                            setsession('avataUser', $avata);
                            setsession('role', $role);
                            setsession('userId', $userId);

                            setsession('loginaccoun', 'Đăng nhập thành công');
                            header(header: 'Location: /Yody/');
                            exit;
                        } else {
                            setsession("login__passwordError", "sai mật khẩu");
                        }
                    } else {
                        setsession("login__emailError", "Email không đúng định dạng");
                    }
                }
                View(FRONTEND__CLIENT, "login", []);
            }
        }
    }

    public function logout()
    {
        session_destroy();
        header('Location: /Yody/');
    }

    public function goiEvent($file = 'event')
    {
        $past = $_GET['name'];
        // checkloi($past);
        $event = new Model_Client;
        $TopProduct = $event->getAllProducts();
        $dulieulayra = $event->goiEventtheoPast($past);
        // checkloi($dulieulayra);
        View(FRONTEND__CLIENT, $file, ['dulieulayra' => $dulieulayra, "TopProduct" => $TopProduct]);
    }

    public function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data)
            )
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        return $result;
    }


    public function order($file = 'message')
    {
        if (isPost()) {
            $data = filter();
            // checkloi($data);
            if (isset($_POST['payUrl']) && $_POST) {
                $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";


                $partnerCode = 'MOMOBKUN20180529';
                $accessKey = 'klm05TvNBzhg7h7j';
                $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
                $orderInfo = "Thanh toán qua MoMo";
                $amount = "10000";
                $orderId = rand(00, 9999);
                $redirectUrl = "http://localhost/Yody/thank";
                $ipnUrl = "http://localhost/Yody/thank";
                $extraData = "";

                $partnerCode = $partnerCode;
                $accessKey = $accessKey;
                $serectkey = $secretKey;
                $orderId = $orderId; // Mã đơn hàng
                $orderInfo = $orderInfo;
                $amount = $amount;
                $ipnUrl = $ipnUrl;
                $redirectUrl = $redirectUrl;
                $extraData = $extraData;

                $requestId = time() . "";
                $requestType = "payWithATM";
                // $extraData = ($_POST["extraData"] ? $_POST["extraData"] : "");
                //before sign HMAC SHA256 signature
                $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
                $signature = hash_hmac("sha256", $rawHash, $serectkey);
                $data = array(
                    'partnerCode' => $partnerCode,
                    'partnerName' => "Test",
                    "storeId" => "MomoTestStore",
                    'requestId' => $requestId,
                    'amount' => $amount,
                    'orderId' => $orderId,
                    'orderInfo' => $orderInfo,
                    'redirectUrl' => $redirectUrl,
                    'ipnUrl' => $ipnUrl,
                    'lang' => 'vi',
                    'extraData' => $extraData,
                    'requestType' => $requestType,
                    'signature' => $signature
                );
                $result = $this->execPostRequest($endpoint, json_encode($data));
                $jsonResult = json_decode($result, true);  // decode json

                //Just a example, please check more in there

                header('Location: ' . $jsonResult['payUrl']);
            } else {
                $userId = $data['userId'];
                $statusId = $data['statusId'];
                $payStatusId = $data['payStatusId'];
                $customer_name = $data['customer_name'];
                $phone_number = $data['phone_number'];
                $email = $data['email'];
                $province_id = $data['province_id'];
                $district = $data['district'];
                $ward = $data['ward'];
                $note = $data['note'];
                $payment_method = $data['payment_method'];
                $street_address = $data['street_address'];
                $sumprice = $data['sumprice'];
                $date = date('Y-m-d H:i:s');

                // checkloi($diachi);
                $address = (new Model_Client)->getAddress($province_id, $district, $ward);
                $xong = $address['Tp'] . ', ' . $address['Huyen'] . ', ' . $address['Xa'] . ', ' . $street_address;
                // checkloi($xong);
                $data_new = [
                    'statusId' => $statusId,
                    'userId' => $userId,
                    'sumprice' => $sumprice,
                    'address' => $xong,
                    'phone' => $phone_number,
                    'payId' => $payment_method,
                    'payStatusId' => $payStatusId,
                    'updateAt' => $date,
                    'createAt' => $date,
                ];
                $sql = "INSERT INTO orders (statusId, userId, sumprice, address, phone, payId, payStatusId, updateAt, createAt)
            VALUES (:statusId, :userId, :sumprice, :address, :phone, :payId, :payStatusId, :updateAt, :createAt)";
                $pdo = Connect();
                // Chuẩn bị statement
                $stmt = $pdo->prepare($sql);

                // Gán giá trị vào các tham số
                $stmt->bindParam(':statusId', $data_new['statusId']);
                $stmt->bindParam(':userId', $data_new['userId']);
                $stmt->bindParam(':sumprice', $data_new['sumprice']);
                $stmt->bindParam(':address', $data_new['address']);
                $stmt->bindParam(':phone', $data_new['phone']);
                $stmt->bindParam(':payId', $data_new['payId']);
                $stmt->bindParam(':payStatusId', $data_new['payStatusId']);
                $stmt->bindParam(':updateAt', $data_new['updateAt']);
                $stmt->bindParam(':createAt', $data_new['createAt']);

                // Thực hiện câu lệnh
                $stmt->execute();

                // Lấy ID của đơn hàng vừa thêm
                $order_id = $pdo->lastInsertId();
                // checkloi($order_id);

                if ($order_id > 0) {
                    $sanpham = (new Model_Client)->getAllcartItemByuserId($userId);
                    // checkloi($sanpham);
                    for ($i = 0; $i < count($sanpham); $i++):

                        $dataNew = [
                            'orderId' => $order_id,
                            'variationId' => $sanpham[$i]['variationId'],
                            'sizeId' => $sanpham[$i]['sizeId'],
                            'quantity' => $sanpham[$i]['quantity'],
                            'price' => $sanpham[$i]['price'],
                        ];
                        $sizeId = $sanpham[$i]['sizeId'];
                        $quantity = $sanpham[$i]['quantity'];
                        // checkloi($quantity);
                        try {
                            // Thêm dữ liệu vào bảng orderitems
                            (new Model_Client)->insertOrderItem('orderitems', $dataNew);
                            (new Model_Client())->deleteQuatitySize($sizeId, $quantity);
                        } catch (Exception $e) {
                            // Nếu có lỗi xảy ra, in ra thông báo lỗi và dừng vòng lặp
                            echo 'Lỗi khi thêm sản phẩm vào đơn hàng: ' . $e->getMessage();
                            break; // Dừng vòng lặp nếu có lỗi
                        }

                    endfor;

                    for ($i = 0; $i < count($sanpham); $i++):
                        $dk =   'cartitemId=' .  $sanpham[$i]['cartitemId'];
                        try {
                            // Thêm dữ liệu vào bảng orderitems
                            delete('cartitems', $dk);
                        } catch (Exception $e) {
                            // Nếu có lỗi xảy ra, in ra thông báo lỗi và dừng vòng lặp
                            echo 'Lỗi khi thêm sản phẩm vào đơn hàng: ' . $e->getMessage();
                            break; // Dừng vòng lặp nếu có lỗi
                        }
                    endfor;
                    $kq = (new Model_Client)->getNumber($userId);
                    $sl = $kq[0]['total_quantity'];
                    // checkloi($sl);
                    // checkloi($sanpham);
                    setsession('order', 'Thanh Toán thành công');
                } else {
                    setsession('order',  'Thanh Toán thất bại');
                }
                View(FRONTEND__CLIENT, $file, ['sl' => $sl]);
            }
        }
    }

    public function getOrder($file = 'history')
    {
        $userId = $_SESSION['userId'];
        // checkloi($userId);
        $giohang = (new Model_Client);
        $dulieulayra = $giohang->getOrdersandOrderItem($userId);
        // checkloi($dulieulayra);
        // checkloi
        View(FRONTEND__CLIENT, $file, ['dulieulayra' => $dulieulayra]);
    }
    public function forgot()
    {
        if (isPost()) {
            $data = filter();
            if ($data['email']) {
                $email = $data['email'];
                $kq = get_user_data($email);
                // checkloi($kq);
                if ($kq === 0) {
                    setsession('forgot', 'Email không tồn tại');
                    View(FRONTEND__CLIENT, 'forgot', []);
                    return;
                }
                $dataUser = get_user_data($email, 999);
                // checkloi($dataUser['userId']);
                $dulieu = [
                    'forgots' => '000000'
                ];
                $upadetForrgot = update('users', $dulieu, "userId=$dataUser[userId]");
                if ($upadetForrgot) {
                    setsession('chaggePassword', 'Vui long nhap Mã đã gửi về Email bạn');
                    setsession('hienthi', 100);
                    View(FRONTEND__CLIENT, 'forgot', []);
                } else {
                    setsession('chaggePassword', 'Lỗi Kĩ thuật');
                }
            } else {
                checkloi($data);
            }
        }
    }
}
