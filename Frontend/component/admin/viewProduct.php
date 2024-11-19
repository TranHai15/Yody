<main id="main" class="main">
    <div class="container mt-5">
        <h2 class=" text-align-center mb-4">Chi tiết sản phẩm</h2>

        <div id="productId" data-productId="<?= $idProduct ?>"></div>
    </div>
    <h4 class="mb-4">Product Variations</h4>

    <div class="card mb-4">
        <div class="card-header">
            <h5>Variations List</h5>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">ID variation</th>
                        <th scope="col">Variation Code</th>
                        <th scope="col">image</th>
                        <th scope="col">color</th>
                        <th scope="col">anhColor</th>
                        <th scope="col">price</th>
                        <th scope="col">sale</th>
                        <th scope="col">descripe</th>
                        <th scope="col">action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($dataAllVariation as $variation): ?>
                        <tr>
                            <td><?= $variation['variationId']  ?></td>
                            <td><?= $variation['variationCode']  ?></td>
                            <td><img class="" style="width: 30px; height: 40px;" src="<?= $variation['image']  ?>" alt="">
                            </td>
                            <td><?= $variation['color']  ?></td>
                            <td>
                                <?= $variation['anhColor']  ?>
                                <br>
                                <span
                                    style="background: <?= $variation['anhColor']  ?> ; padding:10px; display:inline-block;border-radius: 50%;">
                                </span>
                            </td>
                            <td><?= number_format($variation['price'], 0, '.', ',') . ' đ' ?></td>

                            <td><?= $variation['sale']  ?>%</td>
                            <td><?= $variation['descripe']  ?></td>

                            <td>
                                <button class="btn btn-info btn-sm"
                                    onclick="viewVariationDetails(<?= $variation['variationId']  ?>)">Edit</button>
                                <button class="btn btn-danger btn-sm"
                                    onclick="deleteVariation(<?= $variation['variationId']  ?>)">Delete</button>
                                <button class="btn btn-success btn-sm"
                                    onclick="ChiTietVariation(<?= $variation['variationId']  ?>)">Chi tiết</button>
                            </td>
                        </tr>

                    <?php endforeach ?>

                </tbody>
            </table>
            <button class="btn btn-primary" onclick="addVariation()">Add New Variation</button>
            <div id="addVariationForm" style=" display:none; margin-top: 20px;">
                <h3>Thêm Biến thể mới</h3>
                <form enctype="multipart/form-data" method="post" action="<?= P ?>/admin?themVariation">
                    <div class="row">
                        <!-- Mã Biến thể -->
                        <div class="col-md-3">
                            <label for="newVariationCode">Mã Biến thể</label>
                            <input type="text" id="newVariationCode" class="form-control mb-2" name="newVariationCode"
                                placeholder="Nhập mã Biến thể">
                        </div>
                        <input type="hidden" name="productId" value="<?= $idProduct ?>" id="">
                        <div class="col-md-3">
                            <label for="newVariationImage">Hình ảnh</label>
                            <input type="file" class="newVariationImage form-control mb-2" accept="image/*"
                                name="newVariationImage">
                            <img class="previewImage" src="" alt="Preview"
                                style="display: none; width: 100px; height: auto; margin-top: 10px;">
                        </div>


                        <!-- Màu -->
                        <div class="col-md-3">
                            <label for="newVariationColor">Màu</label>
                            <input type="text" id="newVariationColor" class="form-control mb-2" placeholder="Nhập màu"
                                name="newVariationColor">
                        </div>

                        <!-- Màu sắc (Preview) -->
                        <div class="col-md-3">
                            <label for="newVariationAnhColor">Màu sắc (Preview)</label>
                            <input type="color" id="newVariationAnhColor" class="form-control mb-2"
                                name="newVariationAnhColor">
                        </div>
                    </div>

                    <div class="row">
                        <!-- Giá -->
                        <div class="col-md-3">
                            <label for="newVariationPrice">Giá</label>
                            <input type="number" id="newVariationPrice" class="form-control mb-2" placeholder="Nhập giá"
                                name="newVariationPrice">
                        </div>

                        <!-- Giảm giá -->
                        <div class="col-md-3">
                            <label for="newVariationSale">Giảm giá (%)</label>
                            <input type="number" id="newVariationSale" class="form-control mb-2" name="newVariationSale"
                                placeholder="Nhập giảm giá (%)">
                        </div>

                        <!-- Mô tả -->
                        <div class="col-md-6">
                            <label for="newVariationDescripe">Mô tả</label>
                            <textarea id="newVariationDescripe" class="form-control mb-2" name="newVariationDescripe"
                                placeholder="Nhập mô tả"></textarea>
                        </div>
                    </div>

                    <button class="btn btn-success btn-sm" type="submit">Lưu</button>
                    <button class="btn btn-secondary btn-sm" type="button"
                        onclick="toggleAddVariationForm()">Hủy</button>
                </form>
            </div>
        </div>


    </div>

    <!-- <div id="EditVariationForm" style=" display:; margin-top: 20px;">
        <h3>Sửa Biến thể </h3>
        <form enctype="multipart/form-data" method="post" action="<?= P ?>/admin?themVariation">
            <div class="row">
             
                <div class="col-md-3">
                    <label for="newVariationCode">Mã Biến thể</label>
                    <input type="text" id="newVariationCode" class="form-control mb-2" name="newVariationCode"
                        placeholder="Nhập mã Biến thể">
                </div>
                <input type="hidden" name="productId" value="<?= $idProduct ?>" id="">
                <div class="col-md-3">
                    <label for="newVariationImage">Hình ảnh</label>
                    <input type="file" class="newVariationImage form-control mb-2" accept="image/*"
                        name="newVariationImage">
                    <img class="previewImage" src="" alt="Preview"
                        style="display: none; width: 100px; height: auto; margin-top: 10px;">
                </div>


             
                <div class="col-md-3">
                    <label for="newVariationColor">Màu</label>
                    <input type="text" id="newVariationColor" class="form-control mb-2" placeholder="Nhập màu"
                        name="newVariationColor">
                </div>

           
                <div class="col-md-3">
                    <label for="newVariationAnhColor">Màu sắc (Preview)</label>
                    <input type="color" id="newVariationAnhColor" class="form-control mb-2" name="newVariationAnhColor">
                </div>
            </div>

            <div class="row">
      
                <div class="col-md-3">
                    <label for="newVariationPrice">Giá</label>
                    <input type="number" id="newVariationPrice" class="form-control mb-2" placeholder="Nhập giá"
                        name="newVariationPrice">
                </div>

      
                <div class="col-md-3">
                    <label for="newVariationSale">Giảm giá (%)</label>
                    <input type="number" id="newVariationSale" class="form-control mb-2" name="newVariationSale"
                        placeholder="Nhập giảm giá (%)">
                </div>

   
                <div class="col-md-6">
                    <label for="newVariationDescripe">Mô tả</label>
                    <textarea id="newVariationDescripe" class="form-control mb-2" name="newVariationDescripe"
                        placeholder="Nhập mô tả"></textarea>
                </div>
            </div>

            <button class="btn btn-success btn-sm" type="submit">Lưu</button>
            <button class="btn btn-secondary btn-sm" type="button" onclick="toggleAddVariationForm()">Hủy</button>
        </form>
    </div> -->




    <div class="card mb-4">
        <div class="card-header">
            <h5>Size List</h5>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">sizeId</th>
                        <th scope="col">sizeCode</th>
                        <th scope="col">size</th>
                        <th scope="col">quantity</th>
                        <th scope="col">variationId</th>
                        <th scope="col">action</th>
                    </tr>
                </thead>
                <tbody id="sizeTableBody">

                </tbody>
            </table>
            <button class="btn btn-primary" onclick="addSize()">Add New Size</button>
            <div id="addSize" style="display:none; margin-top: 20px;">
                <h3>Thêm Biến thể mới</h3>
                <form class="themsize" enctype="multipart/form-data">
                    <div class="row">
                        <!-- Mã Biến thể -->
                        <input type="hidden" name="variationId" id="sizevariation">
                        <div class="col-md-3">
                            <label for="sizeCode">Mã Size</label>
                            <input type="text" id="sizeCode" class="form-control mb-2" placeholder="Nhập mã Size">
                        </div>
                        <div class="col-md-3">
                            <label for="size">Size</label>
                            <input type="text" id="size" class="form-control mb-2" placeholder="Nhập Loại Size">
                        </div>
                        <div class="col-md-3">
                            <label for="quantity">Số lượng</label>
                            <input type="text" id="quantity" class="form-control mb-2" placeholder="Nhập số lượng">
                        </div>

                    </div>

                    <div class="col-md-3">
                        <button class="btn btn-success btn-sm" type="submit">Lưu</button>
                        <button class="btn btn-secondary btn-sm" type="button"
                            onclick="toggleAddVariationForm()">Hủy</button>
                    </div>
                </form>
            </div>


        </div>
    </div>
    <img src="../../../Image/variationImage/" alt="">
    <div class="card mb-4">
        <div class="card-header">
            <h5>Detail Image List</h5>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Image</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody id="detailImageTableBody">

                </tbody>
            </table> -
            <button class="btn btn-primary" onclick="addDetailImage()">Add New Detail Image</button>
            <div id="addVariationForm3" style="display:none; margin-top: 20px;">
                <h3>Thêm Ảnh Biến thể</h3>
                <form enctype="multipart/form-data">
                    <div class="col-md-3">
                        <label for="newVariationImage3">Hình ảnh</label>
                        <input type="file" class="newVariationImage3 form-control mb-2" name="images[]" accept="image/*"
                            multiple>
                        <button class="btn btn-success btn-sm" type="submit">Lưu</button>
                        <button class="btn btn-secondary btn-sm" type="button"
                            onclick="toggleAddVariationForm()">Hủy</button>
                    </div>
                    <div class="previewContainer3" style="display: flex; flex-wrap: wrap; gap: 10px; margin-top: 10px;">
                    </div>
                </form>
            </div>

        </div>
    </div>



</main>



<script>
    // Gắn sự kiện validate cho Form 1
    document.querySelector('#addVariationForm3 form').addEventListener('submit', uploadVariationImages);

    // Gắn sự kiện validate cho Form 2
    document.querySelector('#addSize').querySelector('form').addEventListener('submit', validateForm2);

    // Gắn sự kiện validate cho Form 3
    document.querySelector('#addVariationForm').querySelector('form').addEventListener('submit', validateForm3);

    function validateForm3(event) {
        event.preventDefault(); // Ngừng gửi form để kiểm tra validate

        const form = event.target;
        const productId = document.getElementById("productId")
        const id = productId.getAttribute('data-productId')

        console.log(id);
        const newVariationCode = form.querySelector('#newVariationCode');
        const newVariationImage = form.querySelector('.newVariationImage');
        const newVariationColor = form.querySelector('#newVariationColor');
        const newVariationPrice = form.querySelector('#newVariationPrice');
        const newVariationSale = form.querySelector('#newVariationSale');
        const newVariationDescripe = form.querySelector('#newVariationDescripe');
        const newVariationAnhColor = document.querySelector('#newVariationAnhColor')
        // Kiểm tra các trường yêu cầu nhập
        if (!newVariationCode.value.trim()) {
            alert('Vui lòng nhập mã biến thể');
            newVariationCode.focus();
            return;
        }

        if (newVariationImage.files.length === 0) {
            alert('Vui lòng chọn hình ảnh cho biến thể');
            return;
        }

        if (!newVariationColor.value.trim()) {
            alert('Vui lòng chọn màu cho biến thể');
            newVariationColor.focus();
            return;
        }

        if (!newVariationPrice.value.trim() || isNaN(newVariationPrice.value.trim())) {
            alert('Vui lòng nhập giá hợp lệ');
            newVariationPrice.focus();
            return;
        }
        toggleAddVariationForm();
        form.submit();

    }

    function validateForm2(event) {
        event.preventDefault(); // Ngừng gửi form để kiểm tra validate

        const form = event.target;

        const sizeCode = form.querySelector('#sizeCode');
        const sizeCodenew = form.querySelector('#sizeCode').value
        const size = form.querySelector('#size');
        const sizenew = form.querySelector('#size').value
        const quantitynew = form.querySelector('#quantity').value
        const quantity = form.querySelector('#quantity');

        // Kiểm tra tất cả các trường yêu cầu phải nhập
        if (!sizeCode.value.trim()) {
            alert('Vui lòng nhập mã size');
            sizeCode.focus();
            return false;
        }

        if (!size.value.trim()) {
            alert('Vui lòng nhập loại size');
            size.focus();
            return false;
        }

        if (!quantity.value.trim() || isNaN(quantity.value.trim())) {
            alert('Vui lòng nhập số lượng hợp lệ');
            quantity.focus();
            return false;
        }
        const varriationId = document.getElementById("sizevariation").value


        fetch(
                `Backend/controller/admin/adminAjax.php?addSize=${varriationId}&sizeCode=${sizeCodenew}&size=${sizenew}&soluong=${quantitynew}`
            )
            .then((res) => {
                if (!res.ok) {
                    throw new Error(`Fetch error: ${res.status}`);
                }
                return res.json();
            })
            .then((data) => {
                console.log("Updated data:", data);
                // Hiển thị thông báo dựa trên phản hồi từ backend
                if (data.status === 'success') {
                    alert(data.message); // Cập nhật thành công
                } else {
                    alert(data.message); // Cập nhật thất bại
                }
            })
            .catch((error) => {
                console.error("Error connecting to server:", error);
            });

        // Làm mới trang hiện tại
        location.reload();
        // Nếu tất cả đều hợp lệ, cho phép gửi form
        // form.submit();
    }

    function uploadVariationImages(event) {
        event.preventDefault(); // Ngăn form gửi theo cách mặc định

        const form = event.target;
        const imageInput = form.querySelector('.newVariationImage3');
        const files = imageInput.files;
        const previewContainer = form.querySelector('.previewContainer3');

        // Kiểm tra xem người dùng có chọn ảnh hay chưa
        if (files.length === 0) {
            alert('Vui lòng chọn ít nhất một hình ảnh');
            return;
        }

        if (files.length > 4) { // Giới hạn 4 ảnh
            alert('Bạn chỉ được chọn tối đa 4 hình ảnh mỗi lần tải lên');
            return;
        }

        // Xóa nội dung preview cũ nếu có
        previewContainer.innerHTML = '';

        // Hiển thị preview ảnh đã chọn
        Array.from(files).forEach((file) => {
            if (file.type.startsWith('image/')) {
                const imgPreview = document.createElement('img');
                imgPreview.src = URL.createObjectURL(file);
                imgPreview.style.width = '100px';
                imgPreview.style.height = 'auto';
                imgPreview.style.margin = '5px';
                previewContainer.appendChild(imgPreview);
            } else {
                alert(`Tệp "${file.name}" không phải là ảnh hợp lệ`);
            }
        });

        // Chuẩn bị dữ liệu để gửi
        const formData = new FormData();
        Array.from(files).forEach((file) => {
            formData.append('images[]', file);
        });
        const variationId = document.getElementById("sizevariation").value
        formData.append('variationId', variationId);
        alert(variationId)

        // Gửi dữ liệu qua AJAX
        fetch('Backend/controller/admin/adminAjax.php', {
                method: 'POST',
                body: formData,
            })
            .then((response) => {
                if (!response.ok) {
                    throw new Error(`Fetch error: ${response.status}`);
                }
                return response.json();
            })
            .then((data) => {
                console.log('Response:', data);
                alert(data.message); // Hiển thị thông báo từ server
            })
            .catch((error) => {
                console.error('Error:', error);
            });
        location.reload();
    }
</script>









<script>
    var variationId = null

    function ChiTietVariation(id) {
        variationId = id
        document.getElementById("sizevariation").value = id
        fetch(`Backend/controller/admin/adminAjax.php?variationId=${id}`)
            .then((res) => {
                if (!res.ok) {
                    throw new Error(`Fetch error: ${res.status}`);
                }
                return res.json();
            })
            .then((data) => {
                console.log("Updated data:", data);
                renderProductSizes(data.dataSize);
                renderProductImages(data.dataImage);
                // Hiển thị thông báo dựa trên phản hồi từ backend
                if (data.status === 'success') {
                    // alert(data.message); // Cập nhật thành công
                } else {
                    alert(data.message); // Cập nhật thất bại
                }
            })
            .catch((error) => {
                console.error("Error connecting to server:", error);
            });
    }

    // Hàm hiển thị Product Sizes
    function renderProductSizes(dataSize) {
        const sizeTableBody = document.getElementById('sizeTableBody');
        sizeTableBody.innerHTML = ''; // Xóa dữ liệu cũ

        dataSize.forEach(size => {
            const row = `
            <tr>
                <td>${size.sizeId}</td>
                <td>${size.sizeCode}</td>
                <td>${size.size}</td>
                <td>${size.quantity}</td>
                <td>${size.variationId}</td>
                <td>
                    <button class="btn btn-info btn-sm" onclick="viewSizeDetails(${size.sizeId})">Edit</button>
                    <button class="btn btn-danger btn-sm" onclick="deleteSize(${size.sizeId})">Delete</button>
                </td>
            </tr>
        `;
            sizeTableBody.insertAdjacentHTML('beforeend', row);
        });
    }

    // Hàm hiển thị Product Detail Images
    function renderProductImages(dataImage) {
        const detailImageTableBody = document.getElementById('detailImageTableBody');
        detailImageTableBody.innerHTML = ''; // Xóa dữ liệu cũ

        dataImage.forEach((image, index) => {
            const row = `
            <tr>
                <td>${index + 1}</td>
                <td><img src="${image.image}" alt="Detail Image" style="width: 50px; height: auto;"></td>
                <td>
                    <button class="btn btn-info btn-sm" onclick="viewDetailImage(${image.variationimageId})">Edit</button>
                    <button class="btn btn-danger btn-sm" onclick="deleteDetailImage(${image.variationimageId})">Delete</button>
                </td>
            </tr>
        `;
            detailImageTableBody.insertAdjacentHTML('beforeend', row);
        });
    }

    // Gọi hàm hiển thị dữ liệu


    function addVariation() {
        const form = document.querySelector("#addVariationForm");
        if (form.style.display === "block") {
            form.style.display = "none";
        } else {
            form.style.display = "block";
        }
    }

    function toggleAddVariationForm() {
        const form1 = document.querySelector("#addVariationForm");
        const form2 = document.querySelector("#addVariationForm3");
        const form3 = document.querySelector("#addSize");
        form1.style.display = "none";
        form2.style.display = "none";
        form3.style.display = "none";
    }



    // Hàm View và Delete (mẫu)
    function viewSizeDetails(id) {
        alert(`Xem chi tiết size với ID: ${id}`);
    }

    function deleteSize(id) {
        if (confirm('Bạn có muốn xóa nó không')) {
            fetch(`Backend/controller/admin/adminAjax.php?deleteSizeVariation=${id}`)
                .then((res) => {
                    if (!res.ok) {
                        throw new Error(`Fetch error: ${res.status}`);
                    }
                    return res.json();
                })
                .then((data) => {
                    console.log("Updated data:", data);
                    // Hiển thị thông báo dựa trên phản hồi từ backend
                    if (data.status === 'success') {
                        alert(data.message); // Cập nhật thành công
                    } else {
                        alert(data.message); // Cập nhật thất bại
                    }
                })
                .catch((error) => {
                    console.error("Error connecting to server:", error);
                });

            // Làm mới trang hiện tại
            location.reload();
        }
        return
    }

    function viewDetailImage(id) {
        alert(`Xem chi tiết hình ảnh với ID: ${id}`);
    }

    function deleteDetailImage(id) {
        if (confirm('Bạn có muốn xóa nó không')) {
            fetch(`Backend/controller/admin/adminAjax.php?DeleteImageVariation=${id}`)
                .then((res) => {
                    if (!res.ok) {
                        throw new Error(`Fetch error: ${res.status}`);
                    }
                    return res.json();
                })
                .then((data) => {
                    console.log("Updated data:", data);
                    // Hiển thị thông báo dựa trên phản hồi từ backend
                    if (data.status === 'success') {
                        alert(data.message); // Cập nhật thành công
                    } else {
                        alert(data.message); // Cập nhật thất bại
                    }
                })
                .catch((error) => {
                    console.error("Error connecting to server:", error);
                });

            // Làm mới trang hiện tại
            // location.reload();
        }
        return
    }

    function addSize() {
        const form = document.querySelector("#addSize");
        if (variationId !== null) {
            form.style.display = "block";
            document.getElementById("sizevariation").value = variationId
        } else

            alert("Vui lòng chọn một biến thể sản phẩm");
    }

    function addDetailImage() {
        const form = document.querySelector("#addVariationForm3");

        if (variationId !== null) {
            document.getElementById("sizevariation").value = variationId
            form.style.display = "block";
        } else

            alert("Vui lòng chọn một biến thể sản phẩm");
    }
</script>

<script>
    function handleSingleImagePreview(event) {
        const inputFile = event.target;
        const file = inputFile.files[0]; // Lấy file đầu tiên nếu có

        // Tìm phần tử preview image
        const previewImage = inputFile.closest('.col-md-3').querySelector('.previewImage');

        // Xóa ảnh cũ nếu có
        if (previewImage) {
            previewImage.style.display = 'none';
            previewImage.src = '';
        }

        // Kiểm tra nếu có file ảnh được chọn
        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function(e) {
                // Hiển thị ảnh xem trước
                previewImage.src = e.target.result;
                previewImage.style.display = 'block';
            };
            reader.readAsDataURL(file); // Đọc file và tạo URL xem trước
        }
    }

    function handleMultipleImagesPreview(event) {
        const inputFile = event.target;
        const files = inputFile.files; // Lấy danh sách tất cả các file

        // Tìm container để hiển thị ảnh xem trước
        const previewContainer = inputFile.closest('.col-md-3').parentElement.querySelector('.previewContainer3');

        // Xóa tất cả ảnh cũ trong container
        if (previewContainer) {
            previewContainer.innerHTML = '';
        }

        // Kiểm tra và hiển thị ảnh cho mỗi file
        if (files.length > 0) {
            Array.from(files).forEach((file) => {
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        // Tạo phần tử ảnh và thêm vào container
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.style.width = '100px';
                        img.style.height = 'auto';
                        img.style.border = '1px solid #ddd';
                        img.style.borderRadius = '5px';
                        img.style.boxShadow = '0 2px 4px rgba(0, 0, 0, 0.1)';
                        previewContainer.appendChild(img);
                    };
                    reader.readAsDataURL(file); // Đọc file và tạo URL xem trước
                }
            });
        }
    }

    // Đảm bảo các phần tử tồn tại trước khi gắn sự kiện
    document.addEventListener('DOMContentLoaded', () => {
        const newVariationImage = document.querySelector('.newVariationImage');
        const newVariationImage3 = document.querySelector('.newVariationImage3');

        if (newVariationImage) {
            newVariationImage.addEventListener('change', handleSingleImagePreview);
        }

        if (newVariationImage3) {
            newVariationImage3.addEventListener('change', handleMultipleImagesPreview);
        }
    });
</script>

<script>
    function deleteVariation(id) {

        if (confirm('Bạn có muốn xóa nó không')) {
            fetch(`Backend/controller/admin/adminAjax.php?deleteVariationId=${id}`)
                .then((res) => {
                    if (!res.ok) {
                        throw new Error(`Fetch error: ${res.status}`);
                    }
                    return res.json();
                })
                .then((data) => {
                    console.log("Updated data:", data);
                    // Hiển thị thông báo dựa trên phản hồi từ backend
                    if (data.status === 'success') {
                        alert(data.message); // Cập nhật thành công
                    } else {
                        alert(data.message); // Cập nhật thất bại
                    }
                })
                .catch((error) => {
                    console.error("Error connecting to server:", error);
                });

            // Làm mới trang hiện tại
            location.reload();
        }
        return
    }
</script>