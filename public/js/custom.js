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

    $('form').submit(function () {
        /* Act on the event */
        $('#modalLoading').modal('show');
    });

    $('#flash-message').fadeOut(7000);

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
    $('.date-picker').datepicker({
        format: 'dd/mm/yyyy'
    });

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
        var startHour = $(this).val();
        for (var hour = Number(startHour) + 15; hour <= 24 * 60 - 15; hour += 15) {
            var _option = '<option value="' + hour + '">' + minutesToHour(hour) + '</option>';
            $(destination).append(_option);
        }
    });

    $('.hour-end').change(function () {

        var day = $(this).attr('id').split('_');
        var row = Number(day[2]);

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
        var lunch = row === 1 && day[0] !== "sat" ? 15 : 0;
        duration.val(end - start - lunch > 0 ? minutesToHour(end - start - lunch) : "");

        var hours_job1 = $('#' + day[0] + '_hours_1').val();
        var hours_job2 = $('#' + day[0] + '_hours_2').val();
        var hours_job3 = $('#' + day[0] + '_hours_3').val();
        var hours_job4 = $('#' + day[0] + '_hours_4').val();

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

        if (totalHours > 8 * 60 && day[0] !== "sat") {
            //If total hours is bigger than 08:00 and day different than sat set 1.5
            hours_15 = Math.min(2 * 60, totalHours - 8 * 60);
        }

        //If total hours is bigger than 10:00 or day equal sat set 1.5
        if (totalHours > 10 * 60 || day[0] == "sat") {
            if (day[0] == "sat") {
                hours_20 = totalHours;
            } else if (job_number !== "pld") {
                hours_20 = totalHours - 8 * 60 - 2 * 60;
            }
        }

        hours_nor = totalHours - hours_15 - hours_20;

        $('#' + day[0] + '_15').val(minutesToHour(hours_15));
        $('#' + day[0] + '_20').val(minutesToHour(hours_20));
        $('#' + day[0] + '_nor').val(minutesToHour(hours_nor));

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
        $('input, select').not('#preStart, #preEnd, #output, #empDate, #preJob, #PreNormal, #Pre15, #Pre20, #preHours, #btnClearSign, #status, #output, #week_end, #empname, select[name=pld], select[name=rdo], select[name=anl], input[name=employee_id], .btnClear, input[type=hidden], .btn').val('');

        var preEnd = $('#preEnd').val();
        $('.end-1').not('#sat_end_1').val(preEnd);

        var preStart = $('#preStart').val();
        $('.start-1').not('#sat_start_1').val(preStart);

        var preJob = $('#preJob').val();
        $('.job-1').not('#sat_job_1').val(preJob);

        $(".end-1").not('#sat_end_1').trigger("change");
    });

    $(".job").change(function () {
        if ($(this).val() == "sick") {
            alert("You have to attach a medical certificate at the end of this Time Sheet or this day won't be paid!");
        }
    });

    $('.btnClear').click(function () {
        $('.' + this.id).val('');
        $('.' + this.id).trigger("change");
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
        var cert = '\n        <div class="alert alert-secondary" id="medical_certificates[' + certificates + ']_row">                          \n            <h5 style="text-align: center;">Certificate ' + certificates + '</h5>          \n            <div class="input-group col-12 mb-3">\n              <div class="custom-file" id="medical_certificates_list">\n                <input type="file" class="custom-file-input medical_certificates" id="medical_certificates[' + certificates + ']" name="medical_certificates[' + certificates + ']"/>                        \n                <label class="custom-file-label" for="medical_certificates[' + certificates + ']">Choose files</label>\n              </div>\n            </div>\n            <div class="input-group col-12 mb-3">\n                <img id="medical_certificates[' + certificates + ']_img" class="img-fluid" style="">\n            </div>   \n            <input id="medical_certificates[' + certificates + ']-delete" type="button" class="btn btn-danger btn-sm ml-2 delCert" value="Delete">\n            <input type="hidden" class="custom-file-input" id="medical_certificates[' + certificates + ']_hidden" name="medical_certificates[' + certificates + ']_hidden" value="">                        \n        </div>';
        $("#aditional_certificates").append(cert);
    });

    $('#timesheet_form').submit(function (event) {

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
                    event.preventDefault();
                    alert("Select start, end time and job " + jobNumber + " for " + day.description);
                    $("#" + day.short + "_job_" + jobNumber).focus();
                    return false;
                }
                if (job.length > 0 && (start.length === 0 || end.length === 0 || start === "0" && end === "0")) {
                    event.preventDefault();
                    alert("Select start, end time and job " + jobNumber + " for " + day.description);
                    $("#" + day.short + "_job_" + jobNumber).focus();
                    return false;
                }

                /*
                          var files = 0;
                          $("input[type=file]").each(function() {
                            if (this.files[0].length > 0) {
                              files++;
                            }
                          });
                
                          if (job === "sick" && files === 0) {
                            event.preventDefault();
                            alert("Please, attach medical certificate(s)");
                            $("#medical_certificates").focus();
                            return false;
                          } else {
                            $('#medical_certificates_hidden')
                          }     */
            });
        });
        $('#modalLoading').modal('hide');
    });

    //Select all checkboxes on click
    $("#chkRow").click(function () {
        var checkBoxes = $("input[type=checkbox]").not(this);
        checkBoxes.prop("checked", !checkBoxes.prop("checked"));
    });

    $('#btnPrint').click(function () {
        var selecteds = $("input[type=checkbox]:checked").not('#chkRow').length;
        if (selecteds > 0) {
            var url = "timesheets/action/";
            var ids = Array();
            $("input[type=checkbox]:checked").not('#chkRow').each(function () {
                ids.push(this.id.split("-")[1]);
            });

            window.open(url + ids.join(",") + "/print", '_blank');
        }
    });

    $('#btnDelete').click(function () {

        var selecteds = $("input[type=checkbox]:checked").not('#chkRow').length;
        if (selecteds > 0) {
            $('#modalLoading').modal('show');
            var url = window.location.pathname + "/action/";
            var ids = Array();
            $("input[type=checkbox]:checked").not('#chkRow').each(function () {
                ids.push(this.id.split("-")[1]);
            });
            var result = confirm("Are you sure you want to delete following documents: " + ids + "?");
            if (result == true) {
                $(location).attr('href', url + ids.join(",") + "/delete");
            }
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

    $('#btnSaveStatus').click(function () {
        var selecteds = $("input[type=checkbox]:checked").not('#chkRow').length;
        if (selecteds > 0) {
            var url = "/timesheets/action/";
            var ids = Array();
            $("input[type=checkbox]:checked").not('#chkRow').each(function () {
                ids.push(this.id.split("-")[1]);
            });
            var newStatus = $("select[name=changeStatus]").val();
            $(location).attr('href', url + ids.join(",") + "/update/" + newStatus);
        }
    });

    function getBaseUrl() {
        var re = new RegExp(/^.*\//);
        return re.exec(window.location.href);
    }
    $('#btnSearch').click(function () {
        $('#modalLoading').modal('show');
        $('#employee').empty();
        var name = $('#search').val();
        var loc = window.location.pathname.replace("timesheets/select", "");
        $.ajax({
            url: loc + "api/employees/" + name,
            type: 'GET',
            dataType: 'json'
        }).done(function (data) {
            $('#modalLoading').modal('hide');
            $.each(data, function (key, val) {
                var emp = '\n\n                      <div class="active select-employee card ' + (val.last_timesheet === null || val.last_timesheet.id === undefined ? "" : "bg-warning") + '">\n                        <div class="select-employee card-header" role="tab" id="heading-undefined">\n                          <h6 class="mb-0">\n                            <div>\n                              <a href="create/' + val.id + ' " style="' + (val.last_timesheet === null || val.last_timesheet.id === undefined ? "" : "color: white;") + '">\n                                <span> ' + val.name + '</span>\n                                </a>\n                              <div class="float-right" style="' + (val.last_timesheet === null || val.last_timesheet.id === undefined ? "display: none" : "display: block;") + '">\n                               <i style="margin-right: 20px;">This employee already have a Time Sheet for this week   &#32;</i>\n                              <a href="action/' + (val.last_timesheet === null || val.last_timesheet.id === undefined ? "" : val.last_timesheet.id) + '/print" class="btnAdd btn btn-primary float-right" style="color: white;display:' + (val.last_timesheet === null || val.last_timesheet.id === undefined ? "none" : "block") + ';" target="_blank">View</a>\n                              </div>                                \n                            </div>\n                          </h6>\n                        </div>\n                        </div>';
                $('#employee').append(emp);
            });
        }).fail(function () {
            console.log("error");
        });
    });
});

/***/ })

/******/ });