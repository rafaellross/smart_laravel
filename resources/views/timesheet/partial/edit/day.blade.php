<div class="form-group alert alert-success" role="alert" id="groupMonday">
    <?php
        $weekDay = App\WeekDay::select('number','description', 'short')->where("number", "=", $day->week_day)->get()->first();
        
        
    ?>
    
    <h4 style="text-align: center;">{{ $weekDay->description }}</h4>    
    <!-- Start Job 1  -->        
        @foreach ($day->dayJobs as $job)
            @if ($loop->first)
                @include('timesheet.partial.edit.job', ['day' => $day, 'job' => $job, 'first' => true, 'weekDay' => $weekDay])            
                @break
            @endif                
        @endforeach

        <div id="extraJobs{{$weekDay->short}}" style="display:none;">
            @foreach ($day->dayJobs as $job)
                @if (!$loop->first)
                    @include('timesheet.partial.edit.job', ['day' => $day, 'job' => $job, 'first' => false, 'weekDay' => $weekDay])                                
                @endif                
            @endforeach
        </div>     
    <!-- Total day -->
    <div class="form-row overtime " style="text-align: center;">
        <div class="col-md-6 mb-3">
            <label>Normal Hours</label>
            <input readonly="" type="text" class="form-control form-control-lg time horNormal" id="{{$weekDay->short}}_nor" value="{{$day->normal}}" maxlength="5" name="days[{{$weekDay->short}}][total][normal]">
        </div>
        <div class="col-md-6 mb-3">
            <label>Hours 1.5</label>
            <input readonly="" type="text" class="form-control form-control-lg time hor15" id="{{$weekDay->short}}_15" value="{{$day->total_15}}" maxlength="5" name="days[{{$weekDay->short}}][total][1.5]">
        </div>
    </div>
    <div class="form-row overtime " style="text-align: center;">
        <div class="col-md-6 mb-3">
            <label>Hours 2.0</label>
            <input readonly="" type="text" class="form-control form-control-lg time hor20" value="{{$day->total_20}}" maxlength="5" id="{{$weekDay->short}}_20" name="days[{{$weekDay->short}}][total][2.0]">
        </div>
        <div class="col-md-6 mb-3">
            <label>Total Hours</label>
            <input readonly="" type="text" class="form-control form-control-lg time hours-total" value="{{$day->total}}" maxlength="5" id="{{$weekDay->short}}_total" name="days[{{$weekDay->short}}][total][total]">
        </div>
    </div>
    <!-- End Total day -->
</div>
