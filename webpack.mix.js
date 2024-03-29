const mix = require('laravel-mix')

/* Allow multiple Laravel Mix applications */
require('laravel-mix-merge-manifest')

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .copyDirectory('resources/fonts/MaterialIcons/!(*.scss)', 'public/fonts/MaterialIcons')
    .js('resources/js/test/categories/index.js', 'public/js/test/categories')
    .js('resources/js/test/test.js', 'public/js/test')
    .mergeManifest()
    .postCss('resources/css/app.css', 'public/css',
    [
        require('postcss-import'),
        require('tailwindcss'),
        require('autoprefixer'),
    ])

if (mix.inProduction()) {
    mix.version()
}
