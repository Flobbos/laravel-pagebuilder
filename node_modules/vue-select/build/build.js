// https://github.com/shelljs/shelljs
require('shelljs/global');
env.NODE_ENV = 'production';

var path = require('path');
var config = require('../config');
var ora = require('ora');
var webpack = require('webpack');
var utils = require('./utils');
var webpackConfig = utils.shouldBuildHomepage() ? require('./webpack.site.conf') : require('./webpack.prod.conf');

var text = utils.shouldBuildHomepage() ? 'homepage' : 'vue-select UMD module';
var spinner = ora(`building ${text}...`);
spinner.start();

var assetsPath = path.join(config.build.assetsRoot, config.build.assetsSubDirectory);
if (!utils.shouldBuildHomepage()) {
  rm('-rf', assetsPath);
  mkdir('-p', assetsPath);
}

/**
 * Build the /dist/ folder
 */
webpack(webpackConfig, function (err, stats) {
  spinner.stop();
  if (err) throw err;
  process.stdout.write(stats.toString({
    colors: true,
    modules: false,
    children: false,
    chunks: false,
    chunkModules: false
  }) + '\n')
});