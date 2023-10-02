const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/admin/edit-post-form.js', 'public/js/admin')
    .sass('resources/scss/app.scss', 'public/css')
    .sass('resources/scss/admin.scss', 'public/css')
