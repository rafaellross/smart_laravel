<div class="alert alert-secondary" style="text-align: center;">
    <h4>Job {{$job_curr}}</h4>
    <div class="form-row">
      <div class="col-md-2 offset-md-10">
        <input type="checkbox" class="chk_night_work btnClear" name="days[{{$day}}][{{$job_curr}}][night_work]" id="group_{{$day}}_{{$job_curr}}_night" value="1">
        <label class="custom-control-label" for="customCheck1">Night Work?</label>
      </div>
    </div>
    <div class="form-row" style="text-align: center;">
        <div class="col-md-6 col-12 mb-3">
            <label>Start</label>

            @if ($job_curr === 1)
                <select class="hour-start start-{{$job_curr}} form-control form-control-lg custom-select start group_{{$day}}_{{$job_curr}}" id="{{$day}}_start_{{$job_curr}}" name="days[{{$day}}][{{$job_curr}}][start]">
            @else
                <select class="hour-start form-control form-control-lg custom-select start group_{{$day}}_{{$job_curr}}" id="{{$day}}_start_{{$job_curr}}" name="days[{{$day}}][{{$job_curr}}][start]">
            @endif
                    <option selected value="">-</option>
                    @for ($i = 0; $i <= (24*60)-15; $i += 15)
                        <option value="{{$i}}" {{isset(old()['days'][$day][$job_curr]['start']) && old()['days'][$day][$job_curr]['start'] == $i ? 'selected' : ''}}>{{ date('i:s', $i)}}</option>
                    @endfor
            </select>
        </div>
        <div class="col-md-6 col-12 mb-3">
            <label>End</label>
            <select class="hour-end end-{{$job_curr}} form-control form-control-lg custom-select end group_{{$day}}_{{$job_curr}}" id="{{$day}}_end_{{$job_curr}}" name="days[{{$day}}][{{$job_curr}}][end]">
                        <option selected value="">-</option>
                    @for ($i = 0; $i <= (24*60)-15; $i += 15)
                        <option value="{{$i}}" {{isset(old()['days'][$day][$job_curr]['end']) && old()['days'][$day][$job_curr]['end'] == $i ? 'selected' : ''}}>{{ date('i:s', $i)}}</option>
                    @endfor
            </select>
        </div>
    </div>
    <!-- Job and Hours-->
    <div class="form-row" style="text-align: center;">
        <div class="col-md-6 mb-3">
            <label>Job</label>
            @if ($job_curr === 1)
                <select class="form-control form-control-lg custom-select job job-1 group_{{$day}}_{{$job_curr}}" id="{{$day}}_job_{{$job_curr}}" name="days[{{$day}}][{{$job_curr}}][job]">
            @else
                <select class="form-control form-control-lg custom-select job group_{{$day}}_{{$job_curr}}" id="{{$day}}_job_{{$job_curr}}" name="days[{{$day}}][{{$job_curr}}][job]">
            @endif
                <option value="">Select Job</option>
                @foreach ($jobDB as $job)
                    @if ($day != "sat")
                        <option value="{{$job->code}}" {{isset(old()['days'][$day][$job_curr]['job']) && old()['days'][$day][$job_curr]['job'] == $job->code ? 'selected' : ''}}>{{$job->description}}</option>
                    @else
                        @if (!in_array($job->code, ["sick", "anl", "pld", "tafe", "holiday", "rdo"]))
                            <option value="{{$job->code}}" {{isset(old()['days'][$day][$job_curr]['job']) && old()['days'][$day][$job_curr]['job'] == $job->code ? 'selected' : ''}}>{{$job->description}}</option>
                        @endif
                    @endif
                @endforeach
            </select>
        </div>

        <div class="col-md-6 mb-3">
            <label>Hours</label>
                <input readonly="" type="text" class="form-control form-control-lg time job1 hours group_{{$day}}_{{$job_curr}}" id="{{$day}}_hours_{{$job_curr}}" value="{{isset(old()['days'][$day][$job_curr]['hours']) && old()['days'][$day][$job_curr]['hours']}}" maxlength="5" name="days[{{$day}}][{{$job_curr}}][hours]">
        </div>
        <div class="col-md-12 mb-3" style="text-align: center;">
            <input readonly="" type="text" id="{{$day}}_job_{{$job_curr}}_description" class="form-control form-control-lg job_description_{{$job_curr}} group_{{$day}}_{{$job_curr}}" name="days[{{$day}}][{{$job_curr}}][description]" value=""/>
        </div>

        @if ($first)
            <button type="button" class="btn btn-secondary btn-sm" id="btnShowExtra" onclick="showExtra(this, extraJobs{{$day}})">Show More Jobs</button>
        @endif

        <input id="group_{{$day}}_{{$job_curr}}" type="button" class="btn btn-danger btn-sm ml-2 btnClear" value="Clear"/>
    </div>
</div>
