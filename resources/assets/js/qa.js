$(document).ready(function() {

	let activities = $(".row-act").length + 1;

	$('#addActivity').click(function() {
		let activity = `
		<div id="row-act-` + activities + `" class="row-act">
            <div class="form-group row">
                <label for="activities[` + activities + `]" class="col-md-4 col-form-label text-md-right">Activity:</label>
                <div class="col-md-6">
                    <input id="activities[` + activities + `][description]" type="text" class="form-control" name="activities[`+activities+`][description]" value="" />                                
                </div>
            </div>        
            <div class="form-group row">
                <label for="activities[` + activities + `][at]" class="col-md-4 col-form-label text-md-right">A/T:</label>
                <div class="col-md-6">
                    <select name="activities[` + activities + `][at]" class="form-control">                                    
                        <option value="V" selected>Verify</option>
                        <option value="R">Random</option>
                        <option value="H">Hold</option>
                        <option value="S">Submit</option>
                        <option value="I">Inspect</option>
                        <option value="W">Witness Points</option>
                        <option value="C">Comments</option>                                    
                        <option value="N">Notification Point</option>
                    </select>                                
                </div>
            </div>

            <div class="form-group row">
                <label for="activities[` + activities + `][requirements]" class="col-md-4 col-form-label text-md-right">Criteria Requirements:</label>
                <div class="col-md-6">
                    <input id="activities[` + activities + `][requirements]" type="text" class="form-control" name="activities[`+activities+`][requirements]" value=""/>                                
                </div>
            </div>                            
            <div class="form-group row">
                <label for="activities[` + activities + `][order]" class="col-md-4 col-form-label text-md-right">Order:</label>
                <div class="col-md-6">
                    <input id="activities[` + activities + `][order]" type="number" class="form-control order" name="activities[`+activities+`][order]" value="`+activities+`" />                                
                </div>
            </div>                            

            <div class="form-group row">
                <div class="col-md-6">
                    <input id="act-` + activities + `" type="button" class="btn btn-danger btn-sm ml-2 btn-remove-act" value="Remove Activity"/>
                </div>                                
            </div>                            
        </div>
        <hr/>
		`;
		activities++;
		$("#activities").append(activity);
	});

	$(document).on('click', '.btn-remove-act', function() {
		$("#row-" + this.id).remove();
        if (activities > 0) {
            activities--;    
        }    
	});

    $(document).on('click', '.order', function() {
        $(this).attr('name', 'activities[' + $(this).val() + '][order]');
    });

    $('#btn-create-qa-users').click(function(){            
        $('#modalCreateNew').modal('show');        
    });          

    $('#btnSelectType').click(function(){     
        let type = $("select[name=new_qa_type]").val();       
        if (type === "") {
            alert("Please, select one type");
        } else {
            let urlArray = window.location.href.split("/");
            if (urlArray[urlArray.length - 1] == "qa_users") {
              window.location += '/create/' + type;
            } else {
              window.location = window.location.href.replace(/\/[^\/]*$/, '/create/' + type);  
            }                                    
        }            
    });          

    let signatures = {    
        "signature_1" : {
            "div": "#div_signature_1",
            "modal": "#modal_signature_1",
            "hidden": "#img_signature_1",
            "opened": false
        },
        "signature_2" : {
            "div": "#div_signature_2",
            "modal": "#modal_signature_2",
            "hidden": "#img_signature_2",
            "opened": false
        },
        "signature_3" : {
            "div": "#div_signature_3",
            "modal": "#modal_signature_3",
            "hidden": "#img_signature_3",
            "opened": false
        },
        "signature_4" : {
            "div": "#div_signature_4",
            "modal": "#modal_signature_4",
            "hidden": "#img_signature_4",
            "opened": false
        }
    };

    

    $('.btn-signature').click(function(){                    

        let modal   = $(signatures[this.id].modal);
        let div     = $(signatures[this.id].div);
        let hidden  = $(signatures[this.id].hidden);
        let opened  = signatures[this.id].opened;
        modal.modal('show');

        if (!signatures[this.id].opened) {            
            signatures[this.id].opened = true;
            div.jSignature(); // inits the jSignature widget.            
            if (hidden.val() !== "") {
                div.jSignature("setData", hidden.val());    
            }
            
            
        }      
    }); 

    
    $('.btn-save-sign').click(function() {
        var signature = this.id.replace("save", "");
        var div = $("#div" + signature);
        var img = div.jSignature("getData");        
        $('#preview' + signature).attr('src', img);                 
        $('#img' + signature).val(img);                 
        
    }); 

    // after some doodling...
    $('.btn-clear-sign').click(function(){
        var $sigdiv = $("#" + this.id.replace("clear", "div", 1));
        $sigdiv.jSignature("reset") // clears the canvas and rerenders the decor on it.
    });                                

let qa_photos = $(".photo-row").length + 1;
$("#addPhoto").click(function() {
    
    var photo = `
        <div class="alert alert-secondary photo-row" id="photos[` + qa_photos + `]_row">                          
            <h5 style="text-align: center;">Photo ` + qa_photos + `</h5>          
            <div class="input-group col-12 mb-3">
              <div class="custom-file">
                <input type="file" class="custom-file-input qa_photos" id="photos[` + qa_photos + `]" name="photos[` + qa_photos + `]"/>                        
                <label class="custom-file-label" for="photos[` + qa_photos + `]">Choose files</label>
              </div>
            </div>

            <div class="input-group col-12 mb-3">
                <img id="photos[` + qa_photos + `]_img" src="" class="img-fluid" style="">
            </div>   
            <input id="photos[` + qa_photos + `]-delete" type="button" class="btn btn-danger btn-sm ml-2 delPhoto" value="Delete">
            <input type="hidden" class="custom-file-input" id="photos[` + qa_photos + `]_hidden" name="photos[` + qa_photos + `]_hidden" value="">                        
        </div>   
        `;
        qa_photos++;
        $("#additional_photos").append(photo);
    
  });

  $(document).on("click", ".delPhoto", function(){  
    var destination = $(this).prop('id').split("-");
      qa_photos--;
      $("[id*='"+ destination[0] +"_row']").remove();        
  });

    $('#btnPrintQA').click(function(){
        let selecteds = $("input[type=checkbox]:checked").not('#chkRow').length;
        if (selecteds > 0) {                            
            let ids = Array();
            $("input[type=checkbox]:checked").not('#chkRow').each(function(){
                ids.push(this.id.split("-")[1]);                    
            });
          let urlArray = window.location.href.split("/");
          if (urlArray[urlArray.length - 1] == "qa_users") {
            window.open(window.location.href + "/action/" + ids.join(",") + "/print", '_blank');          
          } else {
            window.open(window.location.href.replace(/\/[^\/]*$/, '/action/' + ids.join(",") + "/print", '_blank'));  
          }            
        }
    });


});