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

    public function Category($file = "category")
    {
        $Admin = new Model_Admin;
        // $dataAllUser = $Admin->getAllUsers();

        View(FRONTEND__ADMIN, $file, []);
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
