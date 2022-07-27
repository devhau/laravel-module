import Quill from 'quill';
//import { ImageResize } from 'quill-image-module';
const loadQuillWithoutLivewire = () => {
    var toolbarOptions = [
        [{ 'font': [] }, { 'size': [] }],
        ['bold', 'italic', 'underline', 'strike'],
        [{ 'color': [] }, { 'background': [] }],
        [{ 'script': 'super' }, { 'script': 'sub' }],
        [{ 'header': '1' }, { 'header': '2' }, 'blockquote', 'code-block'],
        [{ 'list': 'ordered' }, { 'list': 'bullet' }, { 'indent': '-1' }, { 'indent': '+1' }],
        ['direction', { 'align': [] }],
        ['link', 'image', 'video', 'formula'],
        ['clean']
    ];
    var optionsQuill = {
        modules: {
            /*imageResize: {
                displaySize: true
            },*/
            toolbar: toolbarOptions
        },
        placeholder: 'Content ...',
        theme: 'snow'
    };
    [].slice.call(document.querySelectorAll('.el-quill')).map(function (el) {
        var elContainer = el;
        if (el.type == 'textarea') {
            elContainer = document.createElement('div');
            elContainer.innerHTML = el.value;
            el.parentNode.insertBefore(elContainer, el.nextSibling);
            el.style.display = "none";
        }
        var elQuill = new Quill(elContainer, optionsQuill);
        elQuill.on('text-change', function (delta, oldDelta, source) {
            el.value = elQuill.root.innerHTML;
            el.dispatchEvent(new Event('input'));
        });
        el.classList.remove("el-quill");

    });
};
document.addEventListener('DOMContentLoaded', () => {
    document.addEventListener("devhau:turbo", function (event) {
        loadQuillWithoutLivewire();
    });
    loadQuillWithoutLivewire();
});