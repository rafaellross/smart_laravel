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
/******/ 	return __webpack_require__(__webpack_require__.s = 39);
/******/ })
/************************************************************************/
/******/ ({

/***/ 39:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(40);


/***/ }),

/***/ 40:
/***/ (function(module, exports) {

$(document).ready(function () {

  var _token;

  // just for the demos, avoids form submit
  jQuery.validator.setDefaults({
    debug: true,
    success: "valid"
  });

  $.validator.addMethod('filesize', function (value, element, param) {
    // param = size (en bytes)
    // element = element to validate (<input>)
    // value = value of the element (file name)
    return this.optional(element) || element.files[0].size <= param;
  });

  //Initiate date-picker
  $('.date-picker').datepicker({
    format: 'dd/mm/yyyy'
  });

  $('input[name=dob]').datepicker({
    format: 'dd/mm/yyyy',
    startView: 4
  });

  //If employee is apprentice, then show selection of year
  $('select[name=apprentice]').change(function () {
    if ($(this).val() === "1") {
      $('#apprentice-year').show();
    } else {
      $('#apprentice-year').hide();
    }
  });

  function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {

        var destination = $(input).prop('name');
        var preview = $("[id*='" + destination + "']");

        preview.attr('src', e.target.result).show();

        var hidden = $("input[name*='" + destination + "'][type=hidden]");
        hidden.val(e.target.result);
        reader.readAsDataURL(input.files[0]);
      };
      reader.readAsDataURL(input.files[0]);
    }
  }

  $(document).on("change", "input[type=file]", function () {
    resizeImageToSpecificWidth(this);
  });

  $(document).on("click", ".btn-remove", function () {
    if (confirm("Are you sure you want to remove this license?")) {
      $(this).parent().parent().fadeOut("slow");
    }
  });

  function resizeImageToSpecificWidth(input) {
    var width = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 600;

    var destination = $(input).prop('name');
    var preview = $("[id*='" + destination + "']");
    var hidden = $("input[name*='" + destination + "'][type=hidden]");

    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function (event) {
        var img = new Image();
        img.onload = function () {
          var oc = document.createElement('canvas'),
              octx = oc.getContext('2d');
          oc.width = img.width;
          oc.height = img.height;
          octx.drawImage(img, 0, 0);
          while (oc.width * 0.5 > width) {
            oc.width *= 0.5;
            oc.height *= 0.5;
            octx.drawImage(oc, 0, 0, oc.width, oc.height);
          }
          oc.width = width;
          oc.height = oc.width * img.height / img.width;
          octx.drawImage(img, 0, 0, oc.width, oc.height);
          preview.attr('src', oc.toDataURL()).show();
          hidden.val(oc.toDataURL());
        };
        img.src = event.target.result;
      };
      reader.readAsDataURL(input.files[0]);
    }
  }
  var newLicense = function newLicense(description, code) {
    return '\n          <div class="card-body">\n\n          <!-- Start Card -->\n          <h5 class="card-title">' + description + ' :</h5>\n          <form action="" class="licensesAdd" method="post" enctype="multipart/form-data">\n            <div class="col-xs-12 col-sm-12 col-md-12">\n              <div class="form-row">\n                <div class="col-md-2 col-12 mb-3">\n                  <label>\n                <strong>Issue Date:</strong>\n                </label>\n                <input type="text" class="form-control form-control-lg date-picker" name=license[' + code + '][date]" placeholder="dd/mm/yyyy" value=""  maxlength="10" required>\n              </div>\n                <div class="col-md-4 col-12 mb-3 ml-auto">\n                  <label>\n                <strong>State / Issuer *:</strong>\n                </label>\n                <input type="text" class="form-control form-control-lg" name=license[' + code + '][issuer]" placeholder="Issued by" value="" required>\n              </div>\n                <div class="col-md-4 col-12 ml-auto">\n                  <label>\n                <strong>Card / Licence No *:</strong>\n                </label>\n                <input type="text" class="form-control form-control-lg" name=license[' + code + '][number]" placeholder="Issued by" value="" required>\n            </div>\n              </div>\n              <div class="form-row">\n                <div class="col-md-4 col-12 mb-3">\n                  <label>\n                <strong>Photo - Front *:</strong>\n                </label>\n                  <div class="input-group mb-3">\n                    <div class="custom-file">\n                    <input type="file" class="custom-file-input" name="license[' + code + '][image][front]" accept="image/*" required>\n                    <label class="custom-file-label">Choose file</label>\n                    <input type="hidden" name="license[' + code + '][image][front][img]"/>\n                </div>\n              </div>\n              </div>\n              <div class="col-md-2 col-12 mb-3">\n                    <img id="license[' + code + '][image][front]" class="img-thumbnail" style="max-width: 35%;display: none;">\n              </div>\n              <div class="col-md-4 col-12 mb-3">\n                <label>\n                  <strong>Photo - Back:</strong>\n                </label>\n                <div class="input-group mb-3">\n                  <div class="custom-file">\n                    <input type="file" class="custom-file-input" name="license[' + code + '][image][back]" accept="image/*" required>\n                    <label class="custom-file-label">Choose file</label>\n                    <input type="hidden" name="license[' + code + '][image][back][img]"/>\n                  </div>\n                </div>\n              </div>\n              <div class="col-md-2 col-12 mb-3">\n                <img id="license[' + code + '][image][back]" class="img-thumbnail" style="max-width: 35%;display: none;">\n              </div>\n              </div>\n              </div>\n              <button type="button" class="btn btn-danger btn-remove">Remove</button>\n              <hr>\n              </form>\n            </div>\n\n            <!-- End Card -->\n\n        ';
  };
  //Add new license
  $('#addLicense').click(function () {
    var select = $('select[name=licenseId] :selected');
    $('#licenses-list').append(newLicense(select.text(), select.val()));
  });

  $('form').submit(function (event) {
    /* Act on the event */
    $('input[type=file]').remove();
  });

  $('#div_signature').jSignature({
    'decor-color': 'transparent'
  });

  $('form').submit(function () {
    $('input[name=signature]').val($('#div_signature').jSignature("getData"));
  });
});

/***/ })

/******/ });