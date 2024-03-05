import {Editor} from "@toast-ui/editor";
import '@toast-ui/editor/dist/toastui-editor.css';
import {bundledLanguages, getHighlighter} from "shiki";

const highlighterTheme = 'nord';
let highlighter = null;
const highlightLangs = Object.keys(bundledLanguages)
getHighlighter({
    themes: [highlighterTheme],
    langs: Object.keys(bundledLanguages)
}).then((shiki) => {
    highlighter = shiki;
});
const form = document.querySelector('#editPostForm');

Alpine.store('editPostForm', {
    postDescriptionLength: 0,
});

const setPostDescription = (editor) => {
    const descriptionInput = document.querySelector('textarea[name="meta_description"]')
    let html = editor.getHTML();
    let element = (new DOMParser()).parseFromString(html, "text/html")
        .querySelector('body>*:first-child');
    if (element.tagName !== 'P') {
        Alpine.store('editPostForm').postDescriptionLength = 0;
        descriptionInput.value = '';
        return;
    }
    descriptionInput.value = element.innerText;
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
            setPostDescription(editor);
        },
    },
    customHTMLRenderer: {
        codeBlock(node) {
            let content = node.literal;
            if (highlighter && highlightLangs.includes(node.info)) {
                content = highlighter.codeToHtml(content, {
                    theme: highlighterTheme,
                    lang: node.info
                });
                content = (new DOMParser()).parseFromString(content, 'text/html').querySelector('pre code').innerHTML;
            }
            return [
                {
                    type: 'openTag',
                    tagName: 'pre',
                    classNames: [`lang-${node.info}`, 'shiki', highlighterTheme],
                },
                {type: 'openTag', tagName: 'code', attributes: {'data-language': node.info}},
                {type: 'html', content},
                {type: 'closeTag', tagName: 'code'},
                {type: 'closeTag', tagName: 'pre'},
            ];
        }
    }
});

editor.addHook('change', () => {
    setPostDescription(editor);
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
    let html = document.querySelector('.toastui-editor-md-preview .toastui-editor-contents').innerHTML;
    html = html.replace(/data-nodeid="\d+"/ig,'')

    form.querySelector('[name="body_html"]').value = html;
    return true;
});

