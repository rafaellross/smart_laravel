@extends('layouts.app')

@section('content')

<div class="container">
    <h2 style="text-align: center;">SERVICES PENETRATION FIRE SEAL {{strtoupper(App\Job::find($job)->description)}}  ({{count($fire_seals)}})</h2>
    <hr/>
    <div class="form-group row">
        <div class="col-md-10 col-lg-10 col-10">
        <div class="btn-group">
            <button class="btn btn-primary dropdown-toggle mobile" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Create New
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <button class="dropdown-item" id="btn_create_mult_fire">Create Multiple</buttona>
            </div>

        </div>
            <button class="btn btn-danger mobile" id="btnDelete">Delete Selected(s)</button>
            <div class="btn-group">
                <button class="btn btn-info mobile dropdown-toggle" type="button" id="dropdownMenuButtonPrint" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Print Selected(s)
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButtonPrint">
                <button class="dropdown-item btnPrintFireLabel" id="label">Print Labels</button>
                <button class="dropdown-item btnPrintFireReport" id="label">Print Report</button>

                </div>
            </div>
            <a href="{{ URL::to('/fire_identification/scan') }}" class="btn btn-secondary" id="btnDelete">Scan Penetration Tag</a>

        </div>

        <div class="col-md-2 col-lg-2 col-2">
          <select class="custom-select" id="selectDrawing">
            <option selected="">Filter Drawing...</option>
            <option value="all">All</option>
            @foreach ($drawings as $drawing)
              <option>{{$drawing->drawing}}</option>
            @endforeach
          </select>

        </div>


    </div>
    <table class="table table-hover table-responsive-sm table-striped">
        <thead>
            <tr>
                <th scope="col"><input type="checkbox" id="chkRow"></th>
                <th scope="col">#</th>
                <th scope="col">Drawing</th>
                <th scope="col">Fire Seal Ref.</th>
                <th scope="col">Fire Resistance Level (FRL)</th>
                <th scope="col">Installed By</th>
                <th scope="col">Installed Date</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>

    @foreach ($fire_seals as $fire_seal)
                  <tr>
                        <th>
                            <input type="checkbox" id="chkRow-{{ $fire_seal->id }}">
                        </th>
                        <td>{{ $fire_seal->id }}</td>
                        <td>{{ $fire_seal->drawing }}</td>
                        <td>{{ $fire_seal->fire_seal_ref }}</td>
                        <td>{{ $fire_seal->fire_resist_level }}</td>
                        <td>{{ $fire_seal->install_by }}</td>
                        <td>{{  Carbon::parse($fire_seal->install_dt)->format('d/m/Y')}}</td>
                        <td></td>
                        <td style="text-align: center;">
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Actions
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="{{action('FireIdentificationController@edit', $fire_seal->id)}}">Edit</a>
                                    <buttton class="dropdown-item delete" id="{{$fire_seal->id}}">Delete</buttton>
                                </div>
                            </div>
                        </td>
                        <td></td>
                  </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="modal" tabindex="-1" role="dialog" id="modalCreateMultipleFire">
  <div class="modal-dialog" role="document">
    <form method="POST" action="{{action('FireIdentificationController@multiple', $job)}}">
        @csrf

        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">SERVICES PENETRATION FIRE SEAL</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <div class="modal-body">

                        <div class="form-group row">
                            <label for="drawing" class="col-md-4 col-form-label text-md-right">{{ __('Drawing') }}</label>

                            <div class="col-md-6">
                                <input id="drawing" type="text" class="form-control{{ $errors->has('drawing') ? ' is-invalid' : '' }}" name="drawing" value="" required>

                                @if ($errors->has('drawing'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('drawing') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="fire_resist_level" class="col-md-4 col-form-label text-md-right">{{ __('Fire Resistance Level (FRL):') }}</label>
                            <div class="col-md-6">
                                <input id="fire_resist_level" type="text" class="form-control{{ $errors->has('fire_resist_level') ? ' is-invalid' : '' }}" name="fire_resist_level" value="{{ old('fire_resist_level') }}" required>
                                @if ($errors->has('fire_resist_level'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('fire_resist_level') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="install_dt" class="col-md-4 col-form-label text-md-right">{{ __('Installed Date:') }}</label>
                            <div class="col-md-6">
                                <input id="install_dt" type="text" class="form-control{{ $errors->has('install_dt') ? ' is-invalid' : '' }} date-picker" name="install_dt" value="{{ old('install_dt') }}">
                                @if ($errors->has('install_dt'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('install_dt') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="install_by" class="col-md-4 col-form-label text-md-right">{{ __('Installed By:') }}</label>
                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control{{ $errors->has('install_by') ? ' is-invalid' : '' }}" name="install_by" value="{{ old('install_by') }}">
                                @if ($errors->has('install_by'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('install_by') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="manufacturer" class="col-md-4 col-form-label text-md-right">{{ __('Manufacturer of Fire Stopping System:') }}</label>
                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control{{ $errors->has('manufacturer') ? ' is-invalid' : '' }}" name="manufacturer" value="{{ old('manufacturer') }}">
                                @if ($errors->has('manufacturer'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('manufacturer') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="start_number" class="col-md-4 col-form-label text-md-right">{{ __('Start Number:') }}</label>
                            <div class="col-md-6">
                                <input id="start_number" type="number" class="form-control{{ $errors->has('start_number') ? ' is-invalid' : '' }}" name="start_number" value="{{ $max_id }}" required>
                                @if ($errors->has('start_number'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('start_number') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="end_number" class="col-md-4 col-form-label text-md-right">{{ __('End Number:') }}</label>
                            <div class="col-md-6">
                                <input id="end_number" type="number" class="form-control{{ $errors->has('end_number') ? ' is-invalid' : '' }}" name="end_number" value="{{ $max_id }}" required>
                                @if ($errors->has('end_number'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('end_number') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

          </div>
          <div class="modal-footer">
            <input type="submit" class="btn btn-primary" value="Continue"/>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
      </form>
    </div>
  </div>
</div>

@endsection
