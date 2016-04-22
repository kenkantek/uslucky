var elixir = require('laravel-elixir'),
    shell = require('gulp-shell'),
    gulp = require('gulp');

var Task = elixir.Task;
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

 elixir.extend("langjs", function(path) {
    new Task('langjs', function() {
        return gulp.src('').pipe(shell("php artisan lang:js -c " + (path || "public/js/lang.min.js")));
    })
    .watch('./resources/lang/**');
 });

 elixir.extend("laroute", function() {
     new Task('laroute', function() {
         return gulp.src('').pipe(shell("php artisan laroute:generate"));
     })
     .watch('./app/Http/routes.php');
 });

elixir(function(mix) {
    mix.langjs();
    mix.laroute();
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
