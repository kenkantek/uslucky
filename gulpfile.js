var elixir = require('laravel-elixir');

require('laravel-elixir-vueify');

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

elixir(function(mix) {
    mix.copy('public/css/images', 'public/build/css/images');
    mix.sass('app.scss');
    mix.sass('admin/admin.scss');

    mix.browserify('app.js');
    mix.browserify('admin/admin.js');

    mix.version([
    	'css/app.css',
    	'js/app.js',
        'css/admin.css',
        'js/admin.js'
	]);
});
