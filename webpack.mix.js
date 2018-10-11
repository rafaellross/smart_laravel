let mix = require('laravel-mix');

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



mix.js('resources/assets/js/app.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css');

mix.js('resources/assets/js/scripts.js', 'public/js');


mix.js('resources/assets/js/employee_application.js', 'public/js');
mix.js('resources/assets/js/qa.js', 'public/js');

mix.js('resources/assets/js/tmv.js', 'public/js');

mix.js('resources/assets/js/forms.js', 'public/js');
mix.js('resources/assets/js/parameters.js', 'public/js');
