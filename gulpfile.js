var elixir = require('laravel-elixir');
require('laravel-elixir-vueify');

elixir(function(mix) {
    mix.copy('resources/assets/vendor/font-awesome/fonts', 'public/fonts');
});

elixir(function(mix) {
    mix.sass('bootstrap.sass')
        .scripts([
            './resources/assets/vendor/jquery/dist/jquery.min.js',
            './resources/assets/vendor/bootstrap/dist/js/bootstrap.min.js'],
            'public/js/bootstrap.js')

        .sass('app.sass')
        .browserify('app.js')

        .sass('vue-device.sass')
        .browserify('vue-device.js')

        .browserify('vue-repeater.js')

        .browserSync({
            proxy: 'rh-temp.me'
        });
    });



