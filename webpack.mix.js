const mix = require('laravel-mix');
require('laravel-mix-purgecss');

mix.js('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css');

mix.copyDirectory('vendor/tinymce/tinymce', 'public/js/tinymce');

mix.scripts([
    'public/assets/admins/js/bundle41fe.js',
    'public/assets/admins/js/scripts41fe.js',
    'public/assets/admins/js/demo-settings41fe.js'
], 'public/js/admins.js');
