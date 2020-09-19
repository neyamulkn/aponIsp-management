const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.styles([
    'resources/scripts/css/style.min.css',
    'resources/scripts/css/custom.css',
    'resources/scripts/css/toastr.css',
    'resources/scripts/css/pages/floating-label.css'
], 'public/css/app.css');

mix.js('resources/js/app.js', 'public/js/laravel-echo.js');

mix.scripts([
    'resources/scripts/js/jquery-3.2.1.min.js',
    'resources/scripts/js/popper.min.js',
    'resources/scripts/js/bootstrap.min.js',
    'resources/scripts/js/perfect-scrollbar.jquery.min.js',
    'resources/scripts/js/waves.js',
    'resources/scripts/js/sidebarmenu.js',
    'resources/scripts/js/custom.min.js',
    'resources/scripts/js/toastr.js'
], 'public/js/app.js');

if(mix.inProduction()){
	mix.version();
}