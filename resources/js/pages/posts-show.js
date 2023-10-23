import hljs from "highlight.js";
import 'highlight.js/styles/github-dark-dimmed.css';

hljs.registerLanguage('javascript', require(`highlight.js/lib/languages/javascript`));
hljs.registerLanguage('php', require(`highlight.js/lib/languages/php`));
hljs.registerLanguage('html', require(`highlight.js/lib/languages/xml`));
hljs.registerLanguage('css', require(`highlight.js/lib/languages/css`));
hljs.registerLanguage('bash', require(`highlight.js/lib/languages/bash`));
hljs.registerLanguage('sql', require(`highlight.js/lib/languages/sql`));
hljs.registerLanguage('typescript', require(`highlight.js/lib/languages/typescript`));
hljs.registerLanguage('yaml', require(`highlight.js/lib/languages/yaml`));
hljs.registerLanguage('json', require(`highlight.js/lib/languages/json`));
hljs.registerLanguage('dockerfile', require(`highlight.js/lib/languages/dockerfile`));
hljs.registerLanguage('plaintext', require(`highlight.js/lib/languages/plaintext`));

document.querySelectorAll('pre code').forEach((block) => {
    console.log(block.dataset.language);
    block.innerHTML = hljs.highlight(block.textContent, {language: block.dataset.language}).value;
});
