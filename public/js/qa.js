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

    var activities = $(".row-act").length + 1;

    $('#addActivity').click(function () {
        var activity = "\n\t\t<div id=\"row-act-" + activities + "\" class=\"row-act\">\n            <div class=\"form-group row\">\n                <label for=\"activities[" + activities + "]\" class=\"col-md-4 col-form-label text-md-right\">Activity:</label>\n                <div class=\"col-md-6\">\n                    <input id=\"activities[" + activities + "][description]\" type=\"text\" class=\"form-control\" name=\"activities[" + activities + "][description]\" value=\"\" />                                \n                </div>\n            </div>        \n            <div class=\"form-group row\">\n                <label for=\"activities[" + activities + "][at]\" class=\"col-md-4 col-form-label text-md-right\">A/T:</label>\n                <div class=\"col-md-6\">\n                    <select name=\"activities[" + activities + "][at]\" class=\"form-control\">                                    \n                        <option value=\"V\" selected>Verify</option>\n                        <option value=\"R\">Random</option>\n                        <option value=\"H\">Hold</option>\n                        <option value=\"S\">Submit</option>\n                        <option value=\"I\">Inspect</option>\n                        <option value=\"W\">Witness Points</option>\n                        <option value=\"C\">Comments</option>                                    \n                        <option value=\"N\">Notification Point</option>\n                    </select>                                \n                </div>\n            </div>\n\n            <div class=\"form-group row\">\n                <label for=\"activities[" + activities + "][requirements]\" class=\"col-md-4 col-form-label text-md-right\">Criteria Requirements:</label>\n                <div class=\"col-md-6\">\n                    <input id=\"activities[" + activities + "][requirements]\" type=\"text\" class=\"form-control\" name=\"activities[" + activities + "][requirements]\" value=\"\"/>                                \n                </div>\n            </div>                            \n            <div class=\"form-group row\">\n                <label for=\"activities[" + activities + "][order]\" class=\"col-md-4 col-form-label text-md-right\">Order:</label>\n                <div class=\"col-md-6\">\n                    <input id=\"activities[" + activities + "][order]\" type=\"number\" class=\"form-control order\" name=\"activities[" + activities + "][order]\" value=\"" + activities + "\" />                                \n                </div>\n            </div>                            \n\n            <div class=\"form-group row\">\n                <div class=\"col-md-6\">\n                    <input id=\"act-" + activities + "\" type=\"button\" class=\"btn btn-danger btn-sm ml-2 btn-remove-act\" value=\"Remove Activity\"/>\n                </div>                                \n            </div>                            \n        </div>\n        <hr/>\n\t\t";
        activities++;
        $("#activities").append(activity);
    });

    $(document).on('click', '.btn-remove-act', function () {
        $("#row-" + this.id).remove();
        if (activities > 0) {
            activities--;
        }
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
            "div": "#div_signature_1",
            "modal": "#modal_signature_1",
            "hidden": "#img_signature_1",
            "opened": false
        },
        "signature_2": {
            "div": "#div_signature_2",
            "modal": "#modal_signature_2",
            "hidden": "#img_signature_2",
            "opened": false
        },
        "signature_3": {
            "div": "#div_signature_3",
            "modal": "#modal_signature_3",
            "hidden": "#img_signature_3",
            "opened": false
        },
        "signature_4": {
            "div": "#div_signature_4",
            "modal": "#modal_signature_4",
            "hidden": "#img_signature_4",
            "opened": false
        }
    };

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

    var qa_photos = $(".photo-row").length + 1;
    $("#addPhoto").click(function () {

        var photo = "\n        <div class=\"alert alert-secondary photo-row\" id=\"photos[" + qa_photos + "]_row\">                          \n            <h5 style=\"text-align: center;\">Photo " + qa_photos + "</h5>          \n            <div class=\"input-group col-12 mb-3\">\n              <div class=\"custom-file\">\n                <input type=\"file\" class=\"custom-file-input qa_photos\" id=\"photos[" + qa_photos + "]\" name=\"photos[" + qa_photos + "]\"/>                        \n                <label class=\"custom-file-label\" for=\"photos[" + qa_photos + "]\">Choose files</label>\n              </div>\n            </div>\n\n            <div class=\"input-group col-12 mb-3\">\n                <img id=\"photos[" + qa_photos + "]_img\" src=\"\" class=\"img-fluid\" style=\"\">\n            </div>   \n            <input id=\"photos[" + qa_photos + "]-delete\" type=\"button\" class=\"btn btn-danger btn-sm ml-2 delPhoto\" value=\"Delete\">\n            <input type=\"hidden\" class=\"custom-file-input\" id=\"photos[" + qa_photos + "]_hidden\" name=\"photos[" + qa_photos + "]_hidden\" value=\"\">                        \n        </div>   \n        ";
        qa_photos++;
        $("#additional_photos").append(photo);
    });

    $(document).on("click", ".delPhoto", function () {
        var destination = $(this).prop('id').split("-");
        qa_photos--;
        $("[id*='" + destination[0] + "_row']").remove();
    });

    $('#btnPrintQA').click(function () {
        var selecteds = $("input[type=checkbox]:checked").not('#chkRow').length;
        if (selecteds > 0) {
            var ids = Array();
            $("input[type=checkbox]:checked").not('#chkRow').each(function () {
                ids.push(this.id.split("-")[1]);
            });
            var urlArray = window.location.href.split("/");
            if (urlArray[urlArray.length - 1] == "qa_users") {
                window.open(window.location.href + "/action/" + ids.join(",") + "/print", '_blank');
            } else {
                window.open(window.location.href.replace(/\/[^\/]*$/, '/action/' + ids.join(",") + "/print", '_blank'));
            }
        }
    });
});

/***/ })

/******/ });