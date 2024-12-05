<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Dashboard - Yody</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="<?= FRONTEND__ADMIN ?>/assets/img/favicon.png" rel="icon">
    <link href="<?= FRONTEND__ADMIN ?>/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="<?= FRONTEND__ADMIN ?>/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= FRONTEND__ADMIN ?>/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="<?= FRONTEND__ADMIN ?>/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="<?= FRONTEND__ADMIN ?>/assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="<?= FRONTEND__ADMIN ?>/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="<?= FRONTEND__ADMIN ?>/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="<?= FRONTEND__ADMIN ?>/assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="<?= FRONTEND__ADMIN ?>/assets/css/style.css" rel="stylesheet">
</head>

<body>
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a href="<?= P ?>/admin" class="logo d-flex align-items-center">
                <img src="assets/img/logo.png" alt="">
                <span class="d-none d-lg-block">YODY</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div><!-- End Logo -->



        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">

                <li class="nav-item d-block d-lg-none">
                    <a class="nav-link nav-icon search-bar-toggle " href="#">
                        <i class="bi bi-search"></i>
                    </a>
                </li><!-- End Search Icon-->

                <li class="nav-item dropdown">

                    <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                        <i class="bi bi-bell"></i>
                        <span class="badge bg-primary badge-number">4</span>
                    </a><!-- End Notification Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
                        <li class="dropdown-header">
                            You have 4 new notifications
                            <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="notification-item">
                            <i class="bi bi-exclamation-circle text-warning"></i>
                            <div>
                                <h4>Lorem Ipsum</h4>
                                <p>Quae dolorem earum veritatis oditseno</p>
                                <p>30 min. ago</p>
                            </div>
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="notification-item">
                            <i class="bi bi-x-circle text-danger"></i>
                            <div>
                                <h4>Atque rerum nesciunt</h4>
                                <p>Quae dolorem earum veritatis oditseno</p>
                                <p>1 hr. ago</p>
                            </div>
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="notification-item">
                            <i class="bi bi-check-circle text-success"></i>
                            <div>
                                <h4>Sit rerum fuga</h4>
                                <p>Quae dolorem earum veritatis oditseno</p>
                                <p>2 hrs. ago</p>
                            </div>
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="notification-item">
                            <i class="bi bi-info-circle text-primary"></i>
                            <div>
                                <h4>Dicta reprehenderit</h4>
                                <p>Quae dolorem earum veritatis oditseno</p>
                                <p>4 hrs. ago</p>
                            </div>
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li class="dropdown-footer">
                            <a href="#">Show all notifications</a>
                        </li>

                    </ul><!-- End Notification Dropdown Items -->

                </li><!-- End Notification Nav -->

                <li class="nav-item dropdown">

                    <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                        <i class="bi bi-chat-left-text"></i>
                        <span class="badge bg-success badge-number">3</span>
                    </a><!-- End Messages Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages">
                        <li class="dropdown-header">
                            You have 3 new messages
                            <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="message-item">
                            <a href="#">
                                <img src="assets/img/messages-1.jpg" alt="" class="rounded-circle">
                                <div>
                                    <h4>Maria Hudson</h4>
                                    <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                                    <p>4 hrs. ago</p>
                                </div>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="message-item">
                            <a href="#">
                                <img src="assets/img/messages-2.jpg" alt="" class="rounded-circle">
                                <div>
                                    <h4>Anna Nelson</h4>
                                    <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                                    <p>6 hrs. ago</p>
                                </div>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="message-item">
                            <a href="#">
                                <img src="assets/img/messages-3.jpg" alt="" class="rounded-circle">
                                <div>
                                    <h4>David Muldon</h4>
                                    <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                                    <p>8 hrs. ago</p>
                                </div>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="dropdown-footer">
                            <a href="#">Show all messages</a>
                        </li>

                    </ul><!-- End Messages Dropdown Items -->

                </li><!-- End Messages Nav -->

                <li class="nav-item dropdown pe-3">

                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                        <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
                        <span class="d-none d-md-block dropdown-toggle ps-2">K. Anderson</span>
                    </a><!-- End Profile Iamge Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6>Kevin Anderson</h6>
                            <span>Web Designer</span>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                                <i class="bi bi-person"></i>
                                <span>My Profile</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                                <i class="bi bi-gear"></i>
                                <span>Account Settings</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="pages-faq.html">
                                <i class="bi bi-question-circle"></i>
                                <span>Need Help?</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Sign Out</span>
                            </a>
                        </li>

                    </ul><!-- End Profile Dropdown Items -->
                </li><!-- End Profile Nav -->

            </ul>
        </nav><!-- End Icons Navigation -->

    </header><!-- End Header -->



    <aside id="sidebar" class="sidebar">

        <ul class="sidebar-nav" id="sidebar-nav">

            <li class="nav-item">
                <a class="nav-link " href="<?= P ?>/admin?">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li><!-- End Dashboard Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-menu-button-wide"></i><span>Danh mục</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="<?= P ?>/admin?Category">
                            <i class="bi bi-circle"></i><span>Danh mục sản phẩm</span>
                        </a>
                    </li>

                </ul>
            </li><!-- End Danh muc Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="">
                    <i class="bi bi-journal-text"></i><span>Sản phẩm</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="<?= P ?>/admin?Product">
                            <i class="bi bi-circle"></i><span>Danh sach sản phẩm</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= P ?>/admin?AddProduct">
                            <i class="bi bi-circle"></i><span>Thêm mới sản phẩm</span>
                        </a>
                    </li>

                </ul>
            </li><!-- End San pham  Nav -->
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#account-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-layout-text-window-reverse"></i><span>Tài khoản</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="account-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="<?= P ?>/admin?Account">
                            <i class="bi bi-circle"></i><span>Quản lí tài khoản</span>
                        </a>
                    </li>
                </ul>
            </li> <!-- End Tài khoản Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#slide-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-layout-text-window-reverse"></i><span>Slides</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="slide-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="<?= P ?>/admin?Slides">
                            <i class="bi bi-circle"></i><span>Quản lí Slide</span>
                        </a>
                    </li>
                </ul>
            </li> <!-- End Slides Nav -->


            <li class="nav-item">
                <a class="nav-link collapsed" href="<?= P ?>/admin?Comment">
                    <i class="bi bi-person"></i>
                    <span>Bình luận</span>
                </a>
            </li><!-- End Binh luán Page Nav -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="<?= P ?>/admin?Order">
                    <i class="bi bi-person"></i>
                    <span>Quản lý đơn hàng</span>
                </a>
            </li><!-- End Đon hang  Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="#">
                    <i class="bi bi-card-list"></i>
                    <span>Register</span>
                </a>
            </li><!-- End dang ki Page Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="<?= P ?>/logout">
                    <i class="bi bi-box-arrow-in-right"></i>
                    <span>logout</span>
                </a>
            </li><!-- End Login Page Nav -->



        </ul>

    </aside><!-- End Sidebar-->



    <?php
    require_once("Backend/controller/admin/admin.php");

    $basePath = P;
    $urlPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $query = $_SERVER['QUERY_STRING'] ?? '';
    parse_str($query, $queryParams); // Chuyển query string thành mảng


    if ((strpos($urlPath, "{$basePath}/admin") === 0)) {
        $AdminCtl = new Controller__Admin;
        $page = match (true) {
            $urlPath === "{$basePath}/admin"  && $query === "" => fn() => require_once("Frontend/component/admin/home.php"),

            // """""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""CRUD Comment"""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""

            $urlPath === "{$basePath}/admin"  && $query === "Comment" => fn() => $AdminCtl->Comment(),
            $urlPath === "{$basePath}/admin"  &&  isset($queryParams['DuyetComment']) => fn() => $AdminCtl->DuyetComment(),
            // Xóa người dùng
            $urlPath === "{$basePath}/admin"  &&  isset($queryParams['DeleteComment']) => fn() => $AdminCtl->DeleteComment(),

            // """""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""CRUD Order"""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""


            // """""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""CRUD Order"""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""

            $urlPath === "{$basePath}/admin"  && $query === "Order" => fn() => $AdminCtl->Order(),
            // Lấy ra người dùng muốn sửa
            $urlPath === "{$basePath}/admin"  && $query === "UpdateOrder" => fn() => $AdminCtl->Order(),
            // chueyern đến trang thêm người dùng
            $urlPath === "{$basePath}/admin"  && $query === "AddOrder" => fn() => $AdminCtl->Order(),
            // Thêm người dùng vào database
            $urlPath === "{$basePath}/admin"  && $query === "themOrder" => fn() => $AdminCtl->Order(),
            // Xóa người dùng
            $urlPath === "{$basePath}/admin"  &&  isset($queryParams['DeleteOrder']) => fn() => $AdminCtl->Order(),

            // """""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""CRUD Order"""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""

            // """""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""CRUD Product"""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""

            $urlPath === "{$basePath}/admin"  && $query === "Product" => fn() => $AdminCtl->Product(),
            // Lấy ra người dùng muốn sửa
            $urlPath === "{$basePath}/admin"  && isset($queryParams['ViewProduct']) => fn() => $AdminCtl->ProductView(),
            // Cập nhật người dùng
            $urlPath === "{$basePath}/admin"  && $query === "themVariation" => fn() => $AdminCtl->addVariation(),
            // chueyern đến trang thêm người dùng
            $urlPath === "{$basePath}/admin"  && $query === "AddProduct" => fn() => $AdminCtl->Product('addProducts'),
            $urlPath === "{$basePath}/admin"  && $query === "themproduct" => fn() => $AdminCtl->addProduct(),
            // Thêm người dùng vào database
            $urlPath === "{$basePath}/admin"  && $query === "themProduct" => fn() => $AdminCtl->Product(),
            // Xóa người dùng
            $urlPath === "{$basePath}/admin"  &&  isset($queryParams['DeleteProduct']) => fn() => $AdminCtl->deleteProduct(),
            $urlPath === "{$basePath}/admin"  &&  isset($queryParams['FilterCategory']) => fn() => $AdminCtl->FilterCategory(),

            // """""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""CRUD Product"""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""


            // """""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""CRUD Category"""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""

            $urlPath === "{$basePath}/admin"  && $query === "Category" => fn() => $AdminCtl->Category(),
            // Lấy ra người dùng muốn sửa
            $urlPath === "{$basePath}/admin"  && isset($queryParams['EditCategory']) => fn() => $AdminCtl->getCategoryById('editCategory'),
            // Danh mục con của category
            $urlPath === "{$basePath}/admin"  && isset($queryParams['editChildCategory']) => fn() => $AdminCtl->getChildCategoryById('editChildCategory'),

            $urlPath === "{$basePath}/admin"  && isset($queryParams['editCommoncategorys']) => fn() => $AdminCtl->getCommontCategory('editCommoncategorys'),
            // Cập nhật người dùng
            $urlPath === "{$basePath}/admin"  && $query === "UpdateCategory" => fn() => $AdminCtl->UpdateCategory(),
            
            $urlPath === "{$basePath}/admin"  && $query === "updateChildCategory" => fn() => $AdminCtl->updateChildCategory(),

            $urlPath === "{$basePath}/admin"  && $query === "updateCommontCategory" => fn() => $AdminCtl->updateCommontCategory(),
            // chueyern đến trang thêm người dùng
            $urlPath === "{$basePath}/admin"  && $query === "AddCategory" => fn() => $AdminCtl->Category('addCategory'),
            // Thêm người dùng vào database
            $urlPath === "{$basePath}/admin"  && $query === "themCategory" => fn() => $AdminCtl->addCategory(),
            // Xóa người dùng
            $urlPath === "{$basePath}/admin"  &&  isset($queryParams['deleteCategory']) => fn() => $AdminCtl->deleteCategory(),
            $urlPath === "{$basePath}/admin"  &&  isset($queryParams['deleteChildCategory']) => fn() => $AdminCtl->deleteCategory(),
            $urlPath === "{$basePath}/admin"  &&  isset($queryParams['deleteCommontCategory']) => fn() => $AdminCtl->deleteCategory(),
            // 
            $urlPath === "{$basePath}/admin"  &&  isset($queryParams['addchild']) => fn() => $AdminCtl->headerAddchild(),
            $urlPath === "{$basePath}/admin"  &&  isset($queryParams['addChilds']) => fn() => $AdminCtl->addChild(),

            $urlPath === "{$basePath}/admin"  &&  isset($queryParams['addCommont']) => fn() => $AdminCtl->headerAddCommont(),
            $urlPath === "{$basePath}/admin"  &&  isset($queryParams['addCommonts']) => fn() => $AdminCtl->addComment(),


            // """""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""CRUD Category"""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""

            // """""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""CRUD Slide"""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""

            $urlPath === "{$basePath}/admin"  && $query === "Slides" => fn() => $AdminCtl->Slide(),
            // Lấy ra người dùng muốn sửa
            $urlPath === "{$basePath}/admin"  && isset($queryParams['EditSlide']) => fn() => $AdminCtl->SlideId('editSlide'),
            // Cập nhật người dùng
            $urlPath === "{$basePath}/admin"  && $query === "UpdateSlide" => fn() => $AdminCtl->UpdateSlide(),
            // chueyern đến trang thêm người dùng
            $urlPath === "{$basePath}/admin"  && $query === "AddSlide" => fn() => $AdminCtl->Slide('addSlide'),
            // Thêm người dùng vào database
            $urlPath === "{$basePath}/admin"  && $query === "themSlide" => fn() => $AdminCtl->addSlide(),
            // Xóa người dùng
            $urlPath === "{$basePath}/admin"  &&  isset($queryParams['DeleteSlide']) => fn() => $AdminCtl->xoaSlide(),

            // """""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""CRUD Slide"""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""

            // """""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""CRUD user"""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""

            // Hiển thị danh sách người dùng
            $urlPath === "{$basePath}/admin"  && $query === "Account" => fn() => $AdminCtl->account('account'),
            // Lấy ra người dùng muốn sửa
            $urlPath === "{$basePath}/admin"  && isset($queryParams['EditAccount']) => fn() => $AdminCtl->account('editAccount'),
            // Cập nhật người dùng
            $urlPath === "{$basePath}/admin"  && $query === "UpdateUser" => fn() => $AdminCtl->updateUser(),
            // chueyern đến trang thêm người dùng
            $urlPath === "{$basePath}/admin"  && $query === "AddAccount" => fn() => $AdminCtl->account('addAccount'),
            // Thêm người dùng vào database
            $urlPath === "{$basePath}/admin"  && $query === "themAccount" => fn() => $AdminCtl->addUser(),
            // Xóa người dùng
            $urlPath === "{$basePath}/admin"  &&  isset($queryParams['DeleteAccount']) => fn() => $AdminCtl->deleteUser(),
                // End """"""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""CRUD user"""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""
            default => fn() => print("Admin page not found! onweonafdg"),
        };
    }

    $page();
    ?>
    <!-- ======= Footer ======= -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="<?= FRONTEND__ADMIN ?>/assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="<?= FRONTEND__ADMIN ?>/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= FRONTEND__ADMIN ?>/assets/vendor/chart.js/chart.umd.js"></script>
    <script src="<?= FRONTEND__ADMIN ?>/assets/vendor/echarts/echarts.min.js"></script>
    <script src="<?= FRONTEND__ADMIN ?>/assets/vendor/quill/quill.js"></script>
    <script src="<?= FRONTEND__ADMIN ?>/assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="<?= FRONTEND__ADMIN ?>/assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="<?= FRONTEND__ADMIN ?>/assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="<?= FRONTEND__ADMIN ?>/assets/js/admin.js"></script>

</body>

</html>