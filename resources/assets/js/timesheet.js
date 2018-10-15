$(document).ready(function() {



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
  $('.hour-end').change(function(reset = false) {


    let day = $(this).attr('id').split('_');
    let row = Number(day[2]);

    let isNight = false;

    if($('#group_' + day[0] + "_" + day[2] + "_night").is(':checked')) {
        return false;
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
    var lunch = (row === 1 && day[0] !== "sat" && day[0] !== "sun")
      ? 15
      : 0;

    duration.val((end - start - lunch) > 0 ? minutesToHour(end - start - lunch): "");


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

    if (totalHours > (8 * 60) && day[0] !== "sat" && day[0] !== "sun" && !isNight) {
      //If total hours is bigger than 08:00 and day different than sat set 1.5
      hours_15 = Math.min((2 * 60), totalHours - (8 * 60));

    }
    //Check if is night work and start time is between 18 and 23
    else if (isNight && start >= (18*60) & start < (23*60)) {
      hours_15 = Math.min((2 * 60), totalHours);
    }

    //If total hours is bigger than 10:00 or day equal sat set 1.5
    if (!isNight && (totalHours > (10 * 60) || day[0] == "sat" || day[0] == "sun") ) {
      if (day[0] == "sat" || day[0] == "sun") {
        hours_20 = totalHours;
      } else if (job_number !== "pld") {
        hours_20 = totalHours - (8 * 60) - (2 * 60);
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
  $('.hour-end').change(function(reset = false) {

    let day = $(this).attr('id').split('_');
    let row = Number(day[2]);

    let isNight = true;

    if(!$('#group_' + day[0] + "_" + day[2] + "_night").is(':checked')) {
        return false;
    }

    var duration = $('#' + day[0] + '_hours_' + row);
    var start = Number($('#' + day[0] + "_start_" + row).val());
    var end = Number($(this).val());
    var lunch = (row === 1 && day[0] !== "sat" && day[0] !== "sun") ? 15 : 0;


    if (end > start && end !== start) {
      duration.val(
        (end - start - lunch) > 0
        ? minutesToHour(end - start - lunch)
        : "");
    } else {
      duration.val(
        (((24*60)-start) + ((24*60) - (24*60 - end))) - lunch > 0  && end !== start
        ? minutesToHour((((24*60)-start) + ((24*60) - (24*60 - end))) - lunch)
        : "");
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
    let prev_row = row - 1;

    let diff_day_night = null;

    let prev_row_end = $('#' + day[0] + "_end_" + prev_row);

    if (prev_row_end.length > 0) {

      diff_day_night = start - prev_row_end.val();

    }



    if (totalHours > (8 * 60) && day[0] !== "sat" && day[0] !== "sun" && !isNight) {
      //If total hours is bigger than 08:00 and day different than sat set 1.5
      hours_15 = Math.min((2 * 60), totalHours - (8 * 60));

    }
    //Check if is night work and start time is between 18 and 23
    else if (isNight && start >= (18*60) && start < (23*60) && (diff_day_night == null || diff_day_night > 10*60) ) {
      hours_15 = Math.min((2 * 60), totalHours);
    }    //If total hours is bigger than 10:00 or day equal sat set 1.5
    if (!isNight && (totalHours > (10 * 60) || day[0] == "sat" || day[0] == "sun") ) {
      if (day[0] == "sat" || day[0] == "sat") {
        hours_20 = totalHours;
      } else if (job_number !== "pld") {
        hours_20 = totalHours - (8 * 60) - (2 * 60);
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
    $('input, select').not('#preStart, #preEnd, #output, #empDate, #preJob, #PreNormal, #Pre15, #Pre20, #preHours, #btnClearSign, #status, #output, #week_end, #empname, select[name=pld], select[name=rdo], select[name=anl], input[name=employee_id], .btnClear, input[type=hidden], .btn, #preJob_description, #job_description').val('');

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


  //Check if the selected job is 001 or 002 then show modal asking for description
  $(".job, #preJob").change(function() {
    if ($(this).val() == "001" || $(this).val() == "002") {
      $('#modalDescription').modal({backdrop: 'static', keyboard: false});

      $('#description_destination').val(this.id);
    }
  });

  //Save description for job 001 or 002 
  $('#btnSaveDescription').click(function() {
    let destination = $('#description_destination').val();
    let description = $('#job_description').val();
    $("#" + destination + "_description").val(description);
    $('#modalDescription').modal('hide');
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

    //Night Work
  $(".chk_night_work").mousedown(function() {

    let group = $(this).attr('id').split('_');

    let row = Number(group[2]);
    let day = group[1];
    $('#' + day + "_end_" + row).trigger("change", [true]);
    $('#' + this.id.replace("_night", "")).trigger("click");

  });






});
