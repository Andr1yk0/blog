import {Editor} from "@toast-ui/editor";
import '@toast-ui/editor/dist/toastui-editor.css';
import {bundledLanguages, getHighlighter} from "shiki";
import html2canvas from "html2canvas";

const highlighterTheme = 'nord';
const highlightLangs = Object.keys(bundledLanguages)

Alpine.data('editPostForm', (postTitle, imageLang) => ({
    postTitle: postTitle,
    imageText: window.imageText,
    imageTextHighlighted: null,
    base64Image: null,
    highlightLangs: highlightLangs,
    selectedLang: imageLang,
    init() {
        setTimeout(() => {
            this.highlightImagePreview();
        }, 1000)
        this.$watch('imageText, selectedLang', () => {
            this.highlightImagePreview()
        })
    },
    highlightImagePreview() {
        this.imageTextHighlighted = highlighter.codeToHtml(this.imageText, {
            theme: highlighterTheme,
            lang: this.selectedLang,
        })
    },
    createImage() {
        const element = document.getElementById('thumbnailPreview');
        Alpine.store('loader', true);
        html2canvas(element).then((canvas) => {
            this.base64Image = canvas.toDataURL('image/jpeg');
            Alpine.store('loader', false);
        });
    }
}));
Alpine.store('editPostForm', {
    postDescriptionLength: 0,
});

window.highlighter = await getHighlighter({
    themes: [highlighterTheme],
    langs: highlightLangs
})

const form = document.querySelector('#editPostForm');
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
            if (highlightLangs.includes(node.info)) {
                content = highlighter.codeToHtml(content, {
                    theme: highlighterTheme,
                    lang: node.info
                });
                content = (new DOMParser())
                    .parseFromString(content, 'text/html')
                    .querySelector('pre code')
                    .innerHTML;
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
    },
    hooks: {
        addImageBlobHook(file, callback) {
            const formData = new FormData();
            formData.append('image', file);
            Alpine.store('loader', true);
            fetch('/admin/posts/upload-image', {
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                method: 'POST',
                body: formData,
            })
                .then((response) => {
                    return response.json();
                })
                .then((data) => {
                    callback(data.path);
                })
                .catch((error) => {
                    Alpine.store('notifications').add({
                        type: 'error',
                        message: error.message ? error.message : 'Something went wrong',
                    })
                })
                .finally(() => {
                    Alpine.store('loader', false);
                })
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
        !confirm(`Are you sure you want to continue with description length ${descriptionLength} ?`)
    ) {
        e.preventDefault();
        e.stopPropagation();
        return false;
    }
    form.querySelector('[name="body_markdown"]').value = editor.getMarkdown();
    let html = document.querySelector('.toastui-editor-md-preview .toastui-editor-contents').innerHTML;
    html = html.replace(/data-nodeid="\d+"/ig, '')
    form.querySelector('[name="body_html"]').value = html;
    return true;
});