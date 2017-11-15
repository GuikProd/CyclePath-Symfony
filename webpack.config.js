let Encore = require('@symfony/webpack-encore');

Encore
    // the project directory where compiled assets will be stored
    .setOutputPath('public/build/')
    // the public path used by the web server to access the previous directory
    .setPublicPath('/build')
    .cleanupOutputBeforeBuild(!Encore.isProduction())
    .enableSourceMaps(!Encore.isProduction())
    .enableVersioning(!Encore.isProduction())
    //.enableSassLoader()
    .enableReactPreset()
    .addEntry('react', './assets/react/react.js')
    //.addStyleEntry('sass', './assets/sass/main.scss')
;

module.exports = Encore.getWebpackConfig();
