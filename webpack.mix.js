let mix = require('laravel-mix');

mix.js("src/js/app.js", "dist/")
mix.sass("src/scss/app.scss", "dist/");

mix.browserSync({
    proxy: "http://test.test/",
    files: ["./**/*.php", "./dist/**/*.*"],
});