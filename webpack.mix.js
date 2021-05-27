const mix = require("laravel-mix");

mix.copyDirectory("resources/fonts/", "public/css/fonts");

mix.js("resources/js/app.js", "public/js")
    .js("resources/js/awesome/notifications.js", "public/js")
    .postCss("resources/css/app.css", "public/css", [
        require("postcss-import"),
        require("tailwindcss"),
        require("autoprefixer"),
    ]);

if (mix.inProduction()) {
    mix.version();
}
