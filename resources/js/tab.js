
const loadTabWithoutLivewire = () => {
    document.querySelectorAll('.tab-wrapper').forEach((item) => {
        if (item.getAttribute('tab-wrapper') == 'true') return;
        item.setAttribute('tab-wrapper', 'true');
        item.querySelectorAll('.tab-item').forEach((tabItem, index) => {
            tabItem.addEventListener('click', (e) => {
                item.querySelectorAll('.tab-item').forEach((_item) => _item.classList.remove('active'));
                item.querySelectorAll('.tab-content').forEach((_item) => _item.classList.remove('active'));
                tabItem.classList.add('active');
                item.querySelectorAll('.tab-content')[index].classList.add('active');
                e.preventDefault && e.preventDefault();
                e.stopImmediatePropagation && e.stopImmediatePropagation();
                e.stopPropagation && e.stopPropagation();
            })
        });

    });
}
document.addEventListener("DOMContentLoaded", function (event) {
    document.addEventListener("devhau:turbo", function (event) {
        loadTabWithoutLivewire();
    });
    loadTabWithoutLivewire();
});