@extends('layouts.app')

@section('content')

<div class="container">
    <h2 style="text-align: center;">SERVICES PENETRATION FIRE SEAL {{strtoupper(App\Job::find($job)->description)}}  ({{count($fire_seals)}})</h2>
    <hr/>
    <div class="form-group row">
        <div class="col-md-12 col-lg-12 col-12">
        <div class="btn-group">
            <button class="btn btn-primary dropdown-toggle mobile" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Create New
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">                
                <button class="dropdown-item" id="btn_create_mult_fire">Create Multiple</buttona>
            </div>

        </div>
            <a href="#" class="btn btn-danger mobile" id="btnDelete">Delete Selected(s)</a>
            <div class="btn-group">
                <button class="btn btn-info mobile dropdown-toggle" type="button" id="dropdownMenuButtonPrint" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Print Selected(s)
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButtonPrint">
                <a class="dropdown-item btnPrintFireLabel" href="#" id="label">Print Labels</a>
                <a class="dropdown-item btnPrintFire" href="#" id="report">Print Penetration Report</a>
                </div>

            </div>
            <a href="{{ URL::to('/fire_identification/scan') }}" class="btn btn-secondary" id="btnDelete">Scan Penetration Tag</a>

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
            </tr>
        </thead>
        <tbody>

    @foreach ($fire_seals as $fire_seal)
                  <tr>
                        <th>
                            <input type="checkbox" id="chkRow-{{ $fire_seal->id }}">
                        </th>
                        <td>{{ $fire_seal->fire_number }}</td>
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
                                    <a class="dropdown-item delete" id="{{$fire_seal->id}}" href="#">Delete</
                                </div>
                            </div>
                        </td>
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
                            <label for="quantity" class="col-md-4 col-form-label text-md-right">{{ __('Quantity:') }}</label>
                            <div class="col-md-6">
                                <input id="quantity" type="number" class="form-control{{ $errors->has('quantity') ? ' is-invalid' : '' }}" name="quantity" value="" required>
                                @if ($errors->has('quantity'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('quantity') }}</strong>
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
