let initAdmin = () => {
    document.querySelectorAll('.sidebar-mini-btn').forEach((item) => {
        if (item.getAttribute('sidebar-mini-btn') == 'true') return;
        item.setAttribute('sidebar-mini-btn', 'true');
        item.addEventListener('click', (e) => {
            if (document.querySelector('body').classList.contains('sidebar-mini')) {
                document.querySelector('body').classList.remove('sidebar-mini');
            } else {
                document.querySelector('body').classList.add('sidebar-mini')
            }
            e.stopImmediatePropagation();
            e.stopPropagation();
            e.preventDefault();
        });
    })
}
document.addEventListener('DOMContentLoaded', () => {
    document.addEventListener("devhau:turbo", function (event) {
        initAdmin();
    });
    initAdmin();
})