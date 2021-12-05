const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.options({
    postCss: [require("tailwindcss")("./tailwind.config.js")]
})

mix.js('resources/js/app.js', 'public/js')
    .vue({version:3})
    .extract(['vue', 'axios','ant-design-vue','velocity-animate','@inertiajs','@kyvg','vuex'])
    .postCss('resources/css/app.css', 'public/css', [
        require('postcss-import'),
        require('tailwindcss'),
        require('autoprefixer'),
    ])
    .webpackConfig(require('./webpack.config'));



if (mix.inProduction()) {
    mix.version();
}
