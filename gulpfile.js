var elixir = require('laravel-elixir');
require('laravel-elixir-vueify');

elixir(function(mix) {
    mix.copy('resources/assets/vendor/font-awesome/fonts', 'public/fonts');
});

elixir(function(mix) {
    mix.sass('app.sass')
    .browserify('app.js')
    .browserSync({
    	proxy: 'rh-temp.me'
    });
});



