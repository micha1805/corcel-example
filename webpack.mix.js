/* global __dirname, path */

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

mix.webpackConfig({
    resolve: {
        alias: {
            api: path.resolve(__dirname, 'resources/assets/js/api/'),
            atoms: path.resolve(__dirname, 'resources/assets/js/components/atoms/'),
            molecules: path.resolve(__dirname, 'resources/assets/js/components/molecules/'),
            views: path.resolve(__dirname, 'resources/assets/js/components/views/'),
        },
    },
});

mix
    .js('resources/assets/js/app.js', 'public/scripts')
    .sass('resources/assets/sass/app.scss', 'public/styles')
    .copyDirectory('resources/assets/images', 'public/images');

mix.browserSync('localhost');
