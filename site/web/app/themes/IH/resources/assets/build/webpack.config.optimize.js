'use strict'; // eslint-disable-line

const { default: ImageminPlugin } = require('imagemin-webpack-plugin');
const imageminMozjpeg = require('imagemin-mozjpeg');
const UglifyJsPlugin = require('uglifyjs-webpack-plugin');
const glob = require('glob-all');
const PurgecssPlugin = require('purgecss-webpack-plugin');
const HtmlCriticalWebpackPlugin = require("html-critical-webpack-plugin");

const config = require('./config');

module.exports = {
  plugins: [
    new ImageminPlugin({
      optipng: { optimizationLevel: 2 },
      gifsicle: { optimizationLevel: 3 },
      pngquant: { quality: '64-90', speed: 4 },
      svgo: {
        plugins: [
          { removeUnknownsAndDefaults: false },
          { cleanupIDs: false },
          { removeViewBox: false },
        ],
      },
      plugins: [imageminMozjpeg({ quality: 74 })],
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
    new PurgecssPlugin({
      paths: glob.sync([
        'app/**/*.php',
        'resources/views/**/*.php',
        'resources/assets/scripts/**/*.js',
        'node_modules/flickity/**/**/*.js',
      ]),
      whitelist: [ // Only if you need it!
        'tags', 'tagcloud', 'menu-item', 'sub-menu', 'single-post',
        'figcaption', 'blockquote', 'alignright', 'aligncenter', 'alignleft',
        'instagram-pics', 'author_bio_section', 'heateor_sss_sharing_container',
        'pagination', 'nav-links', 'page-numbers', 'current',
      ],
      whitelistPatternsChildren:[
        /^pum/,
        /^menu-categorias-menu/,
        /^crp_related/,
        /^error404/,
        /^page-template-template-allcategories/,
        /^fb_iframe_widget_fluid_desktop/,
        /^wp-caption/,
      ],
    }),
    new HtmlCriticalWebpackPlugin({
      base: config.paths.dist,
      src: config.devUrl,
      dest: "styles/critical.css",
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
