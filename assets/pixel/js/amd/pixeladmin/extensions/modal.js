!function(o,t){if("function"==typeof define&&define.amd)define(["jquery","px-bootstrap/modal"],t);else if("undefined"!=typeof exports)t(require("jquery"),require("px-bootstrap/modal"));else{var e={exports:{}};t(o.jquery,o.modal),o.modal=e.exports}}(this,function(o){"use strict";function t(o){return o&&o.__esModule?o:{default:o}}var e=t(o);!function(o){if(!o.fn.modal)throw new Error("modal.js required.");var t=o.fn.modal.Constructor.prototype.show,e=o.fn.modal.Constructor.prototype.hide;o.fn.modal.Constructor.prototype.show=function(e){t.call(this,e),this.isShown&&o("html").addClass("modal-open")},o.fn.modal.Constructor.prototype.hide=function(t){e.call(this,t),this.isShown||o("html").removeClass("modal-open")}}(e.default)});