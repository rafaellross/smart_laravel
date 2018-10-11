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
/******/ 	return __webpack_require__(__webpack_require__.s = 37);
/******/ })
/************************************************************************/
/******/ ({

/***/ 37:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(38);


/***/ }),

/***/ 38:
/***/ (function(module, exports) {

$(document).ready(function () {

  $.urlParam = function (name) {
    var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
    if (results == null) {
      return null;
    } else {
      return decodeURI(results[1]) || 0;
    }
  };

  $('form').not('#timesheet_form').submit(function (event) {
    /* Act on the event */
    $('#modalLoading').modal({ backdrop: 'static', keyboard: false });
  });

  $('#flash-message').fadeOut(15000);

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
  $('.date-picker').datepicker({ format: 'dd/mm/yyyy' });

  //Show extra jobs for selected day
  showExtra = function showExtra(btn, extra_inputs) {
    $(extra_inputs).css('display', 'block');
    $(btn).fadeOut();
  };

  //Update list of hours in accord with current selection
  $('.hour-start').change(function () {

    var day = $(this).attr('id').split('_');
    var row = day[2];
    var destination = $('#' + day[0] + "_end_" + row);

    //Enable and empty select list for end of the row
    destination.prop('disabled', false).empty();
    var option = '<option value="">-</option>';
    destination.append(option);

    //Get the seleted value to be used as minimum for end
    var startHour = $('#group_' + day[0] + "_" + day[2] + "_night").is(':checked') ? 0 : $(this).val();
    for (var hour = Number(startHour); hour <= 24 * 60 - 15; hour += 15) {
      var _option = '<option value="' + hour + '">' + minutesToHour(hour) + '</option>';
      $(destination).append(_option);
    }
  });

  //Calculate Normal Hours
  $('.hour-end').change(function () {
    var reset = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : false;


    var day = $(this).attr('id').split('_');
    var row = Number(day[2]);

    var isNight = false;

    if ($('#group_' + day[0] + "_" + day[2] + "_night").is(':checked') && !reset) {
      return false;
    }

    var next_row = row + 1;

    var next_row_el = $('#' + day[0] + "_start_" + next_row);

    if (next_row_el.length > 0) {

      //Clear next row
      next_row_el.prop('disabled', false).empty();
      var next_duration = $('#' + day[0] + '_hours_' + next_row);
      next_duration.val("");
      var next_end = $('#' + day[0] + '_end_' + next_row);
      next_end.val("");

      var option = '<option value="">-</option>';
      next_row_el.append(option);

      //Get the seleted value to be used as minimum for start on next row
      var startHour = $(this).val();
      //Populate select with times
      for (var hour = Number(startHour); hour <= 24 * 60 - 15; hour += 15) {
        var _option2 = '<option value="' + hour + '">' + minutesToHour(hour) + '</option>';
        next_row_el.append(_option2);
      }
    }

    //Clear next day
    var duration = $('#' + day[0] + '_hours_' + row);
    var start = Number($('#' + day[0] + "_start_" + row).val());
    var end = Number($(this).val());
    var lunch = row === 1 && day[0] !== "sat" && day[0] !== "sun" ? 15 : 0;

    duration.val(end - start - lunch > 0 ? minutesToHour(end - start - lunch) : "");

    //Get hours from every job
    var hours_job1 = "00:00";
    var hours_job2 = "00:00";
    var hours_job3 = "00:00";
    var hours_job4 = "00:00";

    //Get hours from every job
    if ($('#' + day[0] + '_hours_1').not('.night')) {
      hours_job1 = $('#' + day[0] + '_hours_1').val();
    }

    if ($('#' + day[0] + '_hours_2').not('.night')) {
      hours_job2 = $('#' + day[0] + '_hours_2').val();
    }

    if ($('#' + day[0] + '_hours_3').not('.night')) {
      hours_job3 = $('#' + day[0] + '_hours_3').val();
    }

    if ($('#' + day[0] + '_hours_4').not('.night')) {
      hours_job4 = $('#' + day[0] + '_hours_4').val();
    }

    hours_job1 = hourToMinutes(hours_job1);
    hours_job2 = hourToMinutes(hours_job2);
    hours_job3 = hourToMinutes(hours_job3);
    hours_job4 = hourToMinutes(hours_job4);

    //Calculate total hours

    //Clear 1.5 and 2.0 fields
    $('#' + day[0] + '_15').val('');
    $('#' + day[0] + '_20').val('');

    //Declare total hours
    var totalHours = hours_job1 + hours_job2 + hours_job3 + hours_job4;
    $('#' + day[0] + '_total').val(minutesToHour(totalHours));

    var hours_15 = 0;
    var hours_20 = 0;
    var hours_nor = 0;

    var job_number = $('#job' + day[0].charAt(0).toUpperCase() + day[0].slice(1) + row).val();

    if (totalHours > 8 * 60 && day[0] !== "sat" && day[0] !== "sun" && !isNight) {
      //If total hours is bigger than 08:00 and day different than sat set 1.5
      hours_15 = Math.min(2 * 60, totalHours - 8 * 60);
    }
    //Check if is night work and start time is between 18 and 23
    else if (isNight && start >= 18 * 60 & start < 23 * 60) {
        hours_15 = Math.min(2 * 60, totalHours);
      }

    //If total hours is bigger than 10:00 or day equal sat set 1.5
    if (!isNight && (totalHours > 10 * 60 || day[0] == "sat" || day[0] == "sun")) {
      if (day[0] == "sat" || day[0] == "sun") {
        hours_20 = totalHours;
      } else if (job_number !== "pld") {
        hours_20 = totalHours - 8 * 60 - 2 * 60;
      }
      //Calculate hours 2.0 in case of night work
    } else if (isNight) {
      hours_20 = totalHours - hours_15;
    }

    hours_nor = totalHours - hours_15 - hours_20;

    $('#' + day[0] + '_15').val(minutesToHour(hours_15));
    $('#' + day[0] + '_20').val(minutesToHour(hours_20));
    $('#' + day[0] + '_nor').val(minutesToHour(hours_nor));

    calcTotal();
  });

  //Calculate Night Hours
  $('.hour-end').change(function () {
    var reset = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : false;


    var day = $(this).attr('id').split('_');
    var row = Number(day[2]);

    var isNight = true;

    if (!$('#group_' + day[0] + "_" + day[2] + "_night").is(':checked') && !reset) {
      return false;
    }

    var duration = $('#' + day[0] + '_hours_' + row);
    var start = Number($('#' + day[0] + "_start_" + row).val());
    var end = Number($(this).val());
    var lunch = row === 1 && day[0] !== "sat" && day[0] !== "sun" ? 15 : 0;

    if (end > start && end !== start) {
      duration.val(end - start - lunch > 0 ? minutesToHour(end - start - lunch) : "");
    } else {
      duration.val(24 * 60 - start + (24 * 60 - (24 * 60 - end)) - lunch > 0 && end !== start ? minutesToHour(24 * 60 - start + (24 * 60 - (24 * 60 - end)) - lunch) : "");
    }

    var hours_job1 = "00:00";
    var hours_job2 = "00:00";
    var hours_job3 = "00:00";
    var hours_job4 = "00:00";

    //Get hours from every job
    if ($('#' + day[0] + '_hours_1').is('.night')) {
      hours_job1 = $('#' + day[0] + '_hours_1').val();
    }

    if ($('#' + day[0] + '_hours_2').is('.night')) {
      hours_job2 = $('#' + day[0] + '_hours_2').val();
    }

    if ($('#' + day[0] + '_hours_3').is('.night')) {
      hours_job3 = $('#' + day[0] + '_hours_3').val();
    }

    if ($('#' + day[0] + '_hours_4').is('.night')) {
      hours_job4 = $('#' + day[0] + '_hours_4').val();
    }

    hours_job1 = hourToMinutes(hours_job1);
    hours_job2 = hourToMinutes(hours_job2);
    hours_job3 = hourToMinutes(hours_job3);
    hours_job4 = hourToMinutes(hours_job4);

    //Calculate total hours

    //Clear 1.5 and 2.0 fields
    $('#' + day[0] + '_15_night').val('');
    $('#' + day[0] + '_20_night').val('');

    //Declare total hours
    var totalHours = hours_job1 + hours_job2 + hours_job3 + hours_job4;
    $('#' + day[0] + '_total_night').val(minutesToHour(totalHours));

    var hours_15 = 0;
    var hours_20 = 0;
    var hours_nor = 0;

    //Check the gap between start of night work and day work
    var prev_row = row - 1;

    var diff_day_night = null;

    var prev_row_end = $('#' + day[0] + "_end_" + prev_row);

    if (prev_row_end.length > 0) {

      diff_day_night = start - prev_row_end.val();
    }

    if (totalHours > 8 * 60 && day[0] !== "sat" && day[0] !== "sun" && !isNight) {
      //If total hours is bigger than 08:00 and day different than sat set 1.5
      hours_15 = Math.min(2 * 60, totalHours - 8 * 60);
    }
    //Check if is night work and start time is between 18 and 23
    else if (isNight && start >= 18 * 60 && start < 23 * 60 && (diff_day_night == null || diff_day_night > 10 * 60)) {
        hours_15 = Math.min(2 * 60, totalHours);
      } //If total hours is bigger than 10:00 or day equal sat set 1.5
    if (!isNight && (totalHours > 10 * 60 || day[0] == "sat" || day[0] == "sun")) {
      if (day[0] == "sat" || day[0] == "sat") {
        hours_20 = totalHours;
      } else if (job_number !== "pld") {
        hours_20 = totalHours - 8 * 60 - 2 * 60;
      }
      //Calculate hours 2.0 in case of night work
    } else if (isNight) {
      hours_20 = totalHours - hours_15;
    }

    hours_nor = totalHours - hours_15 - hours_20;

    $('#' + day[0] + '_15_night').val(minutesToHour(hours_15));
    $('#' + day[0] + '_20_night').val(minutesToHour(hours_20));
    $('#' + day[0] + '_nor_night').val(minutesToHour(hours_nor));

    calcTotal();
  });

  calcTotal = function calcTotal() {

    //Calculate total of normal hours
    var normalTotal = 0;
    $('.horNormal').each(function () {
      normalTotal += hourToMinutes($(this).val());
    });
    $('#totalNormal').val(minutesToHour(normalTotal));

    //Calculate total of hours
    var hoursTotal = 0;
    $('.hours-total').each(function () {
      hoursTotal += hourToMinutes($(this).val());
    });
    $('#totalWeek').val(minutesToHour(hoursTotal));

    //Calculate total of hours 1.5
    var hours15 = 0;
    $('.hor15').each(function () {
      hours15 += hourToMinutes($(this).val());
    });
    $('#total15').val(minutesToHour(hours15));

    //Calculate total of hours 2.0
    var hours20 = 0;
    $('.hor20').each(function () {
      hours20 += hourToMinutes($(this).val());
    });
    $('#total20').val(minutesToHour(hours20));
  };

  //Define actions on click button Autofill
  $('#btnPreFill').click(function () {
    //Clear all inputs
    $('input, select').not('#preStart, #preEnd, #output, #empDate, #preJob, #PreNormal, #Pre15, #Pre20, #preHours, #btnClearSign, #status, #output, #week_end, #empname, select[name=pld], select[name=rdo], select[name=anl], input[name=employee_id], .btnClear, input[type=hidden], .btn, #preJob_description, #job_description').val('');

    var preEnd = $('#preEnd').val();
    $('.end-1').not('#sat_end_1, #sun_end_1').val(preEnd);

    var preStart = $('#preStart').val();
    $('.start-1').not('#sat_start_1, #sun_start_1').val(preStart);

    var preJob = $('#preJob').val();
    $('.job-1').not('#sat_job_1, #sun_job_1').val(preJob);

    var preJobDescription = $('#preJob_description').val();
    $('.job_description_1').not('#sat_job_1_description, #sun_job_1_description').val(preJobDescription);

    $(".end-1").not('#sat_end_1, #sun_end_1').trigger("change");
  });

  $(".job").change(function () {
    if ($(this).val() == "sick") {
      alert("You have to attach a medical certificate at the end of this Time Sheet or this day won't be paid!");
    }
  });

  $(".job, #preJob").change(function () {
    if ($(this).val() == "001" || $(this).val() == "002") {
      $('#modalDescription').modal({ backdrop: 'static', keyboard: false });

      $('#description_destination').val(this.id);
    }
  });

  $('#btnSaveDescription').click(function () {
    var destination = $('#description_destination').val();
    var description = $('#job_description').val();
    $("#" + destination + "_description").val(description);
    $('#modalDescription').modal('hide');
  });

  $('#modalDescription').on('hidden.bs.modal', function (e) {
    var description = $('#job_description').val();
    var destination = $('#description_destination').val();
    if (description == "") {
      $('#' + destination).val('');
    }
  });

  $('.btnClear').click(function () {

    $('.' + this.id.replace("_night", "")).val('');
    $('.' + this.id.replace("_night", "")).trigger("change");
  });

  var qty_medical_certificates = 1;

  function loadCert(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
        var destination = $(input).prop('name');
        var preview = $("[id*='" + destination + "_img']");
        preview.attr('src', e.target.result).show();
        var hidden = $("#" + destination + "_hidden");
        hidden.val(e.target.result);
      };
      reader.readAsDataURL(input.files[0]);
    }
  }

  function resizeImage(input) {
    var width = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 600;

    var destination = $(input).prop('name');
    var preview = $("[id*='" + destination + "_img']");
    var hidden = $("[id*='" + destination + "_hidden']");

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

  //Load certificates
  $(document).on("change", "input[type=file]", function () {
    resizeImage(this);
  });

  $(document).on("click", ".delCert", function () {
    var destination = $(this).prop('id').split("-");
    if (destination[0] == "medical_certificates[1]") {
      var preview = $("[id*='" + destination[0] + "_img']");
      var input = $("[name*='" + destination[0] + "']");
      var hidden = $("[id*='" + destination[0] + "_hidden']");
      preview.attr('src', "").hide();
      hidden.val("");
      input.val("");
    } else {
      certificates--;
      $("[id*='" + destination[0] + "_row']").remove();
    }
  });

  var certificates = 1;
  $("#addCert").click(function () {
    certificates++;
    var cert = '\n        <div class="alert alert-secondary" id="medical_certificates[' + certificates + ']_row">\n            <h5 style="text-align: center;">Certificate ' + certificates + '</h5>\n            <div class="input-group col-12 mb-3">\n              <div class="custom-file" id="medical_certificates_list">\n                <input type="file" class="custom-file-input medical_certificates" id="medical_certificates[' + certificates + ']" name="medical_certificates[' + certificates + ']"/>\n                <label class="custom-file-label" for="medical_certificates[' + certificates + ']">Choose files</label>\n              </div>\n            </div>\n            <div class="input-group col-12 mb-3">\n                <img id="medical_certificates[' + certificates + ']_img" class="img-fluid" style="">\n            </div>\n            <input id="medical_certificates[' + certificates + ']-delete" type="button" class="btn btn-danger btn-sm ml-2 delCert" value="Delete">\n            <input type="hidden" class="custom-file-input" id="medical_certificates[' + certificates + ']_hidden" name="medical_certificates[' + certificates + ']_hidden" value="">\n        </div>';
    $("#aditional_certificates").append(cert);
  });

  $('#timesheet_form').on('submit', function (event) {

    var isValid = true;
    var days = [{
      description: "Monday",
      short: "mon"
    }, {
      description: "Tuesday",
      short: "tue"
    }, {
      description: "Wednesday",
      short: "wed"
    }, {
      description: "Thursday",
      short: "thu"
    }, {
      description: "Friday",
      short: "fri"
    }, {
      description: "Saturday",
      short: "sat"
    }, {
      description: "Sunday",
      short: "sun"
    }];

    var jobs = [1, 2, 3, 4];
    $.each(days, function (keyDay, day) {
      $.each(jobs, function (key, jobNumber) {

        //Check if job was selected
        var start = $("#" + day.short + "_start_" + jobNumber).val();
        var end = $("#" + day.short + "_end_" + jobNumber).val();
        var job = $("#" + day.short + "_job_" + jobNumber).val();
        var hours = $("#" + day.short + "_hours_" + jobNumber).val();

        if (hours !== "" && (start === "" && end === "" || job === "") || start !== "" && (end === "" || job === "" || hours === "") || end !== "" && (start === "" || job === "" || hours === "")) {
          isValid = false;
          event.preventDefault();
          alert("Select start, end time and job " + jobNumber + " for " + day.description);
          $("#" + day.short + "_job_" + jobNumber).focus();

          return false;
        }
        if (job.length > 0 && (start.length === 0 || end.length === 0 || start === "0" && end === "0")) {
          isValid = false;
          event.preventDefault();
          alert("Select start, end time and job " + jobNumber + " for " + day.description);
          $("#" + day.short + "_job_" + jobNumber).focus();

          return false;
        }
      });
    });

    if ($('#totalWeek').val() == "00:00") {
      var result = confirm("The total of hours of this Time Sheet is 00:00, are you sure you want to continue ?");

      if (result == false) {

        isValid = false;
        event.preventDefault();
        return false;
      }
    }

    if (isValid) {

      $('#modalLoading').modal({ backdrop: 'static', keyboard: false });
    }
  });

  //Select all checkboxes on click
  $("#chkRow").click(function () {
    var checkBoxes = $("input[type=checkbox]").not(this);
    checkBoxes.prop("checked", !checkBoxes.prop("checked"));
  });

  $('#btnPrint').click(function () {
    var selecteds = $("input[type=checkbox]:checked").not('#chkRow').length;
    if (selecteds > 0) {
      var ids = Array();
      $("input[type=checkbox]:checked").not('#chkRow').each(function () {
        ids.push(this.id.split("-")[1]);
      });
      var urlArray = window.location.href.split("/");
      if (urlArray[urlArray.length - 1] == "timesheets") {
        window.open(window.location.href + "/action/" + ids.join(",") + "/print", '_blank');
      } else {
        window.open(window.location.href.replace(/\/[^\/]*$/, '/timesheets/action/' + ids.join(",") + "/print", '_blank'));
      }
    }
  });

  $('#btnPrintSummary').click(function () {
    var selecteds = $("input[type=checkbox]:checked").not('#chkRow').length;
    if (selecteds > 0) {
      var ids = Array();
      $("input[type=checkbox]:checked").not('#chkRow').each(function () {
        ids.push(this.id.split("-")[1]);
      });
      var urlArray = window.location.href.split("/");
      if (urlArray[urlArray.length - 1] == "timesheets") {
        window.open(window.location.href + "/action/" + ids.join(",") + "/print", '_blank');
      } else {
        window.open(window.location.href.replace(/\/[^\/]*$/, '/timesheets/action/' + ids.join(",") + "/print_summary", '_blank'));
      }
    }
  });

  $('#btnDelete').click(function () {

    var selecteds = $("input[type=checkbox]:checked").not('#chkRow').length;
    if (selecteds > 0) {
      var url = window.location.pathname + "/action/";
      var ids = Array();
      $("input[type=checkbox]:checked").not('#chkRow').each(function () {
        ids.push(this.id.split("-")[1]);
      });
      var result = confirm("Are you sure you want to delete following documents: " + ids + "?");
      if (result == true) {
        $(location).attr('href', url + ids.join(",") + "/delete");
      }
    } else {
      alert('Please, selected records you want to delete!');
    }
  });

  $('.delete').click(function () {
    var result = confirm("Are you sure you want to delete this document (#" + $(this).attr('id') + ")?");
    if (result == true) {
      $(location).attr('href', window.location.pathname + '/action/' + $(this).attr('id') + "/delete");
    }
  });

  $('#btnStatus').click(function () {
    var selecteds = $("input[type=checkbox]:checked").not('#chkRow').length;
    if (selecteds > 0) {
      $('#modalChangeStatus').modal('show');
    }
  });

  $('#btnTextFile').click(function () {
    var selecteds = $("input[type=checkbox]:checked").not('#chkRow').length;
    if (selecteds > 0) {
      var ids = Array();
      $("input[type=checkbox]:checked").not('#chkRow').each(function () {
        ids.push(this.id.split("-")[1]);
      });
      var urlArray = window.location.href.split("/");
      if (urlArray[urlArray.length - 1] == "timesheets") {
        window.open(window.location.href + "/action/" + ids.join(",") + "/print", '_blank');
      } else {
        window.open(window.location.href.replace(/\/[^\/]*$/, '/timesheets/action/' + ids.join(",") + "/file", '_blank'));
      }
    }
  });

  $('#selectLocation').change(function () {
    window.location = window.location.href += "&type=" + $(this).val();
  });

  $('#selectCompany').change(function () {
    window.location = window.location.href += "&company=" + $(this).val();
  });

  $('#selectDrawing').change(function () {
    var urlArray = window.location.href.split("/");
    if (urlArray[urlArray.length - 1].indexOf("?") !== -1) {
      window.location = window.location.href += "&drawing=" + $(this).val();
    } else {
      window.location = window.location.href += "?drawing=" + $(this).val();
    }
  });

  $('#selectStatus').change(function () {
    console.log(this);
    if ($(this).val() !== "") {
      window.location = window.location.href += "&status=" + $(this).val();
    }
  });

  $('#selectWeekEnd').change(function () {
    console.log(this);
    if ($(this).val() !== "") {
      window.location = window.location.href += "&week_end=" + $(this).val();
    }
  });

  $('#selectJob').change(function () {
    console.log(this);
    if ($(this).val() !== "") {
      window.location = window.location.href += "&job=" + $(this).val();
    }
  });

  $('#btnSaveStatus').click(function () {
    var selecteds = $("input[type=checkbox]:checked").not('#chkRow').length;
    if (selecteds > 0) {
      var ids = Array();
      var newStatus = $("select[name=changeStatus]").val();
      //Get checked timesheets
      $("input[type=checkbox]:checked").not('#chkRow').each(function () {
        ids.push(this.id.split("-")[1]);
      });

      var urlArray = window.location.href.split("/");
      if (urlArray[urlArray.length - 1] == "timesheets") {
        window.location += '/action/' + ids.join(",") + "/update/" + newStatus;
      } else {
        window.location = window.location.href.replace(/\/[^\/]*$/, '/timesheets/action/' + ids.join(",") + "/update/" + newStatus);
      }
    }
  });

  function getBaseUrl() {
    var re = new RegExp(/^.*\//);
    return re.exec(window.location.href);
  }

  var employeesSelected = [];
  $(document).on('click', '.btn-select', function () {

    if (employeesSelected.indexOf(this.id.toString()) === -1) {
      employeesSelected.push(this.id);
      jQuery("#emp-" + this.id).detach().appendTo('#selecteds');
      $(this).removeClass('btn-success btn-select').addClass('btn-danger btn-remove').text('Remove');
      $("#countSelecteds").text("(" + employeesSelected.length + ")");
    }
    console.log(employeesSelected);
  });

  $(document).on('click', '.btn-remove', function () {
    /* Act on the event */

    var result = confirm("Are you sure you want to unselect this employee?");
    if (result == true) {
      jQuery("#emp-" + this.id).remove();
      employeesSelected.splice(employeesSelected.indexOf(this.id), 1);
      $("#countSelecteds").text("(" + employeesSelected.length + ")");
    }
  });

  $("#btn-continue").click(function () {
    if (employeesSelected.length > 0) {
      window.location = "create/" + employeesSelected.join(",");
    }
  });

  $('#btnSearch').click(function () {

    $('#employee').empty();
    var name = $('#search').val();
    var loc = window.location.pathname.replace("timesheets/select", "");
    $.ajax({
      url: loc + "api/employees/" + name,
      type: 'GET',
      dataType: 'json'
    }).done(function (data) {
      $.each(data, function (key, val) {
        var emp = '\n\n                      <div id="emp-' + val.id + '" class="active select-employee card ' + (val.last_timesheet === null || val.last_timesheet === undefined ? "" : "bg-warning") + '">\n                        <div class="select-employee card-header" role="tab" id="heading-undefined">\n                        <div class="row">\n                          <div class="' + (val.last_timesheet === null || val.last_timesheet === undefined ? "col-md-11 col-lg-11" : "col-md-9 col-lg-9") + '">\n                            <h6>\n                                <a href="' + (val.last_timesheet === null || val.last_timesheet === undefined ? "create/" + val.id : "#") + '" style="' + (val.last_timesheet === null || val.last_timesheet === undefined ? "" : "color: white;") + '">\n                                  <span> ' + val.name + '</span>\n                                </a>\n                            </h6>\n                            <i style="' + (val.last_timesheet === null || val.last_timesheet === undefined ? "display: none" : "display: block;") + '">This employee already has a Time Sheet for this week   &#32;</i>\n                          </div>\n                          <div class="col-md-2 col-lg-2" style="' + (val.last_timesheet === null || val.last_timesheet === undefined ? "display: none" : "display: block;") + '">\n                            <a href="action/' + (val.last_timesheet === null || val.last_timesheet === undefined ? "" : val.last_timesheet) + '/print" class="btnAdd btn btn-primary" style="color: white;display:' + (val.last_timesheet === null || val.last_timesheet === undefined ? "none" : "block") + ';" target="_blank">View Time Sheet</a>\n                          </div>\n\n                          <div class="col-md-1 col-lg-1 float-right" style="padding-left: 0px; ' + (val.last_timesheet === null || val.last_timesheet === undefined ? "display: block" : "display: none;") + '">\n                            <button id="' + val.id + '" class="btn btn-success btn-select" style="' + (employeesSelected.indexOf(val.id.toString()) === -1 ? '' : 'display:none;') + '">Select</button>\n                          </div>\n                        </div>\n                      </div>';
        $('#employee').append(emp);
      });
    }).fail(function () {
      console.log("error");
    });
  });

  $('#btnEntitlements').click(function () {
    $('#modalUpdateEntitlements').modal('show');
  });

  $('#btn_create_mult_fire').click(function () {
    $('#modalCreateMultipleFire').modal('show');
  });

  $('.btnPrintEmployee').click(function () {
    var selecteds = $("input[type=checkbox]:checked").not('#chkRow').length;
    if (selecteds > 0) {
      var ids = Array();
      $("input[type=checkbox]:checked").not('#chkRow').each(function () {
        ids.push(this.id.split("-")[1]);
      });

      var urlArray = window.location.href.split("/");
      window.open("employees/action/" + ids.join(",") + "/" + this.id, '_blank');
    }
  });

  $('.btnPrintFireLabel').click(function () {
    var selecteds = $("input[type=checkbox]:checked").not('#chkRow').length;
    if (selecteds > 0) {
      var ids = Array();
      $("input[type=checkbox]:checked").not('#chkRow').each(function () {
        ids.push(this.id.split("-")[1]);
      });

      var urlArray = window.location.href.split("/");
      var job_id = void 0;
      if (urlArray[urlArray.length - 1].indexOf("?") === -1) {

        job_id = urlArray[urlArray.length - 1];
      } else {
        job_id = urlArray[urlArray.length - 1].split("?")[0];
      }
      urlArray.splice(urlArray.length - 1, 1);

      window.open(urlArray.join("/") + "/" + job_id + "/action/" + ids.join(",") + "/label", '_blank');
    }
  });

  $('.btnPrintFireReport').click(function () {
    var selecteds = $("input[type=checkbox]:checked").not('#chkRow').length;
    if (selecteds > 0) {
      var ids = Array();
      $("input[type=checkbox]:checked").not('#chkRow').each(function () {
        ids.push(this.id.split("-")[1]);
      });

      var urlArray = window.location.href.split("/");
      var job_id = void 0;
      if (urlArray[urlArray.length - 1].indexOf("?") === -1) {

        job_id = urlArray[urlArray.length - 1];
      } else {
        job_id = urlArray[urlArray.length - 1].split("?")[0];
      }
      urlArray.splice(urlArray.length - 1, 1);

      window.open(urlArray.join("/") + "/" + job_id + "/action/" + ids.join(",") + "/report", '_blank');
    }
  });

  $('#btnGenerateTimeSheets').click(function () {
    var selecteds = $("input[type=checkbox]:checked").not('#chkRow').length;
    if (selecteds > 0) {

      $("input[type=checkbox]:checked").not('#chkRow').each(function () {
        window.open("employee_entries/generate/" + this.id.split("-")[1], '_blank');
      });
    }
  });

  //Night Work
  $(".chk_night_work").click(function () {

    var group = $(this).attr('id').split('_');

    var row = Number(group[2]);
    var day = group[1];
    //mon_end_1
    $('#' + day + "_end_" + row).trigger("change", [true]);

    $('#' + this.id.replace("_night", "")).trigger("change");
    //Add night class to hours
    if ($(this).is(':checked')) {

      $('#' + day + "_hours_" + row).addClass('night');
    } else {

      $('#' + day + "_hours_" + row).removeClass('night');
    }

    $('#' + this.id.replace("_night", "")).trigger("click");
  });

  //Check if page is being executed via controller
  if ($.urlParam('generate') == 1) {
    $(".hour-end").trigger("change");
    var action = $("#timesheet_form").attr("action");
    $("#timesheet_form").attr("action", action + "?generated=1");
    $('#timesheet_form').submit();
  }

  console.log($.urlParam('generate'));
});

/***/ })

/******/ });