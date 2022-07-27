import Tagify from '@yaireo/tagify';

const loadTagWithoutLivewire = () => {
    document.querySelectorAll('.el-tag').forEach((item) => {
        if (item.getAttribute('el-tag') == 'true' || item.tagName != 'INPUT') return;
        item.setAttribute('el-tag', 'true');
        var tagify = new Tagify(item, {
            originalInputValueFormat: valuesArr => valuesArr.map(item => item.value).join(', ')
        });
        tagify.on('change', () => {
            item.dispatchEvent(new Event('input'));
        });
    });
}
document.addEventListener("DOMContentLoaded", function (event) {
    document.addEventListener("devhau:turbo", function (event) {
        loadTagWithoutLivewire();
    });
    loadTagWithoutLivewire();
});