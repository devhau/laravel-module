const menuItemClass = 'menu-item';
const initMenu = () => {
    document.querySelectorAll('.menu-action').forEach((item) => {
        if (item.getAttribute('menu-action') == 'true') return;
        item.setAttribute('menu-action', 'true');
        item.addEventListener('click', (e) => {
            let menuItem = undefined;
            if (e.target && e.target.classList.contains(menuItemClass)) {
                menuItem = e.target;
            }
            if (e.target && !menuItem) {
                menuItem = e.target.closest("." + menuItemClass);
            }
            if (menuItem && menuItem.querySelector('.menu-sub')) {
                if (menuItem.classList.contains('active')) {
                    menuItem.classList.remove('active');
                    menuItem.querySelectorAll('.active').forEach((itemAction) => {
                        itemAction.classList.remove('active');
                    })
                } else {
                    menuItem.closest('.menu').querySelectorAll('.active').forEach((itemAction) => {
                        itemAction.classList.remove('active');
                    });
                    menuItem.classList.add('active');
                }
            }
        })
    });
}
document.addEventListener("DOMContentLoaded", function (event) {
    document.addEventListener("devhau:turbo", function (event) {
        initMenu();
    });
    initMenu();
});