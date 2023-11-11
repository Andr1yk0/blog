import {Editor} from "@toast-ui/editor";
import '@toast-ui/editor/dist/toastui-editor.css';

const form = document.querySelector('#editPostForm');

Alpine.store('editPostForm', {
    postDescriptionLength: 0,
});

const setPostDescriptionLength = (editor) => {
    let html = editor.getHTML()
    let element = (new DOMParser()).parseFromString(html, "text/html")
        .querySelector('body>*:first-child');
    if (element.tagName !== 'P') {
        Alpine.store('editPostForm').postDescriptionLength = 0;
        return;
    }
    console.log(element.textContent, element.textContent.length);
    Alpine.store('editPostForm').postDescriptionLength = element.textContent.length;
}

const editor = new Editor({
    el: form.querySelector('#editor'),
    initialEditType: 'markdown',
    previewStyle: window.innerWidth >= 1024 ? 'vertical' : 'tab',
    height: '500px',
    initialValue: form.querySelector('[name="body_markdown"]').value,
    usageStatistics: false,
    linkAttributes: {target: '_blank'},
    events: {
        load: (editor) => {
            setPostDescriptionLength(editor);
        }
    }
});

editor.addHook('change', () => {
    setPostDescriptionLength(editor);
});


form.addEventListener('submit', (e) => {
    const descriptionLength = Alpine.store('editPostForm').postDescriptionLength
    if (
        (descriptionLength < 100 || descriptionLength > 170) &&
        !confirm(`Are you sure you want to continue with description lenght ${descriptionLength} ?`)
    ) {
        e.preventDefault();
        e.stopPropagation();
        return false;
    }
    form.querySelector('[name="body_markdown"]').value = editor.getMarkdown();
    form.querySelector('[name="body_html"]').value = editor.getHTML();
    return true;
});

