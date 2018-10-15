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


  $('#flash-message').fadeOut(15000);

  //Setup datepicker
  $('.date-picker').datepicker({format: 'dd/mm/yyyy'});



  $('#modalDescription').on('hidden.bs.modal', function(e) {
    let description = $('#job_description').val();
    let destination = $('#description_destination').val();
    if (description == "") {
      $('#' + destination).val('');
    }
  });

  $('.btnClear').click(function() {

    $('.' + this.id.replace("_night", "")).val('');
    $('.' + this.id.replace("_night", "")).trigger("change");
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

  $('form').not('#timesheet_form').submit(function(event) {
    /* Act on the event */
    $('#modalLoading').modal({backdrop: 'static', keyboard: false});
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
      console.log(this);
      if ($(this).val() !== "") {
          window.location = window.location.href += "&status=" + $(this).val();
      }

  });

  $('#selectWeekEnd').change(function() {
      console.log(this);
      if ($(this).val() !== "") {
          window.location = window.location.href += "&week_end=" + $(this).val();
      }

  });

  $('#selectJob').change(function() {
      console.log(this);
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
    console.log(employeesSelected);
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





  $(".chk_night_work").click(function() {

    let group = $(this).attr('id').split('_');

    let row = Number(group[2]);
    let day = group[1];
    //mon_end_1
    $('#' + day + "_end_" + row).trigger("change", [true]);

    $('#' + this.id.replace("_night", "")).trigger("change");
    //Add night class to hours
    if($(this).is(':checked')){

      $('#' + day + "_hours_" + row).addClass('night');

    } else {

      $('#' + day + "_hours_" + row).removeClass('night');

    }


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


});
