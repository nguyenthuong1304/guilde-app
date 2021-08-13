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

mix.js('resources/js/app.js', 'public/js')
  .sass('resources/sass/app.scss', 'public/css')
  .css('resources/css/admin/app.css', 'public/admin/css')
  .css('resources/css/app.css', 'public/css/style.css')
  .copy('node_modules/simplemde/dist/simplemde.min.css', 'public/admin/simplemde.min.css')
  .copy('node_modules/simplemde/dist/simplemde.min.js', 'public/admin/simplemde.min.js')
  .copy('node_modules/markdown-it/dist/markdown-it.min.js', 'public/js/markdown-it.min.js')
  // .copy('node_modules/select2/dist/js/select2.min.js', 'public/js/select2.min.js')
  // .copy('node_modules/select2/dist/css/select2.min.css', 'public/css/select2.min.css')
  .copyDirectory('resources/images', 'public/images')
  .sourceMaps();
