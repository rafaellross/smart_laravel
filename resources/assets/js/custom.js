
$(document).ready(function(){

	
    function addMinutes(time, minsToAdd) {
        function D(J){
            return (J<10? '0':'') + J;
        };
        var piece = time.split(':');
        var mins = piece[0]*60 + +piece[1] + +minsToAdd;
        return D(mins%(24*60)/60 | 0) + ':' + D(mins%60);
    }

    function hourToMinutes(hour){
        var piece = hour.split(':');
        if (piece.length > 1) {
          return piece[0]*60 + +piece[1];
        } else {
          return 0;
        }

    }

    function minutesToHour(minutes){
         function D(J){
             return (J<10? '0':'') + J;
         };
         return D(minutes/60 | 0) + ':' + D(minutes%60);
    }



	//Setup datepicker
	$('.date-picker').datepicker();


	//Show extra jobs for selected day
	showExtra = function(btn, extra_inputs){
	    $(extra_inputs).css('display', 'block');
	    $(btn).fadeOut();
	}

	//Update option list for end time
    $('.hour-start').change(function(){
      let day = $(this).attr('id').split('_');
      let row = day[2];
      let destination = $('#' + day[0] + "_end_" + row);

      //Enable and empty select list for end of the row
      destination.prop('disabled', false).empty();
      let option = '<option value="">-</option>';
      destination.append(option);

      //Get the seleted value to be used as minimum for end
      var startHour = $(this).val();
      for (var hour = Number(startHour)+15; hour <= (24*60)-15; hour += 15) {
          let option = '<option value="' + hour + '">' + minutesToHour(hour) + '</option>';
          $(destination).append(option);
      }
      
    });



});
