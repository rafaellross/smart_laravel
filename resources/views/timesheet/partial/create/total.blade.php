<div class="form-group alert alert-success" role="alert">
    <h4 style="text-align: center;">Total Week</h4>
    @if(isset($timesheet))
    <div class="form-row overtime" style="text-align: center;">        
        <div class="col-md-6 mb-3">
            <label>Normal Hours</label>
            <input readonly="" type="text" class="form-control form-control-lg time " name="totals[normal]" id="totalNormal" value="{{$timesheet->normal == null ? '00:00' : $timesheet->normal}}" maxlength="5">
        </div>
        <div class="col-md-6 mb-3">
            <label>Hours 1.5</label>
            <input readonly="" type="text" class="form-control form-control-lg time " name="totals[1.5]" id="total15" value="{{$timesheet->total_15 == null ? '00:00' : $timesheet->total_15}}" maxlength="5">
        </div>
        <div class="col-md-6 mb-3">
            <label>Hours 2.0</label>
            <input readonly="" type="text" class="form-control form-control-lg time" name="totals[2.0]" id="total20" value="{{$timesheet->total_20 == null ? '00:00' : $timesheet->total_20}}" maxlength="5">
        </div>
        <div class="col-md-6 mb-3">
            <label>Total Week</label>
            <input readonly="" type="text" class="form-control form-control-lg time totalWeek" name="totals[total]" id="totalWeek" value="{{$timesheet->total == null ? '00:00' : $timesheet->total}}" maxlength="5">
        </div>
    </div>
    @else
    <div class="form-row overtime" style="text-align: center;">        
        <div class="col-md-6 mb-3">
            <label>Normal Hours</label>
            <input readonly="" type="text" class="form-control form-control-lg time " name="totals[normal]" id="totalNormal" value="00:00" maxlength="5">
        </div>
        <div class="col-md-6 mb-3">
            <label>Hours 1.5</label>
            <input readonly="" type="text" class="form-control form-control-lg time " name="totals[1.5]" id="total15" value="00:00" maxlength="5">
        </div>
        <div class="col-md-6 mb-3">
            <label>Hours 2.0</label>
            <input readonly="" type="text" class="form-control form-control-lg time" name="totals[2.0]" id="total20" value="00:00" maxlength="5">
        </div>
        <div class="col-md-6 mb-3">
            <label>Total Week</label>
            <input readonly="" type="text" class="form-control form-control-lg time totalWeek" name="totals[total]" id="totalWeek" value="00:00" maxlength="5">
        </div>
    </div>

    @endif
</div>