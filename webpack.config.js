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
    .enableTypeScriptLoader()
    .enableVueLoader()
    //.addEntry('vue', './assets/vue/main.js')
    .addEntry('react', './assets/react/main.tsx')
    //.addStyleEntry('sass', './assets/sass/main.scss')
;

module.exports = Encore.getWebpackConfig();
