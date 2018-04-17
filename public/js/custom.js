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
/******/ 	return __webpack_require__(__webpack_require__.s = 44);
/******/ })
/************************************************************************/
/******/ ({

/***/ 44:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(45);


/***/ }),

/***/ 45:
/***/ (function(module, exports) {


$(document).ready(function () {

    function addMinutes(time, minsToAdd) {
        function D(J) {
            return (J < 10 ? '0' : '') + J;
        };
        var piece = time.split(':');
        var mins = piece[0] * 60 + +piece[1] + +minsToAdd;
        return D(mins % (24 * 60) / 60 | 0) + ':' + D(mins % 60);
    }

    function hourToMinutes(hour) {
        var piece = hour.split(':');
        if (piece.length > 1) {
            return piece[0] * 60 + +piece[1];
        } else {
            return 0;
        }
    }

    function minutesToHour(minutes) {
        function D(J) {
            return (J < 10 ? '0' : '') + J;
        };
        return D(minutes / 60 | 0) + ':' + D(minutes % 60);
    }

    //Setup datepicker
    $('.date-picker').datepicker();

    //Show extra jobs for selected day
    showExtra = function showExtra(btn, extra_inputs) {
        $(extra_inputs).css('display', 'block');
        $(btn).fadeOut();
    };

    //Update option list for end time
    $('.hour-start').change(function () {
        var day = $(this).attr('id').split('_');
        var row = day[2];
        var destination = $('#' + day[0] + "_end_" + row);

        //Enable and empty select list for end of the row
        destination.prop('disabled', false).empty();
        var option = '<option value="">-</option>';
        destination.append(option);

        //Get the seleted value to be used as minimum for end
        var startHour = $(this).val();
        for (var hour = Number(startHour) + 15; hour <= 24 * 60 - 15; hour += 15) {
            var _option = '<option value="' + hour + '">' + minutesToHour(hour) + '</option>';
            $(destination).append(_option);
        }
    });
});

/***/ })

/******/ });