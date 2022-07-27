import * as bootstrap from "bootstrap";
window.bootstrap = bootstrap;
import './lazy-image';
import './confirm';
import './modal';
import './alpine';
import './menu';
import './quill';
import './datetime';
import './tab';
import './tagify';
import './CopyTextToClipboard';
const livewireRequestMessageProcessed = () => {
    Livewire.hook('message.processed', (message, component) => {
        setTimeout(() => {
            document.dispatchEvent(new Event('devhau:turbo', {}));
        }, 10);
    });
}
document.addEventListener("DOMContentLoaded", function (event) {
    if (!window.livewireRequestMessageProcessed) {
        window.livewireRequestMessageProcessed = true;
        livewireRequestMessageProcessed();
    }
});