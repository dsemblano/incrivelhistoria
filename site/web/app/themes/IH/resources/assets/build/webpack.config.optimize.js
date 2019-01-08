'use strict'; // eslint-disable-line

const { default: ImageminPlugin } = require('imagemin-webpack-plugin');
const imageminMozjpeg = require('imagemin-mozjpeg');
const UglifyJsPlugin = require('uglifyjs-webpack-plugin');
const HtmlCriticalWebpackPlugin = require("html-critical-webpack-plugin");

const config = require('./config');

module.exports = {
  plugins: [
    new ImageminPlugin({
      optipng: { optimizationLevel: 7 },
      gifsicle: { optimizationLevel: 3 },
      pngquant: { quality: '65-90', speed: 4 },
      svgo: {
        plugins: [
          { removeUnknownsAndDefaults: false },
          { cleanupIDs: false },
          { removeViewBox: false },
        ],
      },
      plugins: [imageminMozjpeg({ quality: 75 })],
      disable: (config.enabled.watcher),
    }),
    new UglifyJsPlugin({
      uglifyOptions: {
        ecma: 5,
        compress: {
          warnings: true,
          drop_console: true,
        },
      },
    }),
    new HtmlCriticalWebpackPlugin({
      base: config.paths.dist,
      src: config.devUrl,
      dest: "styles/critical-home.css",
      ignore: ["@font-face", /url\(/],
      inline: false,
      minify: true,
      extract: false,
      dimensions: [
        {
          height: 375,
          width: 565,
        },
        {
          height: 1080,
          width: 1920,
        },
      ],
      penthouse: {
        blockJSRequests: false,
      },
    }),
  ],
};
