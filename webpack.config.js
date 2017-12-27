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
    .enableSassLoader()
;

module.exports = Encore.getWebpackConfig();
