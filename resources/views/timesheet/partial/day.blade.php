<div class="form-group alert alert-success" role="alert" id="groupMonday">
    <h4 style="text-align: center;">{{ $day->description }}</h4>
    <!-- Start Job 1  -->
         
     

    @include('timesheet.partial.job', ['job_curr' => 1, 'day' => $day->short, 'first' => true])

    <div id="extraJobsMon" style="display:none;">
        @for ($i = 2; $i < 5; $i++)                   
            @include('timesheet.partial.job', ['job_curr' => $i, 'day' => $day->short, 'first' => false])            
        @endfor
    </div>     
    <!-- Total day -->
    <div class="form-row overtime " style="text-align: center;">
        <div class="col-md-6 mb-3">
            <label>Normal Hours</label>
            <input readonly="" type="text" class="form-control form-control-lg time horNormal" id="{{$day->short}}_nor" value="" maxlength="5" name="days[{{$day->short}}][total][normal]">
        </div>
        <div class="col-md-6 mb-3">
            <label>Hours 1.5</label>
            <input readonly="" type="text" class="form-control form-control-lg time hor15" id="{{$day->short}}_15" value="" maxlength="5" name="days[{{$day->short}}][total][1.5]">
        </div>
    </div>
    <div class="form-row overtime " style="text-align: center;">
        <div class="col-md-6 mb-3">
            <label>Hours 2.0</label>
            <input readonly="" type="text" class="form-control form-control-lg time hor20" value="" maxlength="5" id="{{$day->short}}_20" name="days[{{$day->short}}][total][2.0]">
        </div>
        <div class="col-md-6 mb-3">
            <label>Total Hours</label>
            <input readonly="" type="text" class="form-control form-control-lg time hours-total" value="" maxlength="5" id="{{$day->short}}_total" name="days[{{$day->short}}][total][total]">
        </div>
    </div>
    <!-- End Total day -->
</div>
<script type="text/javascript">
    showExtra = function(btn, extra_inputs){
        $(extra_inputs).css('display', 'block');
        $(btn).fadeOut();
    }

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
          let option = '<option value="' + hour + '">' + Utilities.minutesToHour(hour) + '</option>';
          $(destination).append(option);
      }
    });    
</script>