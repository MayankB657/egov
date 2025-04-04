const mix = require('laravel-mix');

mix.sass('public/css/style.scss', 'public/css/style.css').options({
    processCssUrls: false
});
