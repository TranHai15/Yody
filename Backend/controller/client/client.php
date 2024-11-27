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

        $slides =  $Client->get_Slide_Imgs();
        // $slides =  $Client->get_Slide_Imgs();

        View(FRONTEND__CLIENT, $file, ["slides" => $slides, "TopProduct" => $TopProduct]);
    }


    public function detail($file = "detail")
    {
        $idVariation = $_GET['color'] ?? "";
        $Client = new Model_Client;
        $OneVariations = $Client->getAllVariationsWhereProductIdWhereVariationId($idVariation);
        $productId = $OneVariations['productId'];
        $AllVariation = $Client->getAllVariationWhereProductId($productId);
        $AllSize = $Client->getAllSizeWhereProductIdWhereVariationId($idVariation);
        $AllImage = $Client->getAllImageWhereProductIdWhereVariationId($idVariation);
        // checkloi($OneVariations);
        // checkloi($OneVariations['productId']);


        View(
            FRONTEND__CLIENT,

            $file,
            [
                "OneVariations" => $OneVariations,
                "AllImage" => $AllImage,
                "AllSize" => $AllSize,
                "AllVariation" => $AllVariation,
            ]
        );
    }

    public function search($file = "category")
    {
        $search = trim(htmlspecialchars($_GET['sr'] ?? ""));

        $kq = (new Model_Client)->searchProducts($search);


        // checkloi($kq);
        View(FRONTEND__CLIENT, $file, ["search" => $search, "kq" => $kq]);
    }
    public function locCategory($file = 'category'){
        $id = $_GET['id'] ?? '';
        $kq = (new Model_Client)->categoryLoc($id);

        View(FRONTEND__CLIENT, $file, ["kq" => $kq]);
    }

    public function dodulieuraCart($file = 'cart')
    {

        $giohang = new Model_Client;
        $id = $_GET['id'] ?? "";
        $cartId = $giohang->getRaCartIdTrongCart($id);
        $dulieu = $giohang->getCartItemsWithProductName($cartId['cartid']);
        // checkloi($cartId);
        $tongTienPhaiTra = $giohang->tongtienTrongtotal_price();
        View(FRONTEND__CLIENT, $file, ["cartId" => $cartId, "dulieu" => $dulieu, "tongTienPhaiTra" => $tongTienPhaiTra]);
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

    // 
    public function productView()
    {
        // checkloi($_POST);
    
        if (isPost()) {
            $data = filter();
            // checkloi($data);
    
            // Lấy các giá trị từ form
            $productId = trim($data['productId'] ?? '');
            $userId = trim($data['userId'] ?? '');
            $content = trim($data['content'] ?? '');
            $rating = intval($data['rating'] ?? 0);
            $file_anh = $_FILES['image'] ?? null;
            $createAt = date('Y-m-d H:i:s'); // Lấy thời gian hiện tại
            $image_new = '';
    
            // Xử lý upload file ảnh nếu có
            if (!empty($file_anh) && $file_anh['error'] === 0) {
                $image_new = xuLyUploadFile($file_anh, 'Image/comments');
            }
    
            // Kiểm tra dữ liệu hợp lệ
            // if (strlen(removespace($content)) === 0) {
            //     setsession('errorContent', 'Nội dung không được để trống.');
            //     header('Location: /Yody/admin?AddComment');
            //     exit;
            // }
    
            // if ($rating < 1 || $rating > 5) {
            //     setsession('errorRating', 'Đánh giá phải nằm trong khoảng từ 1 đến 5.');
            //     header('Location: /Yody/admin?AddComment');
            //     exit;
            // }
    
            // Chuẩn bị dữ liệu để chèn vào database
            $data_new = [
                'productId' => $productId,
                'userId' => $userId,
                'content' => $content,
                'image' => $image_new,
                'createAt' => $createAt,
                'rating' => $rating,
            ];
        
            

    
            // Thêm dữ liệu vào bảng comments
            $kq = (new Model_Client)->rateProduct('comments', $data_new);
            checkloi($kq);
    
            if ($kq) {
                setsession('messageDuyetComment', "Thêm bình luận thành công.");
            } else {
                setsession('messageDuyetComment', "Thêm bình luận thất bại.");
            }
    
            // Điều hướng sau khi hoàn thành
            header('Location: /Yody/');
            exit;
        }
    }
    
    
}


