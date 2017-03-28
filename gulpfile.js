const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for your application, as well as publishing vendor resources.
 |
 */

process.env.DISABLE_NOTIFIER = true;

elixir((mix) => {
	mix.sass('app.scss', 'public/bootstrap.css');
    mix.less('theme.less', 'public/css/theme.css');
    mix.styles([
    	'timeline.css'
    ], 'public/css/custom.css');
    mix.webpack('app.js', 'public/js/app.js');

    mix.browserify('theme.js', 'public/js/theme.js');
    mix.browserify('api.js', 'public/js/api.js');

    // highlight.js
    mix.copy('node_modules/highlight.js/styles/monokai.css', 'public/css/');

    // glosarium
    mix.browserify('glosarium/category/index.js', 'public/js/glosarium/category.index.js');
    mix.browserify('glosarium/category/show.js', 'public/js/glosarium/category.show.js');

    mix.browserify('glosarium/word/index.js', 'public/js/glosarium/word.index.js');
    mix.browserify('glosarium/word/create.js', 'public/js/glosarium/word.create.js');
    mix.browserify('glosarium/word/show.js', 'public/js/glosarium/word.show.js');

    // user
    mix.browserify('user/register.js', 'public/js/user.register.js');

    // contact
    mix.browserify('contact/form.js', 'public/js/contact.form.js');

    mix.browserSync({
        proxy: 'glosarium.dev'
    })
});
