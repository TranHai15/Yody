<?php
require_once("Backend/common/pdo.php");
require_once("Backend/common/function.php");
require_once("Backend/model/client/client.php");
require_once("Backend/model/admin/admin.php");



class Controller__Admin
{
    public function List($file = "index")
    {
        $Admin = new Model_Admin;
        // $dataAllUser = $Admin->getAllUsers();

        View(FRONTEND__ADMIN, $file, []);
    }
    public function account($file = "account")
    {
        $idUser = $_GET['EditAccount'] ?? '';
        $Admin = new Model_Admin;

        $dataAllUser = $Admin->getAllUsers();
        $dataOneUser = $Admin->getOneUserById($idUser);

        View(FRONTEND__ADMIN, $file, ["dataAllUser" => $dataAllUser, "dataOneUser" => $dataOneUser]);
    }
    public function updateUser()
    {
        if (isPost()) {
            $data = filter();
            $userId = $data['userId'];
            $avata = $data['avata'];
            $active = $data['active'];
            $createAt = $data['createAt'];
            $role = $data['role'];
            $name = removespace($data['name']);
            $email = removespace($data['email']);
            $pass = removespace($data['password']);

            // Kiểm tra dữ liệu
            $check_name = isEmpty($data['name']);
            $check_email = isEmail($data['email']);
            $check_pass = isEmpty($data['password']);
            // Lấy file avatar mới
            $avata__new = $_FILES['avata'];
            // Xử lý upload file, hoặc giữ nguyên nếu không có file mới
            $duliue = xuLyUploadFile($avata__new, 'Image/user', $data['avata']);
            if ($check_email) {
                if ($check_name) {
                    if ($check_pass) {
                        $password = password_hash($pass, PASSWORD_DEFAULT);
                        $data_user_new = [
                            'name' => $name,
                            'email' => $email,
                            'password' => $password,
                            'avata' => $duliue,
                            'active' => $active,
                            'createAt' => (date('Y-m-d H:i:s')),
                            'role' => 0,
                        ];

                        $dieukien = "userId=" . $userId;
                        $ketqua = (new Model_Admin())->updateOneUserWhereById('users', $data_user_new, $dieukien);
                        // checkloi($ketqua);
                        if ($ketqua) {
                            // checkloi($data_user_new);
                            setsession('messageEditUser', "Cập nhật thành công");
                            header('Location: /Yody/admin?Account');
                            exit;
                        } else {
                            setsession('messageEditUser', "Cập nhật thất bại");
                            header('Location: /Yody/admin?EditAccount=' . $userId);
                            exit;
                        }
                    } else {
                        setsession('editUserPassword', 'Vui long nhap password > 6 ki tu');
                    }
                } else {
                    setsession('editUserName', 'Vui long nhap name > 6 ki tu');
                }
            } else {
                setsession('editUserEmail', 'Không đúng định dạng email');
            }
            header('Location: /Yody/admin?EditAccount=' . $userId);
            exit;
        }
    }
    public function addUser()
    {
        if (isPost()) {
            $data = filter();
            $avata = $data['avata'];
            $active = $data['active'];
            $createAt = $data['createAt'];
            $role = $data['role'];
            $name = removespace($data['name']);
            $email = removespace($data['email']);
            $pass = removespace($data['password']);

            // Kiểm tra dữ liệu
            $check_name = isEmpty($data['name']);
            $check_email = isEmail($data['email']);
            $check_pass = isEmpty($data['password']);
            // Lấy file avatar mới
            $avata__new = $_FILES['avata'];
            // Xử lý upload file, hoặc giữ nguyên nếu không có file mới
            $duliue = xuLyUploadFile($avata__new, 'Image/user', $data['avata']);

            $check_ton_tai = get_user_data($email);
            // checkloi($check_ton_tai);
            // var_dump($check_ton_tai);
            if ($check_ton_tai > 0) {
                setsession('errorEmailAddUser', 'Email đã tồn tại');
                header('Location: /Yody/admin?AddAccount');
            } else {
                if ($check_email) {
                    setsession('email__addUser', $email);
                    if ($check_name) {
                        setsession('name__addUser', $name);
                        if ($check_pass) {
                            $password = password_hash($pass, PASSWORD_DEFAULT);
                            $data_user_new = [
                                'name' => $name,
                                'email' => $email,
                                'password' => $password,
                                'avata' => $duliue,
                                'active' => $active,
                                'createAt' => (date('Y-m-d H:i:s')),
                                'role' => $role,
                            ];


                            $ketqua = (new Model_Admin)->addOneUser('users', $data_user_new);
                            if ($ketqua === true) {

                                setsession('messageAddUser', "Thêm thành công");
                                header('Location: /Yody/admin?Account');
                                exit;
                            } else {
                                setsession('messageAddUser', "Thêm thất bại");
                                header('Location: /Yody/admin?AddAccount=');
                                exit;
                            }
                        } else {
                            setsession('addUserPassword', 'Vui long nhap password > 6 ki tu');
                        }
                    } else {
                        setsession('addUserName', 'Vui long nhap name > 6 ki tu');
                    }
                } else {
                    setsession('addtUserEmail', 'Không đúng định dạng email');
                }
            }
            header('Location: /Yody/admin?AddAccount');
            exit;
        }
    }

    public function deleteUser()
    {
        $idUser = $_GET['DeleteAccount'] ?? '';
        $dk = "userId=" . $idUser;
        $ketqua = delete('users', $dk);
        if ($ketqua === true) {
            setsession('messageDeleteUser', 'Xoa Thành Công');
        } else {
            setsession('messageDeleteUser', 'Xoa Thất Bại');
        }
        header('Location: /Yody/admin?Account');
        exit;
    }
    // *******************************************************************************************
    // ***************************************SLIDES**********************************************
    // *******************************************************************************************

    public function Slide($file = "slides")
    {
        $Admin = new Model_Admin;
        // $dataAllUser = $Admin->getAllUsers();
        $slide = $Admin->get_All_Slide();
        View(FRONTEND__ADMIN, $file, ["slide" => $slide]);
    }

    public function addSlide()
    {
        // if (isPost()) {
        //     $data = $_POST;
        //     $anh = "";
        //     $file_anh = $_FILES['url'];
        //     //Kiem tra xem admin co upload hay k neu co thi tien hanh insert
        //     if ($file_anh['size'] > 0) {
        //         $anh = "Image/Sliders/" . $file_anh['name'];
        //         //di chuyen anh den thu muc image
        //         move_uploaded_file($file_anh['tmp_name'], $anh);
        //     }
        //     $data['url'] = $anh;
        //     (new Model_Admin)->addSlide('Slides', $data);
        //     header('Location: /Yody/admin?Slides');
        // }
        if (isPost()) {
            $data = $_POST;
            $anh = "";
            $file_anh = $_FILES['url'];
            $error = [];
            if (trim($data['title']) == "") {
                $error['title'] = "Hãy điền thông tin!!";
            }
            if (trim($data['past']) == "") {
                $error['past'] = "Hãy điền thông tin!!";
            }

            if (!empty($error)) {

                // $dataAllUser = $Admin->getAllUsers();

                return   View(FRONTEND__ADMIN, 'addSlide', [
                    'error' => $error,
                    'data' => $data
                ]);
            }
            //Kiem tra xem admin co upload hay k neu co thi tien hanh insert
            if ($file_anh['size'] > 0) {
                $anh = "Image/Sliders/" . $file_anh['name'];
                //di chuyen anh den thu muc image
                move_uploaded_file($file_anh['tmp_name'], $anh);
            }

            $data['url'] = $anh;
            (new Model_Admin)->addSlide('Slides', $data);
            setsession('addSlide', 'Thêm thành công');
            header('Location: /Yody/admin?Slides');
        }
    }
    //Xóa Slide
    public function xoaSlide()
    {
        $idSlide = $_GET['DeleteSlide'] ?? '';
        $dk = "sildeId=" . $idSlide;
        $ketqua = delete('slides', $dk);
        if ($ketqua === true) {
            setsession('deleteSlide', 'xoa thanh cong');
            header("Location:/Yody/admin?Slides ");
        };
    }
    public function SlideId($file = "editSlide")
    {
        $idSlide = $_GET['EditSlide'] ?? "";

        $getAll = (new Model_Admin)->get_All_Slide();
        $getOne = (new Model_Admin)->getOneSlideById($idSlide);

        View(FRONTEND__ADMIN, $file, ["getAll" => $getAll, "getOne" => $getOne]);
    }

    public function UpdateSlide()
    {
        if (isPost()) {
            $data = filter();
            $url = $data['url'];
            $title = $data['title'];
            $past = $data['past'];
            $sildeId = $data['sildeId'];
            $new_url = $_FILES['url'];
            $xulyurl = xuLyUploadFile($new_url, 'Image/Sliders/', $url);
            $new_data = [
                'url' => $xulyurl,
                'title' => $title,
                'past' => $past,
            ];
            $dk = 'sildeId=' . $sildeId;
            $ketqua = (new Model_Admin)->updateOneSlideWhereID('slides', $new_data, $dk);
            if ($ketqua === true) {
                setsession('messageEditSlides', "Cập nhật thành công!");
                header("Location: /Yody/admin?Slides");
                exit;
            } else {
                setsession('messageEditSlides', "Cập nhật không thành công!");
                header("Location: /Yody/admin?Slides");
                exit;
            }
        }
    }



    // **************************************************************************************
    // ****************************************END_SLIDES************************************
    // **************************************************************************************


    // =============== category =====================
    public function Category($file = "category")
    {
        $Client = new Model_Client;
        $category = $Client->getAllCategories();


        $child = $Client->getAllChildCategories();
        // lấy toàn bộ common category
        $common = $Client->getAllCommonCategories();

        View(FRONTEND__ADMIN, $file, [
            "category" => $category,
            "child" => $child,
            "common" => $common,
        ]);
    }

    public function getCategoryById($file = 'editCategory')
    {
        $idCategory = $_GET['EditCategory'] ?? '';
        $getOne = (new Model_Admin)->getOneCategoryById($idCategory);
        View(FRONTEND__ADMIN, $file, ['getOne' => $getOne]);
    }
    // thắng mới làm ============================ 1/12/2024 =============
    public function getChildCategoryById($file = 'editChildCategory')
    {
        $idChildCategory = $_GET['editChildCategory'] ?? '';
        $getOne = (new Model_Admin)->getOneChildCategoryById($idChildCategory);
        View(FRONTEND__ADMIN, $file, ['getOne' => $getOne]);
    }
    // 3/12
    public function getCommontCategory($file = 'editCommoncategorys')
    {
        $idCommentId = $_GET['editCommoncategorys'] ?? '';
        $getOne = (new Model_Admin)->getOneCommontCategoryById($idCommentId);
        View(FRONTEND__ADMIN, $file, ['getOne' => $getOne]);
    }



    public function deleteCategory()
    {
        $categoryId = $_GET['deleteCategory'] ?? '';
        $categoryChildId = $_GET['deleteChildCategory'] ?? '';
        $categoryCommontId = $_GET['deleteCommontCategory'] ?? '';
        // echo $categoryId;
        // echo $categoryChildId;
        // echo $categoryCommontId;
        if ($categoryId != '') {
            $dk = 'categoryId=' . $categoryId;
            $kq = (new Model_Admin)->deleteCategory($dk,);
            if ($kq) {
                setsession('messagedeleteCategory', 'Xóa thành công');
                header('Location: /Yody/admin?Category');
                exit;
            } else {
                setsession('messagedeleteCategory', 'Xóa không thành công');
                header('Location: /Yody/admin?Category');
                exit;
            }
        }
        if ($categoryChildId != '') {
            $dk = 'childId=' . $categoryChildId;
            $kq = (new Model_Admin)->deleteCategory($dk, 1);
            if ($kq) {
                setsession('messagedeleteCategory', 'Xóa thành công');
                header('Location: /Yody/admin?Category');
                exit;
            } else {
                setsession('messagedeleteCategory', 'Xóa không thành công');
                header('Location: /Yody/admin?Category');
                exit;
            }
        }
        if ($categoryCommontId != '') {
            $dk = 'commonId=' . $categoryCommontId;
            $kq = (new Model_Admin)->deleteCategory($dk, 2);
            if ($kq) {
                setsession('messagedeleteCategory', 'Xóa thành công');
                header('Location: /Yody/admin?Category');
                exit;
            } else {
                setsession('messagedeleteCategory', 'Xóa không thành công');
                header('Location: /Yody/admin?Category');
                exit;
            }
        }
    }

    // ============================================== mới làm ===========================
    public function addCategory()
    {
        $data = $_POST;
        $name = trim($data['name']);
        $past = trim($data['past']);
        $file_anh = $_FILES['image'];
        $image__new = '';

        if (!empty($file_anh) && $file_anh['error'] == 0) {
            $image__new = xuLyUploadFile($file_anh, 'Image/category');
        }

        // Validate name and past fields
        if (strlen(removespace($name)) == 0) {
            setsession('errorNameCategory', ' không được để trống.');
            header('Location: /Yody/admin?AddCategory');
            exit;
        }

        if (strlen(removespace($past)) == 0) {
            setsession('errorPassCategory', ' không được để trống.');
            header('Location: /Yody/admin?AddCategory');
            exit;
        }

        // Prepare data for insertion
        $data_new = [
            'name' => $name,
            'past' => $past,
            'image' => $image__new,
        ];

        // Insert data into the database
        $kq = (new Model_Admin)->addCategory('categorys', $data_new);

        if ($kq) {
            setsession('messageDuyetComment', "Thêm thành công");
        } else {
            setsession('messageDuyetComment', "Thêm thất bại");
        }

        // Redirect after completion
        header('Location: /Yody/admin?Category');
        exit;
    }

    // phần cập nhật category
    public function UpdateCategory()
    {
        if (isPost()) {
            $data = $_POST;

            // Lấy dữ liệu từ form
            $name = trim($data['name'] ?? '');
            $past = trim($data['past'] ?? '');
            $categoryId = $data['categoryId'] ?? 0;
            $file_anh = $_FILES['image'] ?? null;
            $image_new = '';
            $getOne = (new Model_Admin)->getOneCategoryById($categoryId);


            // Kiểm tra xem ảnh có được upload hay không
            if (!empty($file_anh) && $file_anh['error'] == 0) {
                $image_new = xuLyUploadFile($file_anh, 'Image/category');
            } else {
                $image_new = $data['image'] ?? ''; // Giữ nguyên ảnh cũ nếu không upload ảnh mới
            }

            // Validate các trường dữ liệu
            if (strlen(removespace($name)) == 0) {
                setsession('errorNameCategory', 'Tên danh mục không được để trống.');
                View(FRONTEND__ADMIN, 'editCategory', ['getOne' => $getOne]);
                exit;
            }

            if (strlen(removespace($past)) == 0) {
                setsession('errorPastCategory', 'Trường "past" không được để trống.');
                View(FRONTEND__ADMIN, 'editCategory', ['getOne' => $getOne]);
                exit;
            }

            if (!is_numeric($categoryId) || $categoryId <= 0) {
                setsession('errorCategoryId', 'ID danh mục không hợp lệ.');
                View(FRONTEND__ADMIN, 'editCategory', ['getOne' => $getOne]);
                exit;
            }

            // Chuẩn bị dữ liệu để cập nhật
            $data_update = [
                'name' => $name,
                'past' => $past,
                'image' => $image_new,
            ];

            // Điều kiện cập nhật
            $condition = 'categoryId=' . (int)$categoryId;

            // Thực hiện cập nhật
            $result = (new Model_Admin)->updateOneCategoryWhereById('categorys', $data_update, $condition);

            if ($result) {
                setsession('messageEditCategory', "Cập nhật thành công.");
            } else {
                setsession('messageEditCategory', "Cập nhật thất bại.");
            }

            // Chuyển hướng sau khi xử lý
            header('Location: /Yody/admin?Category');
            exit;
        }
    }

    public function updateChildCategory()
    {
        if (isPost()) {
            $data = filter();
            $childId = $data['childId'];
            $name = $data['name'];
            $past = $data['past'];
            $new_data = [
                'name' => $name,
                'past' => $past,
            ];
            $dk = 'childId=' . $childId;

            $ketqua = (new Model_Admin)->updateOneChildCategoryWhereById('childcategorys', $new_data, $dk);
            if ($ketqua === true) {
                setsession('messageEditSlides', "Cập nhật thành công!");
                header("Location: /Yody/admin?Category");
                exit;
            } else {
                setsession('messageEditSlides', "Cập nhật không thành công!");
                header("Location: /Yody/admin?Category");
                exit;
            }
        }
    }
    public function updateCommontCategory()
    {
        if (isPost()) {
            $data = filter();
            $name = $data['name'];
            $past = $data['past'];
            $commonId = $data['commonId'];
            $new_data = [
                'name' => $name,
                'past' => $past,
            ];

            $dk = 'commonId=' . $commonId;

            $ketqua = (new Model_Admin)->updateOneCommontCategoryWhereById('commoncategorys', $new_data, $dk);
            if ($ketqua === true) {
                setsession('messageEditSlides', "Cập nhật thành công!");
                header("Location: /Yody/admin?Category");
                exit;
            } else {
                setsession('messageEditSlides', "Cập nhật không thành công!");
                header("Location: /Yody/admin?Category");
                exit;
            }
        }
    }
    public function  headerAddchild()
    {
        $data = filter();
        // checkloi($data/;
        $id = $data['addchild'];
        View(FRONTEND__ADMIN, 'addChildCategory', ['id' => $id]);
    }
    public function  headerAddCommont()
    {
        $data = filter();
        $id = $data['addCommont'];
        View(FRONTEND__ADMIN, 'addCommontCategory', ['id' => $id]);
    }
    // 
    public function addChild()
    {
        $data = filter();
        $name = $data['name'];
        $past = $data['past'];
        $id = $data['categoryId'];

        $data_new = [
            'name' => $name,
            'past' => $past,
            'categoryId' => $id
        ];

        $kq = (new Model_Admin)->addChild('childcategorys', $data_new);
        if ($kq) {
            setsession('messageDuyetComment', "Thêm thành công");
        } else {
            setsession('messageDuyetComment', "Thêm thất bại");
        }

        // Redirect after completion
        header('Location: /Yody/admin?Category');
        exit;
    }
    public function addComment()
    {
        $data = filter();
        $name = $data['name'];
        $past = $data['past'];
        $id = $data['childId'];

        $data_new = [
            'name' => $name,
            'past' => $past,
            'childId' => $id
        ];

        $kq = (new Model_Admin)->addCommont('commoncategorys', $data_new);
        if ($kq) {
            setsession('messageDuyetComment', "Thêm thành công");
        } else {
            setsession('messageDuyetComment', "Thêm thất bại");
        }

        // Redirect after completion
        header('Location: /Yody/admin?Category');
        exit;
    }


    public function Product($file = "products")
    {
        $Admin = new Model_Admin;
        $Client = new Model_Client;
        $category = $Client->getAllCategories();
        $child = $Client->getAllChildCategories();
        $dataAllProduct = $Admin->getAllProducts();
        // $dataAllUser = $Admin->getAllUsers();

        View(FRONTEND__ADMIN, $file, [
            'dataAllProduct' => $dataAllProduct,
            "category" => $category,
            "child" => $child,
        ]);
    }

    public function FilterCategory($file = 'products')
    {
        $Admin = new Model_Admin;
        $id = $_GET['FilterCategory'] ?? "";
        $Client = new Model_Client;
        $category = $Client->getAllCategories();
        $child = $Client->getAllChildCategories();
        $dataAllProduct = $Admin->getAllProductByCategoryId($id);
        View(FRONTEND__ADMIN, $file, [
            'dataAllProduct' => $dataAllProduct,
            "category" => $category,
            "child" => $child,
        ]);
    }

    public function ProductView($file = "viewProduct")
    {
        $Admin = new Model_Admin;
        $id = $_GET['ViewProduct'] ?? "";
        $dataAllVariation = $Admin->getAllVariationByProductId($id);


        View(FRONTEND__ADMIN, $file, [
            'dataAllVariation' => $dataAllVariation,
            'idProduct' => $id
        ]);
    }
    public function addProduct()
    {
        if (isPost()) {
            $data = filter();
            // checkloi($data);
            $name = $data['name'] ?? '';
            $productCode = $data['productCode'] ?? '';
            $categoryId = $data['categoryId'] ?? '';
            $childId = $data['childId'] ?? '';

            $data__new = [
                'name' => $name,
                'productCode' => $productCode,
                'categoryId' => $categoryId,
                'childId' => $childId,
            ];

            // checkloi($data__new);
            $kq = (new Model_Admin)->addProduct('products', $data__new);
            $id = (new Model_Admin)->getproductIdNewByAdd();
            // checkloi($id['maxProductId']);
            $idp = $id['maxProductId'];

            if ($kq) {
                setsession('messageAddProduct', "Thêm thành công");
                header('Location: /Yody/admin?ViewProduct=' . $idp);
            } else {
                setsession('messageAddProduct', "Thêm Khồng thành công");
                header('Location: /Yody/admin?ViewProduct=' . $idp);
            }
        }
    }

    public function deleteProduct()
    {
        $id = $_GET['DeleteProduct'] ?? "";
        $dk = 'productId=' . $id;
        $kq = (new Model_Admin)->xoaProduct("products", $dk);
        if ($kq) {
            setsession('messageDeleteComment', "Xoa thành công");
            header('Location: /Yody/admin?Product');
        } else {
            setsession('messageDeleteComment', "Xoa Khồng thành công");
            header('Location: /Yody/admin?Product');
        }
    }

    public function addVariation()
    {


        // Kiểm tra và xử lý dữ liệu
        $variationCode = $_POST['newVariationCode'] ?? '';
        $variationAnhColor = $_POST['newVariationAnhColor'] ?? '';
        $productId = $_POST['productId'] ?? '';
        $variationColor = $_POST['newVariationColor'] ?? '';
        $variationPrice = $_POST['newVariationPrice'] ?? '';
        $variationSale = $_POST['newVariationSale'] ?? 0;
        $variationDescripe = $_POST['newVariationDescripe'] ?? '';
        $image = $_FILES['newVariationImage'] ?? null;

        $image__new = xuLyUploadFile($image, "Image/products/", '');

        if (empty($variationCode) || empty($variationColor) || empty($variationPrice) || !$image) {
            setsession('messageDeleteComment', "Thêm Khồng thành công");
        } else {
            $data__new = [
                'variationCode' => $variationCode,
                'image' => $image__new,
                'color' => $variationColor,
                'anhColor' => $variationAnhColor,
                'price' => $variationPrice,
                'sale' => 0,
                'descripe' => $variationDescripe,
                'productId' => $productId,
            ];

            // checkloi($data__new);

            $kq = (new Model_Admin)->addVariation('variations', $data__new);


            if ($kq) {
                setsession('messageDeleteComment', "Thêm thành công");
                header('Location: /Yody/admin?ViewProduct=' . $productId);
            } else {
                setsession('messageDeleteComment', "Thêm Khồng thành công");
                header('Location: /Yody/admin?ViewProduct=' . $productId);
            }
        }
    }
    public function Order($file = "order")
    {

        $idUser = $_GET['OrderItem'] ?? '';
        $Admin = new Model_Admin;
        $dataAllOrders = $Admin->getAllOrder();
        $dataAllOrderItem = $Admin->getAllOrderItems();
        $dataAllOrderStatus = $Admin->getAllOrderStatus();
        $dataAllPay = $Admin->getAllPay();
        $dataAllPayStatus = $Admin->getAllPayStatus();

        View(FRONTEND__ADMIN, $file, [
            'dataAllOrders' => $dataAllOrders,
            'dataAllOrderItem' => $dataAllOrderItem,
            'dataAllOrderStatus' => $dataAllOrderStatus,
            'dataAllPayStatus' => $dataAllPayStatus,
            'dataAllPay' => $dataAllPay

        ]);
    }
    public function Comment($file = "comment")
    {
        $Admin = new Model_Admin;
        $dataAllComment = $Admin->getAllComments();

        View(FRONTEND__ADMIN, $file, ['dataAllComment' => $dataAllComment]);
    }

    public function DeleteComment()
    {
        $idUser = $_GET['DeleteComment'] ?? '';
        $dk = "commentId=" . $idUser;

        $data = [
            "status" => 1
        ];
        $kq = (new Model_Admin)->DeleteComment('comments', $dk);

        if ($kq) {

            setsession('messageDeleteComment', "Xóa thành công");
            header('Location: /Yody/admin?Comment');
            exit;
        } else {
            setsession('messageDeleteComment', "Xóa thất bại");
            header('Location: /Yody/admin?Comment');
            exit;
        }
    }
    public function DuyetComment()
    {
        $idUser = $_GET['DuyetComment'] ?? '';
        $dk = "commentId=" . $idUser;

        $data = [
            "status" => 1
        ];
        $kq = (new Model_Admin)->DuyetComeent('comments', $data, $dk);
        if ($kq === true) {

            setsession('messageDuyetComment', "Cập nhật thành công");
            header('Location: /Yody/admin?Comment');
            exit;
        } else {
            setsession('messageDuyetComment', "Cập nhật thất bại");
            header('Location: /Yody/admin?Comment');
            exit;
        }
    }
    // ************************Thêm giỏ hàng ************************************88

    public function orderItem()
    {
        $Admin = new Model_Admin;
        $id = $_GET['orderItem'] ?? null;
        // checkloi($id);
        $dataAllOrderStatus = $Admin->getAllOrderStatus();
        $dataAllPay = $Admin->getAllPay();
        $dataAllPayStatus = $Admin->getAllPayStatus();
        if (!$id == null) {
            $sql = "SELECT 
            o.*, 
            v.image AS anhsp, 
            v.color AS mausp, 
            s.size, 
            s.quantity AS soluongton,
            os.name AS trangthaidonhang, 
            pa.paymentStatus AS trangthaithanhtoan, 
            p.name AS tensanpham
            FROM 
                orderitems AS o
            JOIN 
                variations AS v ON o.variationId = v.variationId
            JOIN 
                products AS p ON v.productId = p.productId
            JOIN 
                sizevariations AS s ON o.sizeId = s.sizeId
            JOIN 
                orderstatus AS os ON o.statusId = os.statusId
            JOIN 
                paystatus AS pa ON o.payStatusId = pa.payStatusId
            WHERE 
                o.orderId = $id";
            $kq = getRaw($sql);
            // checkloi($kq);
            if ($kq) {

                View(FRONTEND__ADMIN, 'orderitem', [
                    'kq' => $kq,
                    'dataAllOrderStatus' => $dataAllOrderStatus,
                    'dataAllPay' => $dataAllPay,
                    'dataAllPayStatus' => $dataAllPayStatus,


                ]);
            }
        } else {
            checkloi('khong tim thayid don hang');
        }
    }

    public function feedback($file = 'feedback')
    {
        $kq = (new Model_Admin())->phanhoi();
        View(FRONTEND__ADMIN, $file, ['kq' => $kq]);
    }

    public function Deletefeedback()
    {
        $idUser = $_GET['Deletefeedback'] ?? '';
        $dk = "reviewsId=" . $idUser;


        $kq = (new Model_Admin)->Deletefeedbackss('productrivews', $dk);

        if ($kq) {

            setsession('messageDeletefeedback', "Xóa thành công");
            header('Location: /Yody/admin?feedback');
            exit;
        } else {
            setsession('messageDeletefeedback', "Xóa thất bại");
            header('Location: /Yody/admin?feedback');
            exit;
        }
    }
}
