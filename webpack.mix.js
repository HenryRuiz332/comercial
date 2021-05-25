const mix = require('laravel-mix');




mix.js('comercial_vue/app.js', 'public/app/main.js').vue()
    .postCss('resources/css/app.css', 'public/css');