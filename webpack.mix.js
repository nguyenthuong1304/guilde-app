const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
  .js('resources/js/select2.js', 'public/js/admin')
  .sass('resources/sass/app.scss', 'public/css')
  .css('resources/css/admin/app.css', 'public/admin/css')
  .css('resources/css/app.css', 'public/css/style.css')
  .copy('node_modules/simplemde/dist/simplemde.min.css', 'public/admin/simplemde.min.css')
  .copy('node_modules/simplemde/dist/simplemde.min.js', 'public/admin/simplemde.min.js')
  .copy('node_modules/markdown-it/dist/markdown-it.min.js', 'public/js/markdown-it.min.js')
  .copyDirectory('resources/images', 'public/images')
  .sourceMaps();
