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
                            'role' => $role,
                        ];
                        $dieukien = "userId=" . $userId;
                        $ketqua = (new Model_Admin())->updateOneUserWhereById('users', $data_user_new, $dieukien);
                        if ($ketqua === true) {

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

    public function Slide($file = "slides")
    {
        $Admin = new Model_Admin;
        // $dataAllUser = $Admin->getAllUsers();

        View(FRONTEND__ADMIN, $file, []);
    }

    // =============== category =====================
    public function Category($file = "category")
    {
        $Admin = new Model_Admin;
        $Client = new Model_Client;
        $category = $Client->getAllCategories();
        // var_dump($category)
        // var_dump($category)
        // lấy toàn bộ child category

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
        if (isPost()) {
            $data = $_POST;
            $anh = '';
            $file_anh = $_FILES['image'];
            if ($file_anh['size'] > 0) {
                $anh = 'Image/category/' . $file_anh['name'];
                move_uploaded_file($file_anh['tmp_name'], $anh);
            }
            $data['image'] = $anh;
            (new Model_Admin)->addCategory('categorys', $data);
            header('Location: /Yody/admin?Category');
            exit;
        }
    }

    public function UpdateCategory()
    {
        if (isPost()) {
            $data = filter();
            $image = $data['image'];
            $name = $data['name'];
            $past = $data['past'];
            $categoryId = $data['categoryId'];
            $new_image = $_FILES['image'];
            $xulyImage = xuLyUploadFile($new_image, 'Image/category/', $image);
            $new_data = [
                'image' => $xulyImage,
                'name' => $name,
                'past' => $past,
            ];
            $dk = 'categoryId=' . $categoryId;
            $ketqua = (new Model_Admin)->updateOneCategoryWhereById('categorys', $new_data, $dk);
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








    public function Product($file = "products")
    {
        $Admin = new Model_Admin;
        // $dataAllUser = $Admin->getAllUsers();

        View(FRONTEND__ADMIN, $file, []);
    }
    public function Order($file = "order")
    {
        $Admin = new Model_Admin;
        // $dataAllUser = $Admin->getAllUsers();

        View(FRONTEND__ADMIN, $file, []);
    }
    public function Comment($file = "comment")
    {
        $Admin = new Model_Admin;
        // $dataAllUser = $Admin->getAllUsers();

        View(FRONTEND__ADMIN, $file, []);
    }
}
