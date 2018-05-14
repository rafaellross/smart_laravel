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
                                <input id="update_date" type="number" class="form-control" name="revision" value="{{ $qa_user->revision }}" required>
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
                                <input id="customer" type="text" class="form-control" name="customer" value="{{ $qa_user->customer }}" required>
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
                                <input id="unit_area" type="text" class="form-control" name="unit_area" value="{{ $qa_user->unit_area }}" required>
                            </div>

                            <div class="col-md-6">
                                <label for="site_manager" class="col-form-label text-md-right">{{ __('Site Manager:') }}</label>
                                <input id="site_manager" type="text" class="form-control" name="site_manager" value="{{ $qa_user->site_manager }}" required>
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
                                    @foreach(App\employee::where('foreman', 1)->get() as $employee)
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
                            <table class="table">
                              <thead>
                                <tr>
                                  <th scope="col">Activity</th>
                                  <th scope="col">A/T</th>
                                  <th scope="col">Criteria Requirements</th>
                                  <th scope="col">Reference</th>
                                  <th scope="col">Yes/No</th>
                                  <th scope="col">Installed By</th>
                                  <th scope="col">Checked By</th>
                                  <th scope="col">Date</th>
                                </tr>
                              </thead>
                              <tbody>
                                @foreach($qa_user->activities as  $key => $activity)
                                    <input type="hidden" name="activities[{{$key}}][description]" value="{{$activity->description}}" required/>
                                    <input type="hidden" name="activities[{{$key}}][requirements]" value="{{$activity->requirements}}" required/>
                                    <input type="hidden" name="activities[{{$key}}][at]" value="{{$activity->at}}" required/>
                                    <input type="hidden" name="activities[{{$key}}][order]" value="{{$activity->order}}" required/>
                                    <tr>                                  
                                        <td>({{$activity->order}})
                                            {{$activity->description}}
                                        </td>
                                        <td>
                                            {{$activity->at}}
                                        </td>
                                        <td>
                                            {{$activity->requirements}}
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="activities[{{$key}}][reference]" value="{{ $activity->reference }}"/>
                                        </td>
                                        <td>
                                            <select name="activities[{{$key}}][yes_no]" class="form-control">
                                                <option value="yes" {{$activity->yes_no == 'yes' ? 'selected' : ''}}>Yes</option>
                                                <option value="no" {{$activity->yes_no == 'no' ? 'selected' : ''}}>No</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input id="title" type="text" class="form-control" name="activities[{{$key}}][installed_by]" value="{{ $activity->installed_by }}"/">                                        
                                        </td>                                        
                                        <td>
                                            <input id="title" type="text" class="form-control" name="activities[{{$key}}][checked_by]" value="{{ $activity->checked_by }}"">                                        
                                        </td>                                        
                                        <td>
                                            <input id="title" type="text" class="form-control date-picker" name="activities[{{$key}}][activity_date]" value="{{ Carbon::parse($activity->activity_date)->format('d/m/Y') }}"" required>                                        
                                        </td>                                        

                                    </tr>                            
                                @endforeach
                              </tbody>
                            </table>
                        <hr>
                        <h4 class="text-center">
                            <strong>Comments</strong>
                        </h4>                        
                        <div class="form-group">                            
                            <textarea class="form-control" id="comments" name="comments" rows="5" style="resize: none; text-align: left" maxlength="1432">{{trim(stripslashes(htmlentities($qa_user->comments)))}}</textarea>
                        </div>
                        <hr/>                                                
                        <div class="col-md-5 col-12 mb-3">
                            <button type="button" class="btn btn-success" id="addActivity">Add Activity</button>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-5 offset-md-7">
                                <a href="{{ URL::to('/qa_users') }}" class="btn btn-danger">
                                    {{ __('Cancel') }}
                                </a>
                                <button type="submit" class="btn btn-primary">
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
@endsection

