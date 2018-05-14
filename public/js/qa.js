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
/******/ 	return __webpack_require__(__webpack_require__.s = 41);
/******/ })
/************************************************************************/
/******/ ({

/***/ 41:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(42);


/***/ }),

/***/ 42:
/***/ (function(module, exports) {

$(document).ready(function () {

    var activities = 1;
    $('#addActivity').click(function () {
        var activity = '\n\t\t<div id="row-act-' + activities + '">\n            <div class="form-group row">\n                <label for="activities[' + activities + ']" class="col-md-4 col-form-label text-md-right">Activity:</label>\n                <div class="col-md-6">\n                    <input id="activities[' + activities + '][description]" type="text" class="form-control" name="activities[' + activities + '][description]" value="" required>                                \n                </div>\n            </div>        \n            <div class="form-group row">\n                <label for="activities[' + activities + '][at]" class="col-md-4 col-form-label text-md-right">A/T:</label>\n                <div class="col-md-6">\n                    <select name="activities[' + activities + '][at]" class="form-control">                                    \n                        <option value="V" selected>Verify</option>\n                        <option value="R">Random</option>\n                        <option value="H">Hold</option>\n                        <option value="S">Submit</option>\n                        <option value="I">Inspect</option>\n                        <option value="W">Witness Points</option>\n                        <option value="C">Comments</option>                                    \n                        <option value="N">Notification Point</option>\n                    </select>                                \n                </div>\n            </div>\n\n            <div class="form-group row">\n                <label for="activities[' + activities + '][requirements]" class="col-md-4 col-form-label text-md-right">Criteria Requirements:</label>\n                <div class="col-md-6">\n                    <input id="activities[' + activities + '][requirements]" type="text" class="form-control" name="activities[' + activities + '][requirements]" value="" required>                                \n                </div>\n            </div>                            \n            <div class="form-group row">\n                <label for="activities[' + activities + '][order]" class="col-md-4 col-form-label text-md-right">Order:</label>\n                <div class="col-md-6">\n                    <input id="activities[' + activities + '][order]" type="number" class="form-control order" name="activities[' + activities + '][order]" value="' + activities + '" required>                                \n                </div>\n            </div>                            \n\n            <div class="form-group row">\n                <div class="col-md-6">\n                    <input id="act-' + activities + '" type="button" class="btn btn-danger btn-sm ml-2 btn-remove-act" value="Remove Activity"/>\n                </div>                                \n            </div>                            \n        </div>\n        <hr/>\n\t\t';
        activities++;
        $("#activities").append(activity);
    });

    $(document).on('click', '.btn-remove-act', function () {
        $("#row-" + this.id).remove();
    });

    $(document).on('click', '.order', function () {
        $(this).attr('name', 'activities[' + $(this).val() + '][order]');
    });

    $('#btn-create-qa-users').click(function () {
        $('#modalCreateNew').modal('show');
    });

    $('#btnSelectType').click(function () {
        var type = $("select[name=new_qa_type]").val();
        if (type === "") {
            alert("Please, select one type");
        } else {
            var urlArray = window.location.href.split("/");
            if (urlArray[urlArray.length - 1] == "qa_users") {
                window.location += '/create/' + type;
            } else {
                window.location = window.location.href.replace(/\/[^\/]*$/, '/create/' + type);
            }
        }
    });

    var signatures = {

        "signature_1": {
            "div": $("#div_signature_1"),
            "modal": $("#modal_signature_1"),
            "opened": false
        }

    };
    console.log(signatures);
    var $sigdiv = $("#div_signature_1");

    $('.btn-signature').click(function () {
        signatures;
        $('#modal_' + this.id).modal('show');
        if (!opened) {

            $sigdiv.jSignature(); // inits the jSignature widget.
            opened = true;
        }
    });

    $("#div_signature_1").bind('change', function (e) {
        var $sigdiv = $("#div_signature_1");
        var img = $sigdiv.jSignature("getData", "svgbase64");
        console.log(img);
        //data:image/png;base64,
        $('#preview_signature_1').attr('src', 'data:' + img[0] + "," + img[1]);
    });

    // after some doodling...
    $('#btnClearSign').click(function () {
        $sigdiv.jSignature("reset"); // clears the canvas and rerenders the decor on it.
    });

    $('form').submit(function () {
        $('#img_signature_1').val($sigdiv.jSignature("getData"));
    });
});

/***/ })

/******/ });