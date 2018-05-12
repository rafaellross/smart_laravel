@extends('layouts.app')

@section('content')
    <script src="{{ asset('js/qa.js') }}"></script>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Q.A Type') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('qa_types.update', $qa_types->id) }}">
                        @csrf
                        @method('PATCH')
                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>
                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ $qa_types->title }}"/>
                                @if ($errors->has('title'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>
                            <div class="col-md-6">
                                <input id="description" type="text" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" value="{{ $qa_types->description }}"/>
                                @if ($errors->has('description'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <hr/>
                        <h4 class="text-center">
                            <strong>Activities</strong>
                        </h4>
                        <div id="activities">
                            @foreach($qa_types->activities as $activity)
                                <div id="row-act-{{$activity->order}}" class="row-act">
                                    <div class="form-group row">
                                        <label for="activities[{{$activity->order}}]" class="col-md-4 col-form-label text-md-right">Activity</label>
                                        <div class="col-md-6">
                                            <input id="activities[{{$activity->order}}][description]" type="text" class="form-control" name="activities[{{$activity->order}}][description]" value="{{$activity->description}}" />                                
                                        </div>
                                    </div>                        
                                    <div class="form-group row">
                                        <label for="activities[{{$activity->order}}][at]" class="col-md-4 col-form-label text-md-right">A/T:</label>
                                        <div class="col-md-6">
                                            <select name="activities[{{$activity->order}}][at]" class="form-control">                                    
                                                <option value="V" {{$activity->at == 'V' ? 'selected' : ''}}>Verify</option>
                                                <option value="R" {{$activity->at == 'R' ? 'selected' : ''}}>Random</option>
                                                <option value="H" {{$activity->at == 'H' ? 'selected' : ''}}>Hold</option>
                                                <option value="S" {{$activity->at == 'S' ? 'selected' : ''}}>Submit</option>
                                                <option value="I" {{$activity->at == 'I' ? 'selected' : ''}}>Inspect</option>
                                                <option value="W" {{$activity->at == 'W' ? 'selected' : ''}}>Witness Points</option>
                                                <option value="C" {{$activity->at == 'C' ? 'selected' : ''}}>Comments</option>                                    
                                                <option value="N" {{$activity->at == 'N' ? 'selected' : ''}}>Notification Point</option>
                                            </select>                                
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="activities[{{$activity->order}}][requirements]" class="col-md-4 col-form-label text-md-right">Criteria Requirements</label>
                                        <div class="col-md-6">
                                            <input id="activities[{{$activity->order}}][requirements]" type="text" class="form-control" name="activities[{{$activity->order}}][requirements]" value="{{$activity->requirements}}" />                                
                                        </div>
                                    </div>                            
                                    <div class="form-group row">
                                        <label for="activities[{{$activity->order}}][order]" class="col-md-4 col-form-label text-md-right">Order</label>
                                        <div class="col-md-6">
                                            <input id="activities[{{$activity->order}}][order]" type="number" class="form-control order" name="activities[{{$activity->order}}][order]" value="{{$activity->order}}"/>                                
                                        </div>
                                    </div>                            

                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <input id="act-{{$activity->order}}" type="button" class="btn btn-danger btn-sm ml-2 btn-remove-act" value="Remove Activity"/>
                                        </div>                                
                                    </div>                            
                                </div>
                                <hr/>

                            @endforeach
                        </div>
                        <hr/>                                                
                        <div class="col-md-5 col-12 mb-3">
                            <button type="button" class="btn btn-success" id="addActivity">Add Activity</button>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-5 offset-md-7">
                                <button type="submit" class="btn btn-danger">
                                    {{ __('Cancel') }}
                                </button>
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
