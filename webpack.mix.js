// webpack.mix.js
let extract = false;
let mix = require('laravel-mix');
mix.disableSuccessNotifications();
mix.options({
    legacyNodePolyfills: true,
});
mix.js('resources/js/index.js', 'dist/devhau-module.js');
mix.js('resources/js/turbolinks.js', 'dist/devhau-turbolinks.js');
mix.js('resources/js/admin.js', 'dist/devhau-admin.js');
mix.sass('resources/scss/admin.scss', 'dist/devhau-admin.css');
if (extract) {
    mix.sass('resources/scss/core.scss', 'dist/devhau-module.css');
    mix.sass('resources/scss/vendor.scss', 'dist/vendor.css');
    mix.extract();
} else {
    mix.sass('resources/scss/index.scss', 'dist/devhau-module.css');
}