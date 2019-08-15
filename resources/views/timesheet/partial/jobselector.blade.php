<div class="modal" tabindex="-1" role="dialog" id="modalJobSelector">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Please, select Job</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group row">
          <div class="col-md-12">
            <label for="new_qa_type">Job Name:</label>
          </div>
          <div class="col-md-12">            
            <select class="hour-start form-control form-control-lg custom-select start " id="job_tafesickholiday" name="job_tafesickholiday">
                <option selected value="">Select Job</option>
                    @foreach ($jobDB as $job)
                            @if (!in_array($job->code, ["sick", "anl", "pld", "tafe", "holiday", "rdo"]))
                                <option value="{{$job->code}}">{{$job->description}}</option>
                            @endif                                
                    @endforeach
            </select>

            <input type="hidden" id="description_destination" value="">
          </div>

        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="btnSaveTafeSickJob" disabled>Save</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
