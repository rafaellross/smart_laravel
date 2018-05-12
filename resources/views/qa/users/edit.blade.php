@extends('layouts.app')

@section('content')
<script src="{{ asset('js/qa.js') }}"></script>    
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">{{ __('Create New Q.A ' . $qa_user->title) }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('qa_users.update', $qa_user->id) }}">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="qa_type" value="{{$qa_user->id}}" required/>
                        <div class="form-group row">
                            <label for="description" class="col-md-2 col-form-label text-md-right">{{ __('Title:') }}</label>
                            <div class="col-md-5">
                                <input id="title" readonly type="text" class="form-control-plaintext" name="title" value="{{ $qa_user->title }}" required>
                                @if ($errors->has('title'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="description" class="col-md-2 col-form-label text-md-right">{{ __('Description:') }}</label>
                            <div class="col-md-6">
                                <input id="description" type="text" class="form-control-plaintext" name="description" value="{{ $qa_user->description }}" required>
                                @if ($errors->has('description'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">                            
                            <div class="col-md-6">
                                <label for="description" class="col-form-label text-md-right">{{ __('Date of Update:') }}</label>
                                <input id="update_date" type="text" class="form-control date-picker" name="update_date" value="{{ Carbon::parse($qa_user->update_date)->format('d/m/Y') }}" required>
                                @if ($errors->has('update_date'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('update_date') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-md-6">
                                <label for="description" class="col-form-label text-md-right">{{ __('Revision No:') }}</label>
                                <input id="revision" type="number" class="form-control" name="revision" min="1" max="1000" value="{{ $qa_user->revision }}" required>
                                @if ($errors->has('revision'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('revision') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">                            
                            <div class="col-md-6">
                                <label for="project" class="col-form-label text-md-right">{{ __('Project:') }}</label>

                                <select class="form-control" name="project">
                                       <option value="">Select Project</option>
                                    @foreach(App\Job::all() as $job)
                                        @if(!in_array($job->code, ['rdo', 'pld', 'tafe', 'sick', 'anl', 'holiday']))
                                        <option value="{{$job->id}}" {{ $qa_user->project == $job->id ? 'selected' : '' }}>{{$job->description}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label for="customer" class="col-form-label text-md-right">{{ __('Customer:') }}</label>
                                <input id="customer" type="text" class="form-control" name="customer" value="{{ $qa_user->customer }}" maxlength="89" required>
                                @if ($errors->has('customer'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('customer') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">                            
                            <div class="col-md-6">
                                <label for="unit_area" class="col-form-label text-md-right">{{ __('Unit/Area No:') }}</label>
                                <input id="unit_area" type="text" class="form-control" name="unit_area" maxlength="75" value="{{ $qa_user->unit_area }}" required>
                            </div>

                            <div class="col-md-6">
                                <label for="site_manager" class="col-form-label text-md-right">{{ __('Site Manager:') }}</label>
                                <input id="site_manager" type="text" class="form-control" name="site_manager" value="{{ $qa_user->site_manager }}" maxlength="30">
                                @if ($errors->has('site_manager'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('site_manager') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group row">                            
                            <div class="col-md-6">
                                <label for="foreman" class="col-form-label text-md-right">{{ __('Foreman:') }}</label>
                                <select class="form-control" name="foreman">
                                       <option value="">Select Foreman</option>
                                    @foreach(App\Employee::where('foreman', 1)->get() as $employee)
                                        <option value="{{$employee->id}}" {{ $qa_user->foreman == $employee->id ? 'selected' : '' }}>{{$employee->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label for="customer" class="col-form-label text-md-right">{{ __('Distribution:') }}</label>
                                <select class="form-control" name="distribution">
                                       <option value="Builder" {{ $qa_user->distribution == 'Builder' ? 'selected' : '' }}>Builder</option>
                                       <option value="Client" {{ $qa_user->distribution == 'Client' ? 'selected' : '' }}>Client</option>
                                       <option value="Reg Auth." {{ $qa_user->distribution == 'Reg Auth.' ? 'selected' : '' }}>Reg Auth.</option>
                                       <option value="Engineer" {{ $qa_user->distribution == 'Engineer' ? 'selected' : '' }}>Engineer</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">                            
                            <div class="col-md-12">
                                <label for="location" class="col-form-label text-md-right">{{ __('Location:') }}</label>
                                <input id="location" type="text" class="form-control" name="location" value="{{ $qa_user->location }}" required>
                                @if ($errors->has('location'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('location') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <hr/>
                        <h4 class="text-center">
                            <strong>Activities</strong>
                        </h4>
                        <div class="row text-center font-weight-bold card-header mb-1">                                                          
                              <div class="col-md-3">Activity</div>
                              <div class="col-md-1">A/T</div>
                              <div class="col-md-3">Criteria Requirements</div>
                              <div class="col-md-1 px-0">Reference</div>
                              <div class="col-md-1 px-0">Yes/No</div>
                              <div class="col-md-1 px-0">Installed By</div>
                              <div class="col-md-1 px-0">Checked By</div>
                              <div class="col-md-1 px-0">Date</div>                            
                        </div>         
                        @foreach($qa_user->activities as  $key => $activity)     
                            <input type="hidden" name="activities[{{$key}}][description]" value="{{$activity->description}}" required/>
                            <input type="hidden" name="activities[{{$key}}][requirements]" value="{{$activity->requirements}}" required/>
                            <input type="hidden" name="activities[{{$key}}][at]" value="{{$activity->at}}" required/>
                            <input type="hidden" name="activities[{{$key}}][order]" value="{{$activity->order}}" required/>                          
                            <div class="row mb-1 div-striped">                                                          
                                    <div class="col-md-3 px-0">
                                        ({{$activity->order}}) {{$activity->description}}
                                    </div>
                                  <div class="col-md-1 text-center px-0">
                                    {{$activity->at}}
                                  </div>
                                  <div class="col-md-3 px-0">
                                    {{$activity->requirements}}
                                  </div>
                                  <div class="col-md-1 px-0">
                                      <input type="text" class="form-control px-1" name="activities[{{$key}}][reference]" value="{{ $activity->reference }}"/>
                                  </div>
                                  <div class="col-md-1 px-0">
                                        <select name="activities[{{$key}}][yes_no]" class="form-control">
                                            <option value="yes" {{$activity->yes_no == 'yes' ? 'selected' : ''}}>Yes</option>
                                            <option value="no" {{$activity->yes_no == 'no' ? 'selected' : ''}}>No</option>
                                        </select>                                      
                                  </div>
                                  <div class="col-md-1 px-0">
                                        <input id="title" type="text" class="form-control" name="activities[{{$key}}][installed_by]" value="{{ $activity->installed_by }}"/">                                        
                                  </div>
                                  <div class="col-md-1 px-0">
                                        <input id="title" type="text" class="form-control" name="activities[{{$key}}][checked_by]" value="{{ $activity->checked_by }}"">                                        
                                  </div>
                                  <div class="col-md-1 px-0">
                                        <input id="title" type="text" class="form-control date-picker px-0" name="activities[{{$key}}][activity_date]" value="{{ Carbon::parse($activity->activity_date)->format('d/m/Y') }}">                                        
                                  </div>                            
                            </div>                
                        @endforeach

                        <hr>
                        <h4 class="text-center">
                            <strong>Comments</strong>
                        </h4>                        
                        <div class="form-group">                            
                            <textarea class="form-control" id="comments" name="comments" rows="8" style="resize: none; text-align: left" maxlength="1900">{{trim(stripslashes(htmlentities($qa_user->comments)))}}</textarea>
                        </div>
                        <hr/>                                                                                            
                        <h4 class="text-center">
                            <strong>Approved By</strong>
                        </h4>                        
                        <div class="form-group row">                            
                            <div class="col-md-3">
                                <label for="approved_name_1" class="col-form-label text-md-right">{{ __('Name:') }}</label>
                                <input id="approved_name_1" type="text" class="form-control" name="approved_name_1" value="{{ $qa_user->approved_name_1 }}">
                            </div>
                            <div class="col-md-3">
                                <label for="approved_company_1" class="col-form-label text-md-right">{{ __('Company:') }}</label>
                                <input id="approved_company_1" type="text" class="form-control" name="approved_company_1" value="{{ $qa_user->approved_company_1 }}">
                            </div>
                            <div class="col-md-3">
                                <label for="approved_position_1" class="col-form-label text-md-right">{{ __('Position:') }}</label>
                                <input id="approved_position_1" type="text" class="form-control" name="approved_position_1" value="{{ $qa_user->approved_position_1 }}">
                            </div>
                            <div class="col-md-3">
                                <label for="approved_position_1" class="col-form-label text-md-right">{{ __('Signature:') }}</label>
                                <br>                                
                                <button id="signature_1" type="button" class="btn btn-secondary btn-signature">
                                    {{ __('Sign') }}
                                </button>                                                                                
                                <input type="hidden" name="img_signature_1" id="img_signature_1" value="{{ $qa_user->approved_sign_1 }}">
                                <img class="ml-1" id="preview_signature_1" src="{{ $qa_user->approved_sign_1 }}" style="width: 32%;" />
                            </div>
                        </div>
                        <div class="form-group row">                            
                            <div class="col-md-3">
                                <label for="approved_name_2" class="col-form-label text-md-right">{{ __('Name:') }}</label>
                                <input id="approved_name_2" type="text" class="form-control" name="approved_name_2" value="{{ $qa_user->approved_name_1 }}">
                            </div>
                            <div class="col-md-3">
                                <label for="approved_company_2" class="col-form-label text-md-right">{{ __('Company:') }}</label>
                                <input id="approved_company_2" type="text" class="form-control" name="approved_company_2" value="{{ $qa_user->approved_company_1 }}">
                            </div>
                            <div class="col-md-3">
                                <label for="approved_position_2" class="col-form-label text-md-right">{{ __('Position:') }}</label>
                                <input id="approved_position_2" type="text" class="form-control" name="approved_position_2" value="{{ $qa_user->approved_position_1 }}">
                            </div>
                            <div class="col-md-3">
                                <label for="approved_position_2" class="col-form-label text-md-right">{{ __('Signature:') }}</label>
                                <br>                                
                                <button id="signature_2" type="button" class="btn btn-secondary btn-signature">
                                    {{ __('Sign') }}
                                </button>                                                                 
                                <input type="hidden" name="img_signature_2" id="img_signature_2" value="{{ $qa_user->approved_sign_2 }}">               
                                <img class="ml-1" id="preview_signature_2" src="{{ $qa_user->approved_sign_2 }}" style="width: 32%;" />
                            </div>
                        </div>

                        <div class="form-group row">                            
                            <div class="col-md-3">
                                <label for="approved_name_3" class="col-form-label text-md-right">{{ __('Name:') }}</label>
                                <input id="approved_name_3" type="text" class="form-control" name="approved_name_3" value="{{ $qa_user->approved_name_3 }}">
                            </div>
                            <div class="col-md-3">
                                <label for="approved_company_3" class="col-form-label text-md-right">{{ __('Company:') }}</label>
                                <input id="approved_company_3" type="text" class="form-control" name="approved_company_3" value="{{ $qa_user->approved_company_3 }}">
                            </div>
                            <div class="col-md-3">
                                <label for="approved_position_3" class="col-form-label text-md-right">{{ __('Position:') }}</label>
                                <input id="approved_position_3" type="text" class="form-control" name="approved_position_3" value="{{ $qa_user->approved_position_3 }}">
                            </div>
                            <div class="col-md-3">
                                <label for="approved_position_3" class="col-form-label text-md-right">{{ __('Signature:') }}</label>
                                <br>                                
                                <button id="signature_3" type="button" class="btn btn-secondary btn-signature">
                                    {{ __('Sign') }}
                                </button>                                 
                                <input type="hidden" name="img_signature_3" id="img_signature_3" value="{{ $qa_user->approved_sign_3 }}">                                               
                                <img class="ml-1" id="preview_signature_3" src="{{ $qa_user->approved_sign_3 }}" style="width: 32%;" />
                            </div>
                        </div>
                        <div class="form-group row">                            
                            <div class="col-md-3">
                                <label for="approved_name_4" class="col-form-label text-md-right">{{ __('Name:') }}</label>
                                <input id="approved_name_4" type="text" class="form-control" name="approved_name_4" value="{{ $qa_user->approved_name_4 }}">
                            </div>
                            <div class="col-md-3">
                                <label for="approved_company_4" class="col-form-label text-md-right">{{ __('Company:') }}</label>
                                <input id="approved_company_4" type="text" class="form-control" name="approved_company_4" value="{{ $qa_user->approved_company_4 }}">
                            </div>
                            <div class="col-md-3">
                                <label for="approved_position_4" class="col-form-label text-md-right">{{ __('Position:') }}</label>
                                <input id="approved_position_4" type="text" class="form-control" name="approved_position_4" value="{{ $qa_user->approved_position_4 }}">
                            </div>
                            <div class="col-md-3">
                                <label for="approved_position_4" class="col-form-label text-md-right">{{ __('Signature:') }}</label>
                                <br>                                
                                <button id="signature_4" type="button" class="btn btn-secondary btn-signature">
                                    {{ __('Sign') }}
                                </button>                                 
                                <input type="hidden" name="img_signature_4" id="img_signature_4" value="{{ $qa_user->approved_sign_4 }}">                                               
                                <img class="ml-1" id="preview_signature_4" src="{{ $qa_user->approved_sign_4 }}" style="width: 32%;" />
                            </div>
                        </div>
                        <div class="form-group alert alert-info" role="alert">                
                            <h4 style="text-align: center;">Photos</h4>    
                            @foreach($qa_user->photos as $photo)                            
                                    <div class="alert alert-secondary photo-row" id="photos[{{$photo->photo_number}}]_row">                          
                                        <h5 style="text-align: center;">Photo</h5>          
                                        <div class="input-group col-12 mb-3">
                                          <div class="custom-file" id="photos_list">
                                            <input type="file" class="custom-file-input qa_photos" id="photos[{{$photo->photo_number}}]" name="photos[{{$photo->photo_number}}]"/>                        
                                            <label class="custom-file-label" for="photos[{{$photo->photo_number}}]">Choose files</label>
                                          </div>
                                        </div>

                                        <div class="input-group col-12 mb-3">
                                            <img id="photos[{{$photo->photo_number}}]_img" src="{{ $photo->qa_photo }}" class="img-fluid" style="">
                                        </div>   
                                        <input id="photos[{{$photo->photo_number}}]-delete" type="button" class="btn btn-danger btn-sm ml-2 delPhoto" value="Delete">
                                        <input type="hidden" class="custom-file-input" id="photos[{{$photo->photo_number}}]_hidden" name="photos[{{$photo->photo_number}}]_hidden" value="{{$photo->qa_photo}}">                        
                                    </div>                            
                            @endforeach 
                            <div id="additional_photos">
                                
                            </div>

                            <div>                                
                                <input id="addPhoto" type="button" class="btn btn-success btn-sm ml-2 addPhoto" value="Add Photo">
                            </div>                    

                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-4 offset-md-2">
                                <a href="{{ URL::to('/qa_users') }}" class="btn btn-danger btn-lg btn-block">
                                    {{ __('Cancel') }}
                                </a>
                            </div>

                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary btn-lg btn-block">
                                    {{ __('Update') }}
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
        <h5 class="modal-title">Signature 1</h5>
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
<div class="modal" tabindex="-1" role="dialog" id="modal_signature_2">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Signature 2</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <div class="form-group alert" role="alert">
                <h4 style="text-align: center;">Signature</h4>
                    <div class="form-row" style="text-align: center;">
                        <div class="col-md-12 mb-3">

                            
                            <div id="div_signature_2" class="div-signature"></div>

                            <input type="button" value="Clear" id="div_signature_2" class="btn btn-danger btn-clear-sign" >

                            <script>
                            </script>
                        </div>
                    </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-save-sign" id="save_signature_2" data-dismiss="modal" >Save & Close</button>
      </div>
    </div>
  </div>
</div>
<div class="modal" tabindex="-1" role="dialog" id="modal_signature_3">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Signature 3</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <div class="form-group alert" role="alert">
                <h4 style="text-align: center;">Signature</h4>
                    <div class="form-row" style="text-align: center;">
                        <div class="col-md-12 mb-3">

                            
                            <div id="div_signature_3" class="div-signature"></div>

                            <input type="button" value="Clear" id="div_signature_3" class="btn btn-danger btn-clear-sign" >

                            <script>
                            </script>
                        </div>
                    </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-save-sign" id="save_signature_3" data-dismiss="modal" >Save & Close</button>
      </div>
    </div>
  </div>
</div>
<div class="modal" tabindex="-1" role="dialog" id="modal_signature_4">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Signature 4</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <div class="form-group alert" role="alert">
                <h4 style="text-align: center;">Signature</h4>
                    <div class="form-row" style="text-align: center;">
                        <div class="col-md-12 mb-3">

                            
                            <div id="div_signature_4" class="div-signature"></div>

                            <input type="button" value="Clear" id="div_signature_4" class="btn btn-danger btn-clear-sign" >

                            <script>
                            </script>
                        </div>
                    </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-save-sign" id="save_signature_4" data-dismiss="modal" >Save & Close</button>
      </div>
    </div>
  </div>
</div>
@endsection

