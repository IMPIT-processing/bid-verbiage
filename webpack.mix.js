const mix = require('laravel-mix');
require('laravel-mix-tailwind');

mix.js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css')
   .tailwind('./tailwind.config.js')
   .sourceMaps();

mix.copy('node_modules/bootstrap/dist/css/bootstrap.min.css', 'public/css/bootstrap.css');
mix.copy('node_modules/tailwindcss/dist/tailwind.css', 'public/css/tailwind.css');
mix.copy('node_modules/bootstrap/dist/js/bootstrap.bundle.min.js', 'public/js/bootstrap.js');
