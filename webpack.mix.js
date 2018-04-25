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

/*
mix.react('resources/assets/js/components/TimeSheet.js', 'public/js/components');
mix.react('resources/assets/js/components/Title.js', 'public/js/components');
mix.react('resources/assets/js/components/Autofill.js', 'public/js/components');
mix.react('resources/assets/js/components/Day.js', 'public/js/components');
mix.react('resources/assets/js/components/Job.js', 'public/js/components');
mix.react('resources/assets/js/components/Special.js', 'public/js/components');
mix.react('resources/assets/js/components/Total.js', 'public/js/components');
mix.react('resources/assets/js/components/Signature.js', 'public/js/components');
*/


mix.js('resources/assets/js/app.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css');

mix.js('resources/assets/js/custom.js', 'public/js')
