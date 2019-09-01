'use strict';

// Modules
var fs      = require('fs');
var path    = require('path');
var gulp    = require('gulp');
var cssFlip = require('css-flip');

var config = require('../config.js');

var DEST_DIR = path.join(__dirname, '..', config.paths.dist, 'demo/color-builder');

var BS_PATH = path.join(__dirname, '..', config.paths.bsScss);
var PX_PATH = path.join(__dirname, '..', config.paths.scss);

var FILES_TO_IMPORT = [
  '{bs}/_variables.scss',
  '{px}/_variables.scss',
  'dark:{px}/_variables-dark.scss',
  '{bs}/mixins/_alerts.scss',
  '{px}/mixins/_utilities.scss',
  '{px}/mixins/_tables.scss',
  '{px}/mixins/_buttons.scss',
  '{px}/mixins/_dropdowns.scss',
  '{px}/mixins/_navs.scss',
  '{px}/mixins/_labels.scss',
  '{px}/mixins/_alerts.scss',
  '{px}/mixins/_progress-bars.scss',
  '{px}/mixins/_list-group.scss',
  '{px}/mixins/_panels.scss',
  '{px}/mixins/_tooltip.scss',
  '{px}/mixins/_popovers.scss',
  '{px}/mixins/_accordions.scss',
  '{px}/mixins/_switchers.scss',
  '{px}/mixins/_custom-forms.scss',
  '{px}/mixins/_px-wizard.scss',
  '{px}/mixins/_pixeladmin.scss',
];

function getFileContents(path) {
  var realPath = path
    .replace(/^dark:/, '')
    .replace('{bs}', BS_PATH)
    .replace('{px}', PX_PATH);

  return String(fs.readFileSync(realPath));
}

function convertScssToLess(source) {
  var result = source;

  // If base mixin
  if (result.indexOf('@mixin pixel-color-variant(') !== -1) {
    result = result.slice(result.indexOf('@mixin pixel-color-variant('));

    // Replace ifs
    result = result.replace(/\n.+@if.+\n/g, '\n');

    // Replace if's end blocks
    result = result.replace(/\n.+\}\/\/.*\n/g, '\n');
  }

  // Add pixel-button-base fix
  result = result.replace('$selector: ".btn#{$postfix}";', '@selector: ~".btn@{postfix}";');

  // Remove hash vars
  result = result.replace(/\n\$\w+:\s*\((?:\n.+)+/g, '\n');

  // Remove !default
  result = result.replace(/\s+!default/g, '');

  // Replace functions
  result = result.replace(/adjust\-hue\(/g, 'spin(');
  result = result.replace(/transparentize\(\$(\w+),\s*([\d.]+)\)/g, function(match, variable, opacity) {
    return 'fadeout(@' + variable + ', ' + (100 * parseFloat(opacity)) + ')';
  });

  // Replace mixins
  result = result.replace(/@mixin\s+/g, '.');

  // Replace includes
  result = result.replace(/@include\s+/g, '.');

  // Remove @content
  result = result.replace(/@content;/g, '');

  // Remove ifs
  result = result.replace(/\n.+if\(.+\n/g, '\n');
  result = result.replace(/\n.+@if.+\n/g, '\n');

  // Replace interpolation
  result = result.replace(/#\{\$([^\}]+)\}/g, '@{$1}');

  // Replace variables
  result = result.replace(/\$/g, '@');

  return result;
}

function minifyLess(content) {
  return content
    .replace(/@\{([^}]+)\}/g, '%%%#$1#%%%')
    .replace(/url\(.+?\)/g, '#fff')
    .replace(/\s*\/\/.*\n/g, '\n')
    .replace(/\n+/g, '')
    .replace(/\s*(:|;|}|{)\s*/g, '$1')
    .replace(/%%%#([^#]+)#%%%/g, '@{$1}')
    .replace(/\s+/, ' ');
}

gulp.task('dev-compile-color-builder-assets', function(cb) {
  var data = { light: '', dark: '' };

  FILES_TO_IMPORT.forEach(function(filePath) {
    var content = convertScssToLess(getFileContents(filePath));

    if (filePath.indexOf('dark:') === 0) {
      data.dark += content;
      return;
    }

    data.light += content;
    data.dark += content;
  });


  // Minify
  data.light = minifyLess(data.light);
  data.dark = minifyLess(data.dark);

  fs.writeFileSync(
    path.join(DEST_DIR, 'color-builder-data.js'),
    'window.PX_COLOR_BUILDER_DATA={light:"' + data.light.replace(/\"/g, '\'') + '",dark:"' + data.dark.replace(/\"/g, '\'') + '"};'
  );

  cb();
});
