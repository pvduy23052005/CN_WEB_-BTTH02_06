const avatarImg = document.getElementById('avatarPreview');
const avatarUpload = document.getElementById('avatarUpload');
const accountBtn = document.querySelector('.account');

// Khi click vào khu vực account → mở chọn ảnh
accountBtn.addEventListener('click', () => {
    avatarUpload.click();
});

// Khi chọn ảnh → hiển thị lên avatar
avatarUpload.addEventListener('change', function () {
    const file = this.files[0];
    if (file) {
        const imageURL = URL.createObjectURL(file);
        avatarImg.src = imageURL;
    }
});
