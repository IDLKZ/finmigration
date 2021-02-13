const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

// mix.js('resources/js/app.js', 'public/js')
//     .postCss('resources/css/app.css', 'public/css', [
//         //
//     ]);

mix.styles([
    'resources/backend/assets/css/app.css',
], 'public/css/admin.css')
//
mix.scripts([
    'resources/backend/assets/js/core/jquery.min.js',
    'resources/backend/assets/js/core/popper.min.js',
    'resources/backend/assets/js/core/bootstrap-material-design.min.js',
    'resources/backend/assets/js/plugins/perfect-scrollbar.jquery.min.js',
    'resources/backend/assets/js/material-dashboard.js',
    'resources/backend/assets/demo/demo.js',
], 'public/admin.js')

// mix.copy('resources/backend/assets/img', 'public/img')
