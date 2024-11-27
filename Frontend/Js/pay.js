// Lấy phần tử select
const addressSelect = document.getElementById('address');

// Thêm sự kiện "change" vào phần tử select
addressSelect.addEventListener('change', function () {
    // Lấy giá trị value của tùy chọn được chọn
    const selectedValue = this.value;
    
    // Hiển thị giá trị bằng alert
    alert(`ID của tỉnh/thành phố được chọn là: ${selectedValue}`);
});
