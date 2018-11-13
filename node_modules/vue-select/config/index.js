// see http://vuejs-templates.github.io/webpack for documentation.
var path = require('path');

module.exports = {
  build: {
    env: require('./prod.env'),
    assetsRoot: path.resolve(__dirname, '../dist'),
    assetsSubDirectory: '',
    assetsPublicPath: '/',
    productionSourceMap: true
  },
  dev: {
    env: require('./dev.env'),
    port: 8080,
    proxyTable: {}
  },
  umd: {
    assetsRoot: path.resolve(__dirname, '../umd'),
    assetsPublicPath: '/'
  },
  homepage: {
    env: require('./prod.env'),
    entry: './docs/homepage/home.js',
    assetsRoot: path.resolve(__dirname, '../site'),
    assetsSubDirectory: '',
    assetsPublicPath: '',
    productionSourceMap: true
  }
};

