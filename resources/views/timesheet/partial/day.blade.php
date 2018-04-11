<div class="form-group alert alert-success" role="alert" id="groupMonday">
    <div class="input-group-prepend">
        <div class="input-group-text" style="display: none;">
            <input type="checkbox" id="mon">
            <strong style="padding-left: 5px;"> Special Leave?</strong>
        </div>
    </div>
    <h4 style="text-align: center;">{{ $day->description }}</h4>
    <!-- Start Job 1  -->
         
     
    @for ($i = 1; $i < 5; $i++)        
        @include('timesheet.partial.job', ['job' => $i, 'day' => $day->short])
    @endfor
     
    <div id="extraJobsMon" style="display:none;">
        <!-- Start Job 2 -->

    </div>
    <!-- Total day -->
    <div class="form-row overtime " style="text-align: center;">
        <div class="col-md-6 mb-3">
            <label>Normal Hours</label>
            <input readonly="" type="text" class="form-control form-control-lg time horNormal" id="mon_nor" value="" maxlength="5" name="days[{{$day->short}}][total][normal]">
        </div>
        <div class="col-md-6 mb-3">
            <label>Hours 1.5</label>
            <input readonly="" type="text" class="form-control form-control-lg time hor15" id="mon_15" value="" maxlength="5" name="days[{{$day->short}}][total][1.5]">
        </div>
    </div>
    <div class="form-row overtime " style="text-align: center;">
        <div class="col-md-6 mb-3">
            <label>Hours 2.0</label>
            <input readonly="" type="text" class="form-control form-control-lg time hor20" value="" maxlength="5" name="days[{{$day->short}}][total][2.0]">
        </div>
        <div class="col-md-6 mb-3">
            <label>Total Hours</label>
            <input readonly="" type="text" class="form-control form-control-lg time hours-total" value="" maxlength="5" name="days[{{$day->short}}][total][total]">
        </div>
    </div>
    <!-- End Total day -->
</div>