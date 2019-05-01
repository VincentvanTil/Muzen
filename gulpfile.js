var elixir = require('laravel-elixir');

elixir(function(mix) {
    mix.copy("assets/fonts/bootstrap",'public/fonts');
    mix.sass([
        'app.scss',
        'style.scss'
    ]);
});
