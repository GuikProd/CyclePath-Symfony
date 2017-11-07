var Encore = require('@symfony/webpack-encore');

Encore
    // the project directory where compiled assets will be stored
    .setOutputPath('public/build/')
    // the public path used by the web server to access the previous directory
    .setPublicPath('/build')
    .cleanupOutputBeforeBuild()
    .enableSourceMaps(!Encore.isProduction())
    .enableVersioning(Encore.isProduction())
    .enableSassLoader()
    .enableReactPreset()
    .enableTypeScriptLoader()

    .addEntry('main', './assets/dev/react/main.tsx')

    // uncomment to define the assets of the project
    // .addEntry('js/app', './assets/js/app.js')
    .addStyleEntry('css/main', './assets/dev/scss/main.scss')
;

module.exports = Encore.getWebpackConfig();
