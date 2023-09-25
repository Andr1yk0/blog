import {Editor} from "@toast-ui/editor";
import '@toast-ui/editor/dist/toastui-editor.css';
let slugify = require('slugify');

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

const generateSlugButton = form.querySelector('#generateSlugBtn');
generateSlugButton.addEventListener('click', () => {
    console.log('hi');
    const input = generateSlugButton.parentElement.querySelector('input');
    if(input.value === '' || confirm('Are you sure you want to generate a new slug?')) {
        console.log(form.querySelector('[name="title"]').value);
        input.value = slugify(form.querySelector('[name="title"]').value, {lower: true});
    }
});

if(Object.keys(validationErrors).length > 0) {
    for(let key in validationErrors) {
        const element = document.querySelector(`[name="${key}"]`);
        if(element) {
            element.classList.add('is-invalid');
            let invalidFeedback = element.parentElement.querySelector('.invalid-feedback');
            if(!invalidFeedback) {
                invalidFeedback = document.createElement('div');
                invalidFeedback.classList.add('invalid-feedback');
                element.parentElement.appendChild(invalidFeedback);
            }
            invalidFeedback.innerHTML = validationErrors[key].join('. ');
        }
    }
}

