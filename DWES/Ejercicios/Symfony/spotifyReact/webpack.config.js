const Encore = require('@symfony/webpack-encore');

// Manually configure the runtime environment if not already configured yet by the "encore" command.
// It's useful when you use tools that rely on webpack.config.js file.
if (!Encore.isRuntimeEnvironmentConfigured()) {
    Encore.configureRuntimeEnvironment(process.env.NODE_ENV || 'dev');
}

Encore
    // Directorio de entrada de tus activos
    .setOutputPath('public/build/')
    // Ruta pública a tu directorio de salida
    .setPublicPath('/build')
    // Archivo de entrada principal de JavaScript
    .addEntry('app', './assets/js/app.js')
    // Archivo de salida compilado
    .splitEntryChunks()
    .enableSingleRuntimeChunk()
    .cleanupOutputBeforeBuild()
    .enableBuildNotifications()
    .enableSourceMaps(!Encore.isProduction())
    .enableVersioning(Encore.isProduction())
    // Compilar los activos
    .enableReactPreset()
    .enableSassLoader()
    .enablePostCssLoader()
;

module.exports = Encore.getWebpackConfig();