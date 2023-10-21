import {Editor} from "@toast-ui/editor";
import '@toast-ui/editor/dist/toastui-editor.css';
const form = document.querySelector('#editPostForm');

const editor = new Editor({
    el: form.querySelector('#editor'),
    initialEditType: 'markdown',
    previewStyle: window.innerWidth >= 1024 ? 'vertical' : 'tab',
    height: '500px',
    initialValue: form.querySelector('[name="body_markdown"]').value,
    usageStatistics: false,
});

form.addEventListener('submit', () => {
    form.querySelector('[name="body_markdown"]').value = editor.getMarkdown();
    form.querySelector('[name="body_html"]').value = editor.getHTML();
    return true;
});

