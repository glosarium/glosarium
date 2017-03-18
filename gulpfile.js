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
	mix.sass('app.scss', 'public/bootstrap.css');
    mix.less('theme.less', 'public/css/theme.css');
    mix.styles([
    	'timeline.css'
    ], 'public/css/custom.css');
    mix.webpack('app.js', 'public/js/app.js');

    mix.browserify('theme.js', 'public/js/theme.js');
    mix.browserify('category.js', 'public/js/category.js');
    mix.browserify('showCategory.js', 'public/js/showCategory.js');
    mix.browserify('word.js', 'public/js/word.js');
});
