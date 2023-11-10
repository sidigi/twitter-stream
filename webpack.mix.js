const mix = require('laravel-mix');

/*admin*/
mix.js('resources/assets/admin/js/app.js', 'public/build/admin/js')
   .sass('resources/assets/admin/sass/app.scss', 'public/build/admin/css')
   .version();

/*index*/
mix.js('resources/assets/index/js/app.js', 'public/build/index/js')
    .sass('resources/assets/index/sass/app.scss', 'public/build/index/css')
    .version();