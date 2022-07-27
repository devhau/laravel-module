function fallbackCopyTextToClipboard(text, callback = null) {
    var textArea = window.document.createElement("textarea");
    textArea.value = text;

    // Avoid scrolling to bottom
    textArea.style.top = "0";
    textArea.style.left = "0";
    textArea.style.position = "fixed";

    window.document.body.appendChild(textArea);
    textArea.focus();
    textArea.select();

    try {
        var successful = window.document.execCommand('copy');
        var msg = successful ? 'successful' : 'unsuccessful';
        console.log('Fallback: Copying text command was ' + msg);
        callback && callback(successful);
    } catch (err) {
        callback && callback(true);
        console.error('Fallback: Oops, unable to copy', err);
    }

    window.document.body.removeChild(textArea);
}
function copyTextToClipboard(text, callback = null) {
    if (!window.navigator.clipboard) {
        fallbackCopyTextToClipboard(text, callback);
        return;
    }
    window.navigator.clipboard.writeText(text).then(function () {
        console.log('Async: Copying to clipboard was successful!');
        callback && callback(true);
    }, function (err) {
        fallbackCopyTextToClipboard(text, callback);
        console.error('Async: Could not copy text: ', err);
    });
}
window.copyTextToClipboard = copyTextToClipboard;