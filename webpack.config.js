let Encore = require('@symfony/webpack-encore');

Encore
    .setOutputPath('public/build/')
    .setPublicPath('/build')
    .cleanupOutputBeforeBuild(!Encore.isProduction())
    .enableSourceMaps(!Encore.isProduction())
    .enableVersioning(!Encore.isProduction())
    //.enableSassLoader()
    .enableReactPreset()
    .addEntry('main', './assets/react/entrypoint/core_main.js')
    .addEntry('register', './assets/react/entrypoint/security_register.js')
;

module.exports = Encore.getWebpackConfig();
