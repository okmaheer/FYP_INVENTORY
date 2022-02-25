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

mix.js('resources/dashboard/js/app.js', 'public/js')
    .sass('resources/sass/dashboard.scss', 'public/dashboard/vendor.min.css')
    .scripts([
        'resources/dashboard/js/jquery.min.js',
        'resources/dashboard/js/bootstrap.bundle.min.js',
        'resources/dashboard/js/metisMenu.min.js',
        'resources/dashboard/js/waves.min.js',
        'resources/dashboard/js/jquery.slimscroll.min.js',
        'resources/dashboard/js/app.js'
    ], 'public/dashboard/vendor.min.js')
    .copy([
        'resources/dashboard/fonts',
    ], 'public/dashboard/fonts')
    .copy([
        'resources/dashboard/icons',
    ], 'public/dashboard/icons')
    .copy([
        'resources/dashboard/images',
    ], 'public/dashboard/images')
    .copy([
        'resources/dashboard/accounts/admin_js',
    ], 'public/js/admin_js')
    .copy([
        'resources/dashboard/accounts/css',
    ], 'public/css')
    .copy([
        'resources/dashboard/textile/css',
    ], 'public/dashboard/textile/css')
    .copy([
        'resources/dashboard/textile/js',
    ], 'public/dashboard/textile/js')
    .copy([
        'resources/dashboard/marquee/css',
    ], 'public/dashboard/marquee/css')
    .copy([
        'resources/dashboard/marquee/js',
    ], 'public/dashboard/marquee/js')
    .copy([
        'resources/dashboard/plugins',
    ], 'public/dashboard/plugins');
