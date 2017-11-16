let Encore = require('@symfony/webpack-encore');

Encore
    .setOutputPath('public/build/')
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
