$(document).ready(function() {

  $.urlParam = function(name){
      var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
      if (results==null){
         return null;
      }
      else{
         return decodeURI(results[1]) || 0;
      }
  }

  $('form').not('#timesheet_form').submit(function(event) {

    $('#modalLoading').modal({backdrop: 'static', keyboard: false});

  });

  $('#flash-message').fadeOut(15000);

  function addMinutes(time, minsToAdd) {

    function D(J) {

      return (
        J < 10
        ? '0'
        : '') + J;

    };

    var piece = time.split(':');
    var mins = piece[0] * 60 + + piece[1] + + minsToAdd;
    return D(mins % (24 * 60) / 60 | 0) + ':' + D(mins % 60);
  }

  function hourToMinutes(hour) {

    var piece = hour.split(':');

    if (piece.length > 1) {

      return piece[0] * 60 + + piece[1];

    } else {

      return 0;

    }
  }

  function minutesToHour(minutes) {

    function D(J) {

      return (

        J < 10
        ? '0'
        : '') + J;

    };
    return D(minutes / 60 | 0) + ':' + D(minutes % 60);
  }

  //Setup datepicker
  $('.date-picker').datepicker({format: 'dd/mm/yyyy'});

  //Show extra jobs for selected day
  showExtra = function(btn, extra_inputs) {

    $(extra_inputs).css('display', 'block');

    $(btn).fadeOut();

  }

  //Update list of hours in accord with current selection
  $('.hour-start').change(function() {

      let day = $(this).attr('id').split('_');
      let row = day[2];
      let destination = $('#' + day[0] + "_end_" + row);

      //Enable and empty select list for end of the row
      destination.prop('disabled', false).empty();
      let option = '<option value="">-</option>';
      destination.append(option);

      //Get the seleted value to be used as minimum for end
      var startHour = $('#group_' + day[0] + "_" + day[2] + "_night").is(':checked') ? 0 : $(this).val();
      for (var hour = Number(startHour); hour <= (24 * 60) - 15; hour += 15) {
        let option = '<option value="' + hour + '">' + minutesToHour(hour) + '</option>';
        $(destination).append(option);
      }
  });

  //Calculate Normal Hours
  $('.hour-end').change(function() {

    let day = $(this).attr('id').split('_');
    let row = Number(day[2]);

    let isNight = false;

    if($('#group_' + day[0] + "_" + day[2] + "_night").is(':checked')) {
        isNight = true;
    }

    let next_row = row + 1;

    let next_row_el = $('#' + day[0] + "_start_" + next_row);

    if (next_row_el.length > 0) {

      //Clear next row
      next_row_el.prop('disabled', false).empty();
      var next_duration = $('#' + day[0] + '_hours_' + next_row);
      next_duration.val("");
      var next_end = $('#' + day[0] + '_end_' + next_row);
      next_end.val("");

      let option = '<option value="">-</option>';
      next_row_el.append(option);

      //Get the seleted value to be used as minimum for start on next row
      var startHour = $(this).val();
      //Populate select with times
      for (var hour = Number(startHour); hour <= (24 * 60) - 15; hour += 15) {
        let option = '<option value="' + hour + '">' + minutesToHour(hour) + '</option>';
        next_row_el.append(option);
      }
    }

    //Clear next day
    var duration = $('#' + day[0] + '_hours_' + row);
    var start = Number($('#' + day[0] + "_start_" + row).val());
    var end = Number($(this).val());
    var lunch = (row === 1) ? 15 : 0;


    //Calculate duration of job
    if (isNight && end < start) {

      duration.val(((end + (24*60)) - start  - lunch) > 0 ? minutesToHour((end + (24*60)) - start  - lunch ): "");

    } else {

      duration.val((end - start - lunch) > 0 ? minutesToHour(end - start - lunch): "");

    }

    calcTotalDay(day[0]);
    calcTotal();

  });


  calcTotalDay = function(day) {


          //Set variables to get hours from every job
        var hours_job1 = "00:00";
        var hours_job2 = "00:00";
        var hours_job3 = "00:00";
        var hours_job4 = "00:00";


          //Get hours from every job
        if ($('#' + day + '_hours_1')) {
          hours_job1 = $('#' + day + '_hours_1').val();
        }

        if ($('#' + day + '_hours_2')) {
          hours_job2 = $('#' + day + '_hours_2').val();
        }

        if ($('#' + day + '_hours_3')) {
          hours_job3 = $('#' + day + '_hours_3').val();
        }

        if ($('#' + day + '_hours_4')) {
          hours_job4 = $('#' + day + '_hours_4').val();
        }

        //Determine jobs that are night shift
        var isNight1 = $('#group_' + day + "_1_night").is(':checked') ? true : false;
        var isNight2 = $('#group_' + day + "_2_night").is(':checked') ? true : false;
        var isNight3 = $('#group_' + day + "_3_night").is(':checked') ? true : false;
        var isNight4 = $('#group_' + day + "_4_night").is(':checked') ? true : false;

        hours_job1 = hourToMinutes(hours_job1);
        hours_job2 = hourToMinutes(hours_job2);
        hours_job3 = hourToMinutes(hours_job3);
        hours_job4 = hourToMinutes(hours_job4);

        //Calculate total hours

        var totalHours = 0;
        var totalHoursNight = 0;

        //Get all hours except night shift
        if (!isNight1) {
          totalHours += hours_job1;
        }

        if (!isNight2) {
          totalHours += hours_job2;
        }

        if (!isNight3) {
          totalHours += hours_job3;
        }

        if (!isNight4) {
          totalHours += hours_job4;
        }

        //Get all hours of night shift
        if (isNight1) {
          totalHoursNight += hours_job1;
        }

        if (isNight2) {
          totalHoursNight += hours_job2;
        }

        if (isNight3) {
          totalHoursNight += hours_job3;
        }

        if (isNight4) {
          totalHoursNight += hours_job4;
        }



        //Clear 1.5 and 2.0 fields
        $('#' + day + '_nor').val('');
        $('#' + day + '_15').val('');
        $('#' + day + '_20').val('');

        $('#' + day + '_total').val(minutesToHour(totalHours + totalHoursNight));

        var hours_15 = 0;
        var hours_20 = 0;
        var hours_nor = 0;

        //var job_number = $('#job' + day[0].charAt(0).toUpperCase() + day[0].slice(1) + row).val();

        //Calculate hours 1.5
        if (totalHours > (8 * 60) && day !== "sat" && day !== "sun") {
          //If total hours is bigger than 08:00 and day different than sat set 1.5
          hours_15 = Math.min((2 * 60), totalHours - (8 * 60));

        }

        //If total hours is bigger than 10:00 or day equal sat set 1.5
        if ((totalHours > (10 * 60) || day == "sat" || day == "sun") ) {

          if (day == "sat" || day == "sun") {

            hours_20 = totalHours;

          } else {

            hours_20 = totalHours - (8 * 60) - (2 * 60);

          }

        }

        hours_nor = totalHours - hours_15 - hours_20;


        //Working with night shift
        //Calculate hours 1.5
        if (day !== "sat" && day !== "sun") {
          //If total hours is bigger than 08:00 and day different than sat set 1.5
          hours_15 += Math.min((2 * 60), totalHoursNight);

        }
        //Calculate hours 2.0 for night shift
        //If total hours is bigger than 02:00
        if ((totalHoursNight > (2 * 60) || day == "sat" || day == "sun") ) {

          if (day == "sat" || day == "sun") {

            hours_20 += totalHoursNight;

          } else {

            hours_20 += totalHoursNight - (2 * 60);

          }

        }



        $('#' + day + '_15').val(minutesToHour(hours_15));
        $('#' + day + '_20').val(minutesToHour(hours_20));
        $('#' + day + '_nor').val(minutesToHour(hours_nor));

  }



  calcTotal = function() {

    //Calculate total of normal hours
    var normalTotal = 0;
    $('.horNormal').each(function() {

      normalTotal += hourToMinutes($(this).val());

    });
    $('#totalNormal').val(minutesToHour(normalTotal));

    //Calculate total of hours
    var hoursTotal = 0;

    $('.hours-total').each(function() {

      hoursTotal += hourToMinutes($(this).val());

    });

    $('#totalWeek').val(minutesToHour(hoursTotal));

    //Calculate total of hours 1.5
    var hours15 = 0;
    $('.hor15').each(function() {

      hours15 += hourToMinutes($(this).val());

    });

    $('#total15').val(minutesToHour(hours15));

    //Calculate total of hours 2.0
    var hours20 = 0;
    $('.hor20').each(function() {
      hours20 += hourToMinutes($(this).val());
    });
    $('#total20').val(minutesToHour(hours20));

  }

  //Define actions on click button Autofill
  $('#btnPreFill').click(function() {
    //Clear all inputs
    $('input, select').not('#preStart, #preEnd, #output, #empDate, #preJob, #PreNormal, #Pre15, #Pre20, #preHours, #btnClearSign, #status, #output, #week_end, #empname, select[name=pld], select[name=rdo], select[name=anl], input[name=employee_id], .btnClear, input[type=hidden], .btn, #preJob_description, #job_description, .chk_night_work, .chk_tafe, .chk_sick, .chk_public_holiday').val('');

    let preEnd = $('#preEnd').val();
    $('.end-1').not('#sat_end_1, #sun_end_1').val(preEnd);

    let preStart = $('#preStart').val();
    $('.start-1').not('#sat_start_1, #sun_start_1').val(preStart);

    let preJob = $('#preJob').val();
    $('.job-1').not('#sat_job_1, #sun_job_1').val(preJob);

    let preJobDescription = $('#preJob_description').val();
    $('.job_description_1').not('#sat_job_1_description, #sun_job_1_description').val(preJobDescription);

    $(".end-1").not('#sat_end_1, #sun_end_1').trigger("change");
  });

  $(".job").change(function() {
    if ($(this).val() == "sick") {
      alert("You have to attach a medical certificate at the end of this Time Sheet or this day won't be paid!");
    }
  });

  $(".chk_tafe, .chk_sick, .chk_public_holiday").click(function() {

    if($(this).prop("checked") == true){

      alert("Please, select Job!");      

    }    
  
    
  });



  $(".job, #preJob").change(function() {

    if ($(this).val() == "001" || $(this).val() == "002") {

      $('#modalDescription').modal({backdrop: 'static', keyboard: false});

      $('#description_destination').val(this.id);

    } else if ($(this).val() == "sick" || $(this).val() == "tafe" || $(this).val() == "holiday") {

      $('#modalJobSelector').modal({backdrop: 'static', keyboard: false});

      $('#description_destination').val(this.id);      
      
    }

    //alert('#' + this.id + "_description" + "here");
    $('#' + this.id + "_description").val('');
    
    
  });

  $('#btnSaveDescription').click(function() {
    let destination = $('#description_destination').val();
    let description = $('#job_description').val();
    $("#" + destination + "_description").val(description);
    $('#modalDescription').modal('hide');
  });

  $('#btnSaveTafeSickJob').click(function() {
    let destination = $('#description_destination').val();
    let description = $('#job_tafesickholiday').val();
    $("#" + destination + "_description").val(description);
    $('#modalJobSelector').modal('hide');
  });

  $('#modalDescription').on('hidden.bs.modal', function(e) {
    let description = $('#job_description').val();
    let destination = $('#description_destination').val();
    if (description == "") {
      $('#' + destination).val('');
      $("#" + destination + "_description").val('');
    }
  });

  $('#modalJobSelector').on('hidden.bs.modal', function(e) {
    let description = $('#job_tafesickholiday').val();
    let destination = $('#description_destination').val();
    
    let description_job = $("#" + destination + "_description").val();
    if (description !== description_job || description == "") {
      $('#' + destination).val('');
      $("#" + destination + "_description").val('')
    }
  });

  $('#job_tafesickholiday').change(function(){

      if ($(this).val() == "") {

        $('#btnSaveTafeSickJob').prop("disabled", true);

      } else {

        $('#btnSaveTafeSickJob').removeAttr("disabled");      

      }
                  
  });


  $('.btnClear').click(function() {

    $('.' + this.id).val('');
    $('.' + this.id).trigger("change");
  });

  var qty_medical_certificates = 1;

  function loadCert(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function(e) {
        var destination = $(input).prop('name');
        var preview = $("[id*='" + destination + "_img']");
        preview.attr('src', e.target.result).show();
        var hidden = $("#" + destination + "_hidden");
        hidden.val(e.target.result);
      }
      reader.readAsDataURL(input.files[0]);
    }
  }

  function resizeImage(input, width = 600) {
    var destination = $(input).prop('name');
    var preview = $("[id*='" + destination + "_img']");
    var hidden = $("[id*='" + destination + "_hidden']");

    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function(event) {
        var img = new Image();
        img.onload = function() {
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
  $(document).on("change", "input[type=file]", function() {
    resizeImage(this);
  });

  $(document).on("click", ".delCert", function() {
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
  $("#addCert").click(function() {
    certificates++;
    var cert = `
        <div class="alert alert-secondary" id="medical_certificates[` + certificates + `]_row">
            <h5 style="text-align: center;">Certificate ` + certificates + `</h5>
            <div class="input-group col-12 mb-3">
              <div class="custom-file" id="medical_certificates_list">
                <input type="file" class="custom-file-input medical_certificates" id="medical_certificates[` + certificates + `]" name="medical_certificates[` + certificates + `]"/>
                <label class="custom-file-label" for="medical_certificates[` + certificates + `]">Choose files</label>
              </div>
            </div>
            <div class="input-group col-12 mb-3">
                <img id="medical_certificates[` + certificates + `]_img" class="img-fluid" style="">
            </div>
            <input id="medical_certificates[` + certificates + `]-delete" type="button" class="btn btn-danger btn-sm ml-2 delCert" value="Delete">
            <input type="hidden" class="custom-file-input" id="medical_certificates[` + certificates + `]_hidden" name="medical_certificates[` + certificates + `]_hidden" value="">
        </div>`;
    $("#aditional_certificates").append(cert);

  });

  $('#timesheet_form').on('submit', function(event) {

    var isValid = true;
    var days = [
      {
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
      }
    ];

    var jobs = [1, 2, 3, 4];
    $.each(days, function(keyDay, day) {
      $.each(jobs, function(key, jobNumber) {

        //Check if job was selected
        let start = $("#" + day.short + "_start_" + jobNumber).val();
        let end = $("#" + day.short + "_end_" + jobNumber).val();
        let job = $("#" + day.short + "_job_" + jobNumber).val();
        let hours = $("#" + day.short + "_hours_" + jobNumber).val();

        if ((hours !== "") && (start === "" && end === "" || job === "") || (start !== "") && (end === "" || job === "" || hours === "") || (end !== "") && (start === "" || job === "" || hours === "")) {
          isValid = false;
          event.preventDefault();
          alert("Select start, end time and job " + jobNumber + " for " + day.description);
          $("#" + day.short + "_job_" + jobNumber).focus();

          return false;
        }
        if ((job.length > 0) && ((start.length === 0 || end.length === 0) || (start === "0" && end === "0"))) {
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

      $('#modalLoading').modal({backdrop: 'static', keyboard: false});

    }
  });

  //Select all checkboxes on click
  $("#chkRow").click(function() {
    var checkBoxes = $("input[type=checkbox]").not(this);
    checkBoxes.prop("checked", !checkBoxes.prop("checked"));
  });

  $('#btnPrint').click(function() {
    let selecteds = $("input[type=checkbox]:checked").not('#chkRow').length;
    if (selecteds > 0) {
      let ids = Array();
      $("input[type=checkbox]:checked").not('#chkRow').each(function() {
        ids.push(this.id.split("-")[1]);
      });
      let urlArray = window.location.href.split("/");
      if (urlArray[urlArray.length - 1] == "timesheets") {
        window.open(window.location.href + "/action/" + ids.join(",") + "/print", '_blank');
      } else {
        window.open(window.location.href.replace(/\/[^\/]*$/, '/timesheets/action/' + ids.join(",") + "/print", '_blank'));
      }
    }
  });

  $('#btnPrintSummary').click(function() {
    let selecteds = $("input[type=checkbox]:checked").not('#chkRow').length;
    if (selecteds > 0) {
      let ids = Array();
      $("input[type=checkbox]:checked").not('#chkRow').each(function() {
        ids.push(this.id.split("-")[1]);
      });
      let urlArray = window.location.href.split("/");
      if (urlArray[urlArray.length - 1] == "timesheets") {
        window.open(window.location.href + "/action/" + ids.join(",") + "/print", '_blank');
      } else {
        window.open(window.location.href.replace(/\/[^\/]*$/, '/timesheets/action/' + ids.join(",") + "/print_summary", '_blank'));
      }
    }
  });



  $('#btnDelete').click(function() {

    let selecteds = $("input[type=checkbox]:checked").not('#chkRow').length;
    if (selecteds > 0) {
      let url = window.location.pathname + "/action/";
      let ids = Array();
      $("input[type=checkbox]:checked").not('#chkRow').each(function() {
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

  $('.delete').click(function() {
    var result = confirm("Are you sure you want to delete this document (#" + $(this).attr('id') + ")?");
    if (result == true) {
      $(location).attr('href', window.location.pathname + '/action/' + $(this).attr('id') + "/delete");
    }
  });

  $('#btnStatus').click(function() {
    let selecteds = $("input[type=checkbox]:checked").not('#chkRow').length;
    if (selecteds > 0) {
      $('#modalChangeStatus').modal('show');
    }
  });

  $('#btnIntegrate').click(function() {
    let selecteds = $("input[type=checkbox]:checked").not('#chkRow').length;
    if (selecteds > 0) {
      $('#modalIntegrateMyOb').modal({backdrop: 'static', keyboard: false});
      $('#btnStartIntegration').removeAttr('disabled');
    }
  });

  $('#btnStartIntegration').click(function() {
    let selecteds = $("input[type=checkbox]:checked").not('#chkRow').length;
    if (selecteds > 0) {
      let ids = Array();
      var today = new Date();
      var date = today.getDate() + '/' + (today.getMonth()+1) + '/' + today.getFullYear();
      var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
      var dateTime = date+' '+time;

      $('#integration_details').append('Started at: ' + dateTime.toString() + '\n' + '\n');

      //Get checked timesheets
      var progress = 0;
      var step = 100.00 / selecteds;
      $('#integration_progress').css('width', '100%').html('Please, wait...');
      $('#btnStartIntegration').attr("disabled", "disabled");
      $("input[type=checkbox]:checked").not('#chkRow').each(function() {

        $.post( "myob/integrate", { _token: $('input[name=_token]').val(), id: this.id.split("-")[1]}, function(data) {
          progress += step;
          $('#integration_progress').css('width', progress + '%').html(Math.round(progress) + '%');


          $('#integration_details').append(data.name + ' - ' + data.result + '\n');
          console.log(data);
        })
          .done(function() {
            console.log( "second success" );
          })
          .fail(function() {
            console.log( "error" );
          })
          .always(function() {
            console.log( "finished" );
          });

      });

    }

  });





  $('#btnTextFile').click(function() {
    let selecteds = $("input[type=checkbox]:checked").not('#chkRow').length;
    if (selecteds > 0) {
      let ids = Array();
      $("input[type=checkbox]:checked").not('#chkRow').each(function() {
        ids.push(this.id.split("-")[1]);
      });
      let urlArray = window.location.href.split("/");
      if (urlArray[urlArray.length - 1] == "timesheets") {
        window.open(window.location.href + "/action/" + ids.join(",") + "/print", '_blank');
      } else {
        window.open(window.location.href.replace(/\/[^\/]*$/, '/timesheets/action/' + ids.join(",") + "/file", '_blank'));
      }
    }
  });





  $('#selectLocation').change(function() {
    window.location = window.location.href += "&type=" + $(this).val();
  });

  $('#selectCompany').change(function() {
      window.location = window.location.href += "&company=" + $(this).val();
  });

  $('#selectDrawing').change(function() {
    let urlArray = window.location.href.split("/");
    if (urlArray[urlArray.length - 1].indexOf("?") !== -1) {
      window.location = window.location.href += "&drawing=" + $(this).val();
    } else {
      window.location = window.location.href += "?drawing=" + $(this).val();
    }


  });

  $('#selectStatus').change(function() {

      if ($(this).val() !== "") {
          window.location = window.location.href += "&status=" + $(this).val();
      }

  });

  $('#selectWeekEnd').change(function() {

      if ($(this).val() !== "") {
          window.location = window.location.href += "&week_end=" + $(this).val();
      }

  });

  $('#selectJob').change(function() {

      if ($(this).val() !== "") {
          window.location = window.location.href += "&job=" + $(this).val();
      }

  });


  $('#btnSaveStatus').click(function() {
    let selecteds = $("input[type=checkbox]:checked").not('#chkRow').length;
    if (selecteds > 0) {
      let ids = Array();
      let newStatus = $("select[name=changeStatus]").val();
      //Get checked timesheets
      $("input[type=checkbox]:checked").not('#chkRow').each(function() {
        ids.push(this.id.split("-")[1]);
      });

      let urlArray = window.location.href.split("/");
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

  let employeesSelected = [];
  $(document).on('click', '.btn-select', function() {

    if (employeesSelected.indexOf(this.id.toString()) === -1) {
      employeesSelected.push(this.id);
      jQuery("#emp-" + this.id).detach().appendTo('#selecteds');
      $(this).removeClass('btn-success btn-select').addClass('btn-danger btn-remove').text('Remove');
      $("#countSelecteds").text("(" + employeesSelected.length + ")");
    }

  });

  $(document).on('click', '.btn-remove', function() {
    /* Act on the event */

    var result = confirm("Are you sure you want to unselect this employee?");
    if (result == true) {
      jQuery("#emp-" + this.id).remove();
      employeesSelected.splice(employeesSelected.indexOf(this.id), 1);
      $("#countSelecteds").text("(" + employeesSelected.length + ")");
    }
  });

  $("#btn-continue").click(function() {
    if (employeesSelected.length > 0) {
      window.location = "create/" + employeesSelected.join(",");
    }
  });

  $('#btnSearch').click(function() {

    $('#employee').empty();
    let name = $('#search').val();
    var loc = window.location.pathname.replace("timesheets/select", "");
    $.ajax({
      url: loc + "api/employees/" + name,
      type: 'GET',
      dataType: 'json'
    }).done(function(data) {
      $.each(data, function(key, val) {
        let emp = `

                      <div id="emp-` + val.id + `" class="active select-employee card ` + (val.last_timesheet === null || val.last_timesheet === undefined ? "" : "bg-warning") + `">
                        <div class="select-employee card-header" role="tab" id="heading-undefined">
                        <div class="row">
                          <div class="` + (val.last_timesheet === null || val.last_timesheet === undefined ? "col-md-11 col-lg-11" : "col-md-9 col-lg-9") + `">
                            <h6>
                                <a href="`+ (val.last_timesheet === null || val.last_timesheet === undefined ? "create/" + val.id : "#") + `" style="` + (val.last_timesheet === null || val.last_timesheet === undefined ? "": "color: white;") + `">
                                  <span> ` + val.name + `</span>
                                </a>
                            </h6>
                            <i style="` + (val.last_timesheet === null || val.last_timesheet === undefined ? "display: none" : "display: block;") + `">This employee already has a Time Sheet for this week   &#32;</i>
                          </div>
                          <div class="col-md-2 col-lg-2" style="` + (val.last_timesheet === null || val.last_timesheet === undefined ? "display: none" : "display: block;") + `">
                            <a href="action/` + (val.last_timesheet === null || val.last_timesheet === undefined? "": val.last_timesheet) + `/print" class="btnAdd btn btn-primary" style="color: white;display:` + (val.last_timesheet === null || val.last_timesheet === undefined ? "none" : "block") + `;" target="_blank">View Time Sheet</a>
                          </div>

                          <div class="col-md-1 col-lg-1 float-right" style="padding-left: 0px; `+(val.last_timesheet === null || val.last_timesheet === undefined ? "display: block" : "display: none;")+`">
                            <button id="` + val.id + `" class="btn btn-success btn-select" style="` + (employeesSelected.indexOf(val.id.toString()) === -1 ? '' : 'display:none;') + `">Select</button>
                          </div>
                        </div>
                      </div>`;
        $('#employee').append(emp);
      });
    }).fail(function() {
      console.log("error");
    });
  });

  $('#btnEntitlements').click(function() {
    $('#modalUpdateEntitlements').modal('show');
  });

  $('#btn_create_mult_fire').click(function() {
    $('#modalCreateMultipleFire').modal('show');
  });


  $('.btnPrintEmployee').click(function() {
    let selecteds = $("input[type=checkbox]:checked").not('#chkRow').length;
    if (selecteds > 0) {
      let ids = Array();
      $("input[type=checkbox]:checked").not('#chkRow').each(function() {
        ids.push(this.id.split("-")[1]);
      });

      let urlArray = window.location.href.split("/");
      window.open("employees/action/" + ids.join(",") + "/" + this.id, '_blank');

    }
  });


  $('#printMatrix').click(function() {
    let selecteds = $("input[type=checkbox]:checked").not('#chkRow').length;
    if (selecteds > 0) {
      let ids = Array();
      $("input[type=checkbox]:checked").not('#chkRow').each(function() {
        ids.push(this.id.split("-")[1]);
      });

      let urlArray = window.location.href.split("/");
      window.open("fire_matrix/action/" + ids.join(",") + "/print", '_blank');

    }
  });

  


  $('.btnPrintFireLabel').click(function() {
    let selecteds = $("input[type=checkbox]:checked").not('#chkRow').length;
    if (selecteds > 0) {
      let ids = Array();
      $("input[type=checkbox]:checked").not('#chkRow').each(function() {
        ids.push(this.id.split("-")[1]);
      });

      let urlArray = window.location.href.split("/");
      let job_id;
      if (urlArray[urlArray.length - 1].indexOf("?") === -1) {

        job_id = urlArray[urlArray.length - 1];


      } else {
        job_id = urlArray[urlArray.length - 1].split("?")[0];

      }
      urlArray.splice(urlArray.length - 1, 1);

      window.open(urlArray.join("/") + "/" + job_id + "/action/" + ids.join(",") + "/label", '_blank')
    }


  });

  $('.btnPrintFireReport').click(function() {
    let selecteds = $("input[type=checkbox]:checked").not('#chkRow').length;
    if (selecteds > 0) {
      let ids = Array();
      $("input[type=checkbox]:checked").not('#chkRow').each(function() {
        ids.push(this.id.split("-")[1]);
      });

      let urlArray = window.location.href.split("/");
      let job_id;
      if (urlArray[urlArray.length - 1].indexOf("?") === -1) {

        job_id = urlArray[urlArray.length - 1];


      } else {
        job_id = urlArray[urlArray.length - 1].split("?")[0];

      }
      urlArray.splice(urlArray.length - 1, 1);

      window.open(urlArray.join("/") + "/" + job_id + "/action/" + ids.join(",") + "/report", '_blank')
    }


  });



  $('#btnGenerateTimeSheets').click(function() {
    let selecteds = $("input[type=checkbox]:checked").not('#chkRow').length;
    if (selecteds > 0) {

      $("input[type=checkbox]:checked").not('#chkRow').each(function() {
        window.open("employee_entries/generate/" + this.id.split("-")[1], '_blank');
      });
    }
  });



  //Night Work
  $(".chk_night_work").click(function() {

    let group = $(this).attr('id').split('_');

    let row = Number(group[2]);
    let day = group[1];
    //mon_end_1
    //$('#' + day + "_end_" + row).trigger("change", [true]);

    $('#' + this.id).trigger("change");

    //Add night class to hours

/*

    if($(this).is(':checked')){

      $('#' + day + "_hours_" + row).addClass('night');

    } else {

      $('#' + day + "_hours_" + row).removeClass('night');

    }

*/
    //$('#' + this.id.replace("_night", "")).trigger("click");

  });

  //Check if page is being executed via controller
  if ($.urlParam('generate') == 1) {
      $(".hour-end").trigger("change");
      var action = $("#timesheet_form").attr("action") ;
      $("#timesheet_form").attr("action", action + "?generated=1") ;
      $('#timesheet_form').submit();
  }

  $('#btnUpdateJob').click(function(){

  });


  $('#btnChangeJob').click(function() {
    let selecteds = $("input[type=checkbox]:checked").not('#chkRow').length;
    if (selecteds > 0) {
      $('#modalChangeJob').modal('show');
    }
  });

  $('#btnSaveJob').click(function() {
    let selecteds = $("input[type=checkbox]:checked").not('#chkRow').length;
    if (selecteds > 0) {
      let ids = Array();
      let newJob = $("select[name=changeJob]").val();
      //Get checked timesheets
      $("input[type=checkbox]:checked").not('#chkRow').each(function() {
        ids.push(this.id.split("-")[1]);
      });

      let urlArray = window.location.href.split("/");
      if (urlArray[urlArray.length - 1] == "tmv") {
        window.location += '/change_job/' + ids.join(",") + "/" + newJob;
      } else {
        window.location = window.location.href.replace(/\/[^\/]*$/, '/change_job/' + ids.join(",") + "/" + newJob);
      }
    }

  });


  $('#btnPrintTmv').click(function() {
    let selecteds = $("input[type=checkbox]:checked").not('#chkRow').length;
    if (selecteds > 0) {
      $('#modalPrintTmv').modal('show');
    }
  });

  $('#btnContinuePrintTmv').click(function() {
    let selecteds = $("input[type=checkbox]:checked").not('#chkRow').length;
    if (selecteds > 0) {
      let ids = Array();
      let selectYear = $("select[name=selectYear]").val();
      let job = $("input[name=job]").val();
      //Get checked timesheets
      $("input[type=checkbox]:checked").not('#chkRow').each(function() {
        ids.push(this.id.split("-")[1]);
      });

      let urlArray = window.location.href.split("/");
      if (urlArray[urlArray.length - 1] == "tmv") {
        window.location += '/print/' + ids.join(",") + "/" + newJob;
      } else {
        window.location = window.location.href.replace(/\/[^\/]*$/, '/' + job + '/print/' + ids.join(",") + "/" + selectYear);
      }
    }

  });






});
