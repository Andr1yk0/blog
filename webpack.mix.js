const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/admin/admin.js', 'public/js')
    .js('resources/js/admin/edit-post-form.js', 'public/js/admin')
    .js('resources/js/components/tag-select.js', 'public/js/components')
    .js('resources/js/components/theme-switch.js', 'public/js/components')
    .js('resources/js/pages/posts-show.js', 'public/js/pages')
    .js('resources/js/directives/tooltip.js', 'public/js/directives')
    .sass('resources/scss/app.scss', 'public/css')
    .version();
