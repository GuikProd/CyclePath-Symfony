let Encore = require('@symfony/webpack-encore');

Encore
    .setOutputPath('public/build/')
    .setPublicPath('/build')
    .cleanupOutputBeforeBuild()
    .enableSourceMaps(!Encore.isProduction())
    .enableVersioning(Encore.isProduction())
    .cleanupOutputBeforeBuild()
    .enableVueLoader()
    .addEntry('home', './assets/vue/public/Core/home.js')
    .addEntry('register', './assets/vue/public/Security/register.js')
    .addEntry('user', './assets/vue/public/User/user.js')
    .enableSassLoader()
    .addStyleEntry('sass_core', './assets/scss/public/core.scss')
    .addStyleEntry('sass_navbar', './assets/scss/public/navbar.scss')
    .addStyleEntry('sass_home', './assets/scss/public/home.scss')
    .addStyleEntry('sass_footer', './assets/scss/public/footer.scss')
;

module.exports = Encore.getWebpackConfig();
