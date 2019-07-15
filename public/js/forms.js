/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 10);
/******/ })
/************************************************************************/
/******/ ({

/***/ 10:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(11);


/***/ }),

/***/ 11:
/***/ (function(module, exports) {

$(document).ready(function () {

  var signatures = {
    "signature_1": {
      "div": "#div_signature_1",
      "modal": "#modal_signature_1",
      "hidden": "#img_signature_1",
      "opened": false
    }
  };

  for (var i = 1; i <= 20; i++) {
    signatures["signature_" + i] = {
      "div": "#div_signature_" + i,
      "modal": "#modal_signature_" + i,
      "hidden": "#img_signature_" + i,
      "opened": false
    };
  }

  $('.btn-signature').click(function () {

    var modal = $(signatures[this.id].modal);
    var div = $(signatures[this.id].div);
    var hidden = $(signatures[this.id].hidden);
    var opened = signatures[this.id].opened;
    modal.modal('show');

    if (!signatures[this.id].opened) {
      signatures[this.id].opened = true;
      div.jSignature(); // inits the jSignature widget.
      if (hidden.val() !== "") {
        div.jSignature("setData", hidden.val());
      }
    }
  });

  $('.btn-save-sign').click(function () {
    var signature = this.id.replace("save", "");
    var div = $("#div" + signature);
    var img = div.jSignature("getData");
    $('#preview' + signature).attr('src', img);
    $('#img' + signature).val(img);
  });

  // after some doodling...
  $('.btn-clear-sign').click(function () {
    var $sigdiv = $("#" + this.id.replace("clear", "div", 1));
    $sigdiv.jSignature("reset"); // clears the canvas and rerenders the decor on it.
  });

  $('#btnPrintPreStart').click(function () {
    var selecteds = $("input[type=checkbox]:checked").not('#chkRow').length;
    if (selecteds > 0) {
      var ids = Array();
      $("input[type=checkbox]:checked").not('#chkRow').each(function () {
        ids.push(this.id.split("-")[1]);
      });
      var urlArray = window.location.href.split("/");
      if (urlArray[urlArray.length - 1] == "form_prestart") {
        window.open(window.location.href + "/action/" + ids.join(",") + "/print", '_blank');
      } else {
        window.open(window.location.href.replace(/\/[^\/]*$/, '/action/' + ids.join(",") + "/print", '_blank'));
      }
    }
  });
});

/***/ })

/******/ });