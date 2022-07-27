
function imageLazyLoading(querySelector) {
    var e = [].slice.call(document.querySelectorAll(querySelector));
    if ("IntersectionObserver" in window) {
        let n = new IntersectionObserver(function (e, t) {
            e.forEach(function (e) {
                if (e.isIntersecting) {
                    let t = e.target;
                    (t.src = t.dataset.src), t.classList.remove("lazy-image"), t.classList.remove("lazyload"), n.unobserve(t);
                }
            });
        }, {
            // Add root here so rootBounds in entry object is not null
            root: document.body,
            // Margin to when element should take action
            rootMargin: '-100px 0px',
            // Callback will be fired 30 times during intersection
            threshold: [...Array(30).keys()].map(x => x / 29)
        });
        e.forEach(function (e) {
            n.observe(e);
        });
    }
}

document.addEventListener("DOMContentLoaded", function (event) {
    imageLazyLoading("img.lazy-image");
    imageLazyLoading(".lazyload");
    document.addEventListener('image:lazyloading', function () {
        imageLazyLoading("img.lazy-image");
        imageLazyLoading(".lazyload");
    })
    document.addEventListener("devhau:turbo", function (event) {
        imageLazyLoading("img.lazy-image");
        imageLazyLoading(".lazyload");
    });
});