<div class="alert alert-secondary" style="text-align: center;">
    <h4>Job {{$job->number}}</h4>
    <div class="form-row" style="text-align: center;">
        <div class="col-md-6 col-12 mb-3">
            <label>Start</label>
            
            @if ($job->number === 1)
                <select class="hour-start start-{{$job->number}} form-control form-control-lg custom-select start" id="{{$weekDay->short}}_start_{{$job->number}}" name="daysjob [{{ $weekDay->short}}][{{$job->number}}][start]">
            @else
                <select class="hour-start form-control form-control-lg custom-select start" id="{{$day}}_start_{{$job->number}}" name="daysjob [{{ $weekDay->short}}][{{$job->number}}][start]">
            @endif            
                @for ($i = 0; $i <= (24*60)-15; $i += 15)        
                    <option value="{{$i}}" {{ $job->start == $i ? 'selected' : ''}}>{{ date('i:s', $i)}}</option>
                @endfor                                                                
            </select>
        </div>
        <div class="col-md-6 col-12 mb-3">
            <label>End</label>
            <select class="hour-end end-{{$job->number}} form-control form-control-lg custom-select end" id="{{$weekDay->short}}_end_{{$job->number}}" name="days[{{$weekDay->short}}][{{$job->number}}][end]">
                @for ($i = 0; $i <= (24*60)-15; $i += 15)        
                    <option value="{{$i}}" {{ $job->end == $i ? 'selected' : ''}}>{{ date('i:s', $i)}}</option>
                @endfor                                                                
            </select>
        </div>
    </div>
    <!-- Job and Hours-->
    <div class="form-row" style="text-align: center;">
        <div class="col-md-6 mb-3">
            <label>Job</label>
            @if ($job->number === 1)   
                <select class="form-control form-control-lg custom-select job job-1" id="{{$weekDay->short}}_job_{{$job->number}}" name="days[{{$weekDay->short}}][{{$job->number}}][job]">
            @else
                <select class="form-control form-control-lg custom-select job" id="{{$weekDay->short}}_job_{{$job->number}}" name="days[{{$weekDay->short}}][{{$job->number}}][job]">
            @endif         
                    <option value="">Select Job</option>
                    @foreach ($jobDB as $jobList)
                        <option value="{{$jobList->code}}" {{$job->job_id == $jobList->id ? 'selected' : ''}}>{{$jobList->description}}</option>
                    @endforeach                                                                
            </select>
        </div>
        <div class="col-md-6 mb-3">
            <label>Hours</label>
            <input readonly="" type="text" class="form-control form-control-lg time job1 hours" id="{{$weekDay->short}}_hours_{{$job->number}}" value="{{date('i:s', $job->hours())}}" maxlength="5" name="days[{{$weekDay->short}}][{{$job->number}}][hours]">    
        </div>        
        @if ($first)
            <button type="button" class="btn btn-secondary btn-sm" id="btnShowExtra" onclick="showExtra(this, extraJobs{{$weekDay->short}})">Show More Jobs</button>
        @endif        
        
        <input type="button" class="btn btn-danger btn-sm ml-2 btnClear" value="Clear">
    </div>
</div>