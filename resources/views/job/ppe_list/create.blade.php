@extends('layouts.app')

@section('content')
<script src="{{ asset('js/qa.js') }}"></script>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create New - PPE Register') }}</div>

                <div class="card-body">
                    <form method="POST" id="form-ppes" action="{{ action('PPEListController@store', $current_job)}}">
                        @csrf
                        <div class="form-group row">
                            <label for="selectEmployee" class="col-md-4 col-form-label text-md-right">{{ __('Employee') }}</label>
                            <div class="col-md-6 col-lg-6 col-sm-12">
                              <select class="custom-select col-form-label" id="selectEmployee">
                                <option selected="">Select Employee...</option>
                                @foreach ($employees as $employee)
                                  <option value="{{ $employee->id }}">{{ strtoupper($employee->name) }}</option>
                                @endforeach
                              </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="selectEmployee" class="col-md-4 col-form-label text-md-right">{{ __('Job') }}</label>
                            <div class="col-md-6 col-lg-6 col-sm-12">
                              <select class="custom-select col-form-label" id="selectEmployee">
                                <option selected="">Select Job...</option>
                                @foreach ($jobs as $job)
                                  <option value="{{ $job->id }}" {{ $current_job == $job->id ? 'selected' : '' }} >{{ strtoupper($job->description) }}</option>
                                @endforeach
                              </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="selectEmployee" class="col-md-4 col-form-label text-md-right">{{ __('PPE') }}</label>
                            <div class="col-md-6 col-lg-6 col-sm-12" id="ppe">
                              <input list="ppes" name="ppes[0]" class="custom-select col-form-label" placeholder="Select or Type PPE description">
                              <datalist id="ppes">
                                <option value="Safety Helmet / accessories">
                                <option value="Uniform Shirts">
                                <option value="Uniform Shorts">
                                <option value="Safety Glasses">
                                <option value="Work Gloves">
                                <option value="Ear Muffs">
                                <option value="Dust Masks / Respirator">
                              </datalist>
                            </div>
                        </div>
                        <div class="form-group row">
                              <label for="install_dt" class="col-md-4 col-form-label text-md-right">{{ __('') }}</label>
                              <div class="col-md-6">
                                <input id="addPPE" type="button" class="btn btn-success btn-block" value="Add PPE">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="install_dt" class="col-md-4 col-form-label text-md-right">{{ __('Date:') }}</label>
                            <div class="col-md-6">
                                <input id="delivery_dt" type="text" class="form-control{{ $errors->has('delivery_dt') ? ' is-invalid' : '' }} date-picker" name="delivery_dt" value="{{Carbon::now('Australia/Sydney')->format('d/m/Y')}}">
                                @if ($errors->has('delivery_dt'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('delivery_dt') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="install_dt" class="col-md-4 col-form-label text-md-right">{{ __('Signature:') }}</label>
                            <div class="col-md-6">
                              <button id="signature_1" type="button" class="btn btn-secondary btn-signature btn-block">
                                  {{ __('Sign') }}
                              </button>
                              <input type="hidden" name="img_signature_1" id="img_signature_1" value="">
                            </div>
                            <img class="ml-1 col-md-12" id="preview_signature_1" src="" style="width: 100%;" />
                        </div>


                        <hr/>
                        <div class="row mb-0">

                              <div class="col-md-6">
                                <a src="{{url()->previous()}}" class="btn btn-danger btn-block">
                                    {{ __('Cancel') }}
                                </a>
                              </div>
                              <div class="col-md-6">
                              <button type="submit" class="btn btn-primary btn-block">
                                    {{ __('Save') }}
                                </button>
                              </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal" tabindex="-1" role="dialog" id="modal_signature_1">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Employee Signature</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <div class="form-group alert" role="alert">
                <h4 style="text-align: center;">Signature</h4>
                    <div class="form-row" style="text-align: center;">
                        <div class="col-md-12 mb-3">
                            <div id="div_signature_1" class="div-signature"></div>

                            <input type="button" value="Clear" id="div_signature_1" class="btn btn-danger btn-clear-sign" >

                            <script>
                            </script>
                        </div>
                    </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-save-sign" id="save_signature_1" data-dismiss="modal" >Save & Close</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
let ppes = $(".ppe-row").length + 1;
$("#addPPE").click(function() {

  var ppe = `
      <div class="mt-1 alert alert-secondary ppe-row" id="ppes[` + ppes + `]_row">
        <div class="col-md-12">
          <input list="ppes" name="ppes[` + ppes + `]" class="custom-select col-form-label" placeholder="Select or Type PPE description">
        </div>
        <div class="col-md-12 mt-1">
          <a id="ppes[` + ppes + `]-delete" src="{{url()->previous()}}" class="btn btn-danger btn-block delPPE">
              {{ __('Delete') }}
          </a>
        </div>
      </div>

      `;
      ppes++;
      $("#ppe").append(ppe);

});

$(document).on("click", ".delPPE", function(){
  var destination = $(this).prop('id').split("-");
    ppes--;
    $("[id*='"+ destination[0] +"_row']").remove();
});

$('#form-ppes').on('submit', function(e) {
  e.preventDefault();
  alert("Submit");
  $('#modalLoading').modal('hide');
});


</script>
@endsection
