<div class="alert alert-secondary" style="text-align: center;">
    <h4>Job {{$job_curr}}</h4>
    <div class="form-row" style="text-align: center;">
        <div class="col-md-6 col-12 mb-3">
            <label>Start</label>
            <select class="hour-start start-1 form-control form-control-lg custom-select start" id="{{$day}}_start_{{$job_curr}}" name="days[{{$day}}][{{$job_curr}}][start]">
                @for ($i = 0; $i <= (24*60)-15; $i += 15)        
                    <option value="{{$i}}">{{ date('i:s', $i)}}</option>
                @endfor                                
            </select>
        </div>
        <div class="col-md-6 col-12 mb-3">
            <label>End</label>
            <select class="hour-end end-1 form-control form-control-lg custom-select end" id="{{$day}}_end_{{$job_curr}}" name="days[{{$day}}][{{$job_curr}}][end]">
                @for ($i = 0; $i <= (24*60)-15; $i += 15)        
                    <option value="{{$i}}">{{ date('i:s', $i)}}</option>
                @endfor                                                
            </select>
        </div>
    </div>
    <!-- Job and Hours-->
    <div class="form-row" style="text-align: center;">
        <div class="col-md-6 mb-3">
            <label>Job</label>
            <select class="form-control form-control-lg custom-select job job-1" id="{{$day}}_job_{{$job_curr}}" name="days[{{$day}}][{{$job_curr}}][job]">
                <option value="">Select Job</option>
                @foreach (App\Job::all() as $job)
                    <option value="{{$job->code}}">{{$job->description}}</option>
                @endforeach                                                                
            </select>
        </div>
        <div class="col-md-6 mb-3">
            <label>Hours</label>
            <input readonly="" type="text" class="form-control form-control-lg time job1 hours" id="{{$day}}_hours_{{$job_curr}}" value="" maxlength="5" name="days[{{$day}}][{{$job_curr}}][hours]">
        </div>        
        @if ($first)
            <button type="button" class="btn btn-secondary btn-sm" id="btnShowExtra" onclick="showExtra(this, extraJobsMon)">Show More Jobs</button>
        @endif        
        
        <input type="button" class="btn btn-danger btn-sm ml-2 btnClear" value="Clear">
    </div>
</div>