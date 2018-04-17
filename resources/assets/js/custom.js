//Setup datepicker
$('.date-picker').datepicker();

    showExtra = function(btn, extra_inputs){
        $(extra_inputs).css('display', 'block');
        $(btn).fadeOut();
    }
