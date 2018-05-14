$(document).ready(function() {

		let activities = 1;
	$('#addActivity').click(function() {
		let activity = `
		<div id="row-act-` + activities + `">
            <div class="form-group row">
                <label for="activities[` + activities + `]" class="col-md-4 col-form-label text-md-right">Activity:</label>
                <div class="col-md-6">
                    <input id="activities[` + activities + `][description]" type="text" class="form-control" name="activities[`+activities+`][description]" value="" required>                                
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
                    <input id="activities[` + activities + `][requirements]" type="text" class="form-control" name="activities[`+activities+`][requirements]" value="" required>                                
                </div>
            </div>                            
            <div class="form-group row">
                <label for="activities[` + activities + `][order]" class="col-md-4 col-form-label text-md-right">Order:</label>
                <div class="col-md-6">
                    <input id="activities[` + activities + `][order]" type="number" class="form-control order" name="activities[`+activities+`][order]" value="`+activities+`" required>                                
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


});