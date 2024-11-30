<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Frontend/Css/home.css">
    <link rel="stylesheet" href="Frontend/Css/category.css">
    <title>category</title>

</head>

<body>

    <?php require_once(HF . "header.php")  ?>
    <div>
        <div class="grid wide row align-items-center">
            <span> <a class="past__product" href="<?= P ?>/">Trang Chủ </a></span>
            <span class="past__icon--next"><img src="Frontend/public/svg/next.svg" alt=""></span>
            <span class="past__product--category"></span>
        </div>
        <div class="grid wide name__category ">
            <?php foreach ($category as $cap1):    ?>
                <?php if ($cap1['categoryId'] === $kq[0]['categoryId']):   ?>
                    <a style="cursor: pointer;"
                        href="<?= P ?>/category?id=<?= $cap1['categoryId'] ?>"><?= $cap1['name'] ?? "" ?></a>
                <?php endif  ?>
            <?php endforeach   ?>

        </div>
        <div class="grid wide">
            <div class="intro__products row">
                <span>
                    <p>321 sản phẩm</p>
                </span>
                <span>
                    <div class="dropdown">
                        <button class="dropbtn row align-items-center ">
                            <span>Sắp xếp theo</span>
                            <span class="icon__bottom"><img src="Frontend/public/svg/buttonnext.svg" alt=""></span>
                            <span class="icon__top icon__bottom display__none"><img
                                    src="Frontend/public/svg/topnext.svg" alt=""></span>
                        </button>
                        <div class="dropdown__content display__none">
                            <a href="">Nổi bật</a>
                            <a href="#">Mới nhất</a>
                            <a href="#">Giá từ thấp đến cao</a>
                            <a href="#">Giá từ cao đến thấp</a>
                        </div>
                    </div>
                </span>
            </div>
            <div class="row">
                <div class="category__left l-2 m-0 c-0">
                    <div class="scollosss">
                        <span>Bộ Lọc</span>
                        <div>
                            <div class="list__sex">
                                <div class="list__name">
                                    <span>Giới Tính</span>
                                    <span class="icon__bottom--filter icon__bottom">
                                        <img src="Frontend/public/svg/buttonnext.svg" alt="">
                                    </span>

                                </div>
                                <div class="list__content--none display__none">
                                    <ul class="checkbox-list">
                                        <li class="checkbox-item">

                                            <input type="checkbox" id="Nam">
                                            <label for="Nam">Nam</label>

                                        </li>
                                        <li class="checkbox-item">

                                            <input type="checkbox" id="Nữ">
                                            <label for="">Nữ</label>

                                        </li>
                                        <li class="checkbox-item">

                                            <input type="checkbox" id="Em">
                                            <label for="treem">Trẻ Em</label>

                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- //////////// -->
                            <div class="list__color">
                                <div class="list__name">
                                    Màu Sắc <span class="icon__bottom--filter icon__bottom">
                                        <img src="Frontend/public/svg/buttonnext.svg" alt="">
                                    </span>
                                </div>
                                <div class="list__content--none">
                                    <ul class="color-grid grid">
                                        <li class="color-item">

                                            <div class="color-circle" style="background-color: black;" data-color="D">
                                            </div>
                                            <p>Đen</p>

                                        </li>
                                        <li class="color-item">

                                            <div class="color-circle" style="background-color: red;" data-color="D">
                                            </div>
                                            <p>Đỏ</p>

                                        </li>
                                        <li class="color-item">

                                            <div class="color-circle" style="background-color: yellow;" data-color="V">
                                            </div>
                                            <p>Vàng</p>

                                        </li>
                                        <li class="color-item">

                                            <div class="color-circle" style="background-color: orange;" data-color="C">
                                            </div>
                                            <p>Cam</p>

                                        </li>
                                        <li class="color-item">

                                            <div class="color-circle" style="background-color: gray;" data-color="X">
                                            </div>
                                            <p>Xám</p>

                                        </li>
                                        <li class="color-item">

                                            <div class="color-circle" style="background-color: pink;" data-color="H">
                                            </div>
                                            <p>Hồng</p>

                                        </li>
                                        <li class="color-item">

                                            <div class="color-circle" style="background-color: purple;" data-color="T">
                                            </div>
                                            <p>Tím</p>

                                        </li>
                                        <li class="color-item">

                                            <div class="color-circle" style="background-color: brown;" data-color="N">
                                            </div>
                                            <p>Nâu</p>

                                        </li>
                                        <li class="color-item">

                                            <div class="color-circle"
                                                style="background-color: white; border: 1px solid black;"
                                                data-color="T"></div>
                                            <p>Trắng</p>

                                        </li>

                                    </ul>
                                </div>
                            </div>
                            <!-- ++++++++++++++++ -->
                            <div class="list__size">
                                <div class="list__name">
                                    Kích thước <span class="icon__bottom--filter icon__bottom">
                                        <img src="Frontend/public/svg/buttonnext.svg" alt="">
                                    </span>
                                </div>
                                <div class="list__content--none">
                                    <ul class="size-grid grid">
                                        <li class="size-item">

                                            <div class="size-circle">S</div>

                                        </li>
                                        <li class="size-item">

                                            <div class="size-circle">M</div>


                                        </li>
                                        <li class="size-item">

                                            <div class="size-circle">L</div>


                                        </li>
                                        <li class="size-item">

                                            <div class="size-circle">XL</div>


                                        </li>
                                        <li class="size-item">

                                            <div class="size-circle">2XL</div>


                                        </li>
                                        <li class="size-item">

                                            <div class="size-circle">3XL</div>


                                        </li>
                                        <li class="size-item">

                                            <div class="size-circle">4XL</div>


                                        </li>
                                        <li class="size-item">

                                            <div class="size-circle">5XL</div>


                                        </li>
                                        <li class="size-item">

                                            <div class="size-circle">F</div>


                                        </li>
                                        <li class="size-item">

                                            <div class="size-circle">XXX</div>


                                        </li>

                                    </ul>
                                    <ul class="size-grid grid mt-4">
                                        <li class="size-item">

                                            <div class="size-circle">1</div>

                                        </li>
                                        <li class="size-item">

                                            <div class="size-circle">2</div>


                                        </li>
                                        <li class="size-item">

                                            <div class="size-circle">3</div>


                                        </li>
                                        <li class="size-item">

                                            <div class="size-circle">4</div>


                                        </li>
                                        <li class="size-item">

                                            <div class="size-circle">27</div>


                                        </li>
                                        <li class="size-item">

                                            <div class="size-circle">28</div>


                                        </li>
                                        <li class="size-item">

                                            <div class="size-circle">29</div>


                                        </li>
                                        <li class="size-item">

                                            <div class="size-circle">30</div>


                                        </li>

                                        <li class="size-item">

                                            <div class="size-circle">31</div>

                                        </li>
                                        <li class="size-item">

                                            <div class="size-circle">32</div>

                                        </li>
                                        <li class="size-item">

                                            <div class="size-circle">33</div>

                                        </li>
                                        <li class="size-item">

                                            <div class="size-circle">34</div>

                                        </li>
                                        <li class="size-item">

                                            <div class="size-circle">35</div>

                                        </li>
                                        <li class="size-item">

                                            <div class="size-circle">36</div>

                                        </li>
                                        <li class="size-item">

                                            <div class="size-circle">37</div>

                                        </li>
                                        <li class="size-item">

                                            <div class="size-circle">38</div>

                                        </li>
                                        <li class="size-item">

                                            <div class="size-circle">39</div>

                                        </li>
                                        <li class="size-item">

                                            <div class="size-circle">40</div>

                                        </li>
                                        <li class="size-item">

                                            <div class="size-circle">41</div>

                                        </li>
                                        <li class="size-item">

                                            <div class="size-circle">42</div>

                                        </li>
                                        <li class="size-item">

                                            <div class="size-circle">43</div>

                                        </li>
                                        <li class="size-item">

                                            <div class="size-circle">44</div>

                                        </li>
                                        <li class="size-item">

                                            <div class="size-circle">110</div>

                                        </li>
                                        <li class="size-item">

                                            <div class="size-circle">115</div>

                                        </li>
                                        <li class="size-item">

                                            <div class="size-circle">120</div>

                                        </li>
                                        <li class="size-item">

                                            <div class="size-circle">125</div>

                                        </li>
                                        <li class="size-item">

                                            <div class="size-circle">130</div>

                                        </li>

                                    </ul>
                                </div>
                            </div>
                            <!-- ================= -->
                            <div class="list__price">
                                <div class="list__name">
                                    Theo giá <span class="icon__bottom--filter icon__bottom">
                                        <img src="Frontend/public/svg/buttonnext.svg" alt="">
                                    </span>
                                </div>
                                <div class="list__content--none">
                                    <ul class="checkbox-list">
                                        <li class="checkbox-item">

                                            <input type="checkbox" id="below-350k">
                                            <label for="below-350k">Dưới 350.000đ</label>

                                        </li>
                                        <li class="checkbox-item">

                                            <input type="checkbox" id="between-350k-750k">
                                            <label for="between-350k-750k">Từ 350.000đ - 750.000đ</label>

                                        </li>
                                        <li class="checkbox-item">

                                            <input type="checkbox" id="above-750k">
                                            <label for="above-750k">Trên 750.000đ</label>

                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="category__right l-10 m-12 c-12">
                    <?php if (!$kq):  ?>
                        <h1 class="category__right-noProduct">Không có sản phẩm</h1>
                    <?php else: ?>
                        <section class="products row   justify-content-between grid">

                            <?php foreach ($kq as $Product) : ?>
                                <?php $name = replaceSpacesWithHyphen($Product['name']); ?>
                                <article class="product l-3 m-4 c-12">
                                    <a href="<?= P ?>/product?<?= $name ?>&color=<?= $Product['colorId'] ?>">
                                        <div class="product__image">
                                            <img loading="lazy" src="<?= $Product['ImageMain'] ?>" alt="" />
                                        </div>
                                        <span class="product__name"><?= $Product['name'] ?></span>
                                        <div class="product__price row align-items-center">
                                            <?php
                                            $sale = $Product['new_price'] - ($Product['new_price'] * ($Product['old_price'] / 100));

                                            ?>
                                            <span class='price__new'>
                                                <?=
                                                $Product['old_price'] > 0
                                                    ?  number_format($sale, 0, ',', '.') . "đ"
                                                    : number_format($Product['new_price'], 0, ',', '.') . "đ";
                                                ?>
                                            </span>
                                            <?=
                                            $Product['old_price'] > 0
                                                ? "<span class='price__old'>" . number_format($Product['new_price'], 0, ',', '.') . "đ</span>"
                                                : "";
                                            ?>

                                        </div>
                                        <div class="product__variation row align-items-center">

                                            <?php
                                            $variations = json_decode($Product['variations'], true); ?>
                                            <?php foreach ($variations as $key => $variation) : ?>
                                                <a href="<?= P ?>/product?<?= $name ?>&color=<?= $variation['variationId'] ?>"
                                                    data-images="<?= $variation['image'] ?>">
                                                    <span
                                                        class="product__variation--item <?= $variation['variationId'] == $Product['colorId'] ? 'active__product--variation' : '' ?>"
                                                        style="background-color: <?= $variation['anhColor'] ?>">
                                                    </span>
                                                </a>
                                            <?php endforeach; ?>
                                        </div>
                                        <?= $Product['old_price'] > 0 ? "<div class='product__logo--sale row align-items-center justify-content-center'><span>-$Product[old_price]%</span></div>" : "" ?>
                                    </a>
                                </article>
                            <?php endforeach; ?>
                        </section>
                    <?php endif ?>
                </div>
            </div>
        </div>
    </div>
    </div>
    <div class="mt-4">
        <button class="row btn__view">Xem thêm</button>
    </div>
    <?php require_once(HF . "footer.php")  ?>
</body>

<script src="Frontend/Js/category.js"></script>

</html>