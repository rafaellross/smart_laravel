$(document).ready(function(){

        var _token;

	    // just for the demos, avoids form submit
	    jQuery.validator.setDefaults({
	    debug: true,
	    success: "valid"
	    });

        $.validator.addMethod('filesize', function(value, element, param) {
	        // param = size (en bytes)
	        // element = element to validate (<input>)
	        // value = value of the element (file name)
	            return this.optional(element) || (element.files[0].size <= param)
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
        $('select[name=apprentice]').change(function(){
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
                    var preview = $("[id*='"+ destination +"']");

                    preview.attr('src', e.target.result).show();

                    var hidden = $("input[name*='" + destination + "'][type=hidden]");
                    hidden.val(e.target.result);
                    reader.readAsDataURL(input.files[0]);
                }
                reader.readAsDataURL(input.files[0]);
       		}
        }

        $(document).on("change", "input[type=file]:not(input[name=tax_declaration_file])", function(){
          console.log(this);
            resizeImageToSpecificWidth(this);
        });

        $(document).on("click", ".btn-remove", function(){
            if (confirm("Are you sure you want to remove this license?")) {
                $(this).parent().parent().fadeOut("slow");
            }
        });

function resizeImageToSpecificWidth(input, width = 600) {
    var destination = $(input).prop('name');
    var preview = $("[id*='"+ destination +"']");
    var hidden = $("input[name*='" + destination + "'][type=hidden]");

  if (input.files && input.files[0]) {
    console.log(input.files);
    var reader = new FileReader();

    reader.onload = function(event) {
      var parentEl = $(this).parent();
      if(input.files[0].type == "application/pdf"){
        console.debug("Parsing PDF document...");
        //PDFJS.workerSrc = '<path_to_pdf.worker.js>';
            //var PDFJS = {};
            //PDFJS.workerSrc = '//mozilla.github.io/pdf.js/build/pdf.worker.js';
            console.log(PDFJS);
            PDFJS.getDocument(event.target.result).then(function getPdf(pdf) {
          //
          // Fetch the first page
          //
          pdf.getPage(1).then(function getPage(page) {
            var scale = 1.5;
            var viewport = page.getViewport(scale);

            //
            // Prepare canvas using PDF page dimensions
            //
            $(parentEl).append('<canvas id="pdf-image" class="preview"/>');

            var canvas = document.createElement('canvas');
            var context = canvas.getContext('2d');
            canvas.height = viewport.height;
            canvas.width = viewport.width;
            hidden.val(canvas.toDataURL());

            //
            // Render PDF page into canvas context
            //
            var renderContext = {
              canvasContext: context,
              viewport: viewport
            };
            page.render(renderContext);
          });
        });
      } else {
          var img = new Image();
          img.onload = function() {
              var oc = document.createElement('canvas'), octx = oc.getContext('2d');
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
      }

    reader.readAsDataURL(input.files[0]);
  }
}
    var newLicense = function(description, code){
    return `
          <div class="card-body">

          <!-- Start Card -->
          <h5 class="card-title">` + description + ` :</h5>
          <form action="" class="licensesAdd" method="post" enctype="multipart/form-data">
            <div class="col-xs-12 col-sm-12 col-md-12">
              <div class="form-row">
                <div class="col-md-2 col-12 mb-3">
                  <label>
                <strong>Issue Date:</strong>
                </label>
                <input type="text" class="form-control form-control-lg date-picker" name=license[` + code + `][date]" placeholder="dd/mm/yyyy" value=""  maxlength="10" required>
              </div>
                <div class="col-md-4 col-12 mb-3 ml-auto">
                  <label>
                <strong>State / Issuer *:</strong>
                </label>
                <input type="text" class="form-control form-control-lg" name=license[` + code + `][issuer]" placeholder="Issued by" value="" required>
              </div>
                <div class="col-md-4 col-12 ml-auto">
                  <label>
                <strong>Card / Licence No *:</strong>
                </label>
                <input type="text" class="form-control form-control-lg" name=license[` + code + `][number]" placeholder="Issued by" value="" required>
            </div>
              </div>
              <div class="form-row">
                <div class="col-md-4 col-12 mb-3">
                  <label>
                <strong>Photo - Front *:</strong>
                </label>
                  <div class="input-group mb-3">
                    <div class="custom-file">
                    <input type="file" class="custom-file-input" name="license[` + code + `][image][front]" accept="image/*, application/pdf" required>
                    <label class="custom-file-label">Choose file</label>
                    <input type="hidden" name="license[` + code + `][image][front][img]"/>
                </div>
              </div>
              </div>
              <div class="col-md-2 col-12 mb-3">
                    <img id="license[` + code + `][image][front]" class="img-thumbnail" style="max-width: 35%;display: none;">
              </div>
              <div class="col-md-4 col-12 mb-3">
                <label>
                  <strong>Photo - Back:</strong>
                </label>
                <div class="input-group mb-3">
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" name="license[` + code + `][image][back]" accept="image/*, application/pdf" required>
                    <label class="custom-file-label">Choose file</label>
                    <input type="hidden" name="license[` + code + `][image][back][img]"/>
                  </div>
                </div>
              </div>
              <div class="col-md-2 col-12 mb-3">
                <img id="license[` + code + `][image][back]" class="img-thumbnail" style="max-width: 35%;display: none;">
              </div>
              </div>
              </div>
              <button type="button" class="btn btn-danger btn-remove">Remove</button>
              <hr>
              </form>
            </div>

            <!-- End Card -->

        `
    } ;
    //Add new license
    $('#addLicense').click(function(){
      var select = $('select[name=licenseId] :selected');
      $('#licenses-list').append(newLicense(select.text(), select.val()));
    });

	$('form').submit(function(event) {
		/* Act on the event */
		$('input[type=file]').remove();
	});

$('input[name=tax_declaration_file]').change(function(event) {
  /* Act on the event */

$('#selected_tax_declaration').show().text(this.files[0].name);
  if (this.files && this.files[0]) {

      var reader = new FileReader();
      reader.onload = function (e) {

          var hidden = $("input[name=tax_declaration]");
          hidden.val(e.target.result);
      }
      reader.readAsDataURL(this.files[0]);
}

});




$('#div_signature').jSignature({
  'decor-color': 'transparent',
});

$('form').submit(function(){
    $('input[name=signature]').val($('#div_signature').jSignature("getData"));
});

$('.btn-clear-sign').click(function(event) {
  $('#div_signature').jSignature("reset");
});


$('#submit_application').prop('disabled', 'true');
if($('#chk_policy').is(':checked')) {
  $('#submit_application').prop('disabled', 'false');
}


  $(document).on('click', '#chk_policy', function(event) {
    if(this.checked) {
        $('#submit_application').prop('disabled', false);
    } else {
        $('#submit_application').prop('disabled', true);
    }
  });

  $(document).on('click', '#chk_no_super', function(event) {
    if(this.checked) {
        $('input[name=superannuation]').prop('disabled', true).prop('required', false);
    } else {
        $('input[name=superannuation]').prop('disabled', false).prop('required', true);
    }
  });

  $(document).on('click', '#chk_no_redudancy', function(event) {
    if(this.checked) {
        $('input[name=redundancy]').prop('disabled', true).prop('required', false);

    } else {
        $('input[name=redundancy]').prop('disabled', false).prop('required', true);

    }
  });

  $(document).on('click', '#chk_no_long_service', function(event) {
    if(this.checked) {
        $('input[name=long_service_number]').prop('disabled', true).prop('required', false);

    } else {
        $('input[name=long_service_number]').prop('disabled', false).prop('required', true);

    }
  });


});
