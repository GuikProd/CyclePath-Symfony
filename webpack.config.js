let Encore = require('@symfony/webpack-encore');

Encore
    // the project directory where compiled assets will be stored
    .setOutputPath('public/build/')
    // the public path used by the web server to access the previous directory
    .setPublicPath('/build')
    .cleanupOutputBeforeBuild()
    .enableSourceMaps(!Encore.isProduction())
    .enableVersioning(Encore.isProduction())
    //.enableSassLoader()
    .enableVueLoader()
    .addEntry('vue', './assets/vue/main.js')
    //.addStyleEntry('sass', './assets/sass/main.scss')
;

module.exports = Encore.getWebpackConfig();
