const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for your application as well as publishing vendor resources.
 |
 */

elixir((mix) => {
    mix
        .sass(['/admin/app.scss'], 'public/css/admin.css')
        .sass('app.scss')
       .webpack('/admin/app.js', 'public/js/admin.js')
       .webpack('app.js')
       .version(['css/admin.css', 'css/app.css' , 'js/admin.js', 'js/app.js']);
});
