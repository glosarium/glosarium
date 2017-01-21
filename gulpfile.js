const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(mix => {
    mix.less('theme.less', 'public/css/theme.css');

    mix.scripts('theme.js', 'public/js/theme.js');
    mix.scripts('dictionary.js', 'public/js/dictionary.js');
});
