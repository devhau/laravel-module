import flatpickr from "flatpickr";
const loadDateTimeWithoutLivewire = () => {
    [].slice.call(document.querySelectorAll('.el-date')).map(function (el) {
        new flatpickr(el, {});
        el.classList.remove("el-date");
    });
};
document.addEventListener('DOMContentLoaded', () => {
    document.addEventListener("devhau:turbo", function (event) {
        loadDateTimeWithoutLivewire();
    });
    loadDateTimeWithoutLivewire();
});