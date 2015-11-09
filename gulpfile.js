var elixir = require('laravel-elixir');

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
    mix.copy('bower_components/bootstrap/dist/css', 'public/css/vendor/bootstrap');
    mix.copy('bower_components/bootstrap/dist/fonts', 'public/css/vendor/bootstrap/fonts');
    mix.copy('bower_components/datatables/media/css/dataTables.bootstrap.miln.css', 'public/css/vendor');
    mix.copy('bower_components/jquery/dist', 'public/js/vendor');
    mix.copy('bower_components/bootstrap/dist/js', 'public/js/vendor');
    mix.copy('bower_components/datatables/media/js/jquery.dataTables.min.js', 'public/js/vendor');
    mix.copy('bower_components/datatables/media/js/dataTables.bootstrap.min.js', 'public/js/vendor');

    mix.browserify('app.js');
});
