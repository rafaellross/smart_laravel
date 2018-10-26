@extends('layouts.app')

@section('content')

<div class="container">
    <h2 style="text-align: center;">TMV Service Log </h2>
    <hr/>
    <div class="form-group row">
        <div class="col-md-10 col-lg-10 col-10">
        <div class="btn-group">
            <a href="{{ URL::to('/tmv_log/' . $tmv . '/create') }}" class="btn btn-primary">Create New</a>
        </div>
            <button class="btn btn-danger mobile" id="btnDelete">Delete Selected(s)</button>
            <div class="btn-group">
                <button class="btn btn-info mobile dropdown-toggle" type="button" id="dropdownMenuButtonPrint" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Print Selected(s)
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButtonPrint">
                  <button class="dropdown-item btnPrintFireLabel" id="label">Print Labels</button>
                  <button class="dropdown-item btnPrintFireReport" id="label">Print Service Log</button>
                  <button class="dropdown-item btnPrintFireLabel" id="label">Print Register</button>
                </div>
            </div>
        </div>
    </div>
    <table class="table table-hover table-responsive-sm table-striped">
        <thead>
            <tr>
                <th scope="col"><input type="checkbox" id="chkRow"></th>
                <th scope="col">#</th>
                <th scope="col">Endorsed By</th>
                <th scope="col">Date</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>

    @foreach ($logs as $tmv)
                  <tr>
                        <th>
                            <input type="checkbox" id="chkRow-{{ $tmv->id }}">
                        </th>
                        <td>{{ $tmv->id }}</td>
                        <td>{{ $tmv->endorsed_by1 }}</td>
                        <td>{{  Carbon::parse($tmv->log_dt)->format('d/m/Y')}}</td>
                        <td></td>
                        <td style="text-align: center;">
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Actions
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="{{ 'action/'. $tmv->id .'/report'}}" target="_blank">View</a>
                                    <a class="dropdown-item" href="{{action('TmvLogController@edit', $tmv->id)}}">Edit</a>
                                    <buttton class="dropdown-item delete" id="{{$tmv->id}}">Delete</buttton>
                                </div>
                            </div>
                        </td>
                        <td></td>
                  </tr>
            @endforeach
        </tbody>
    </table>
    <div class="col-md-10 offset-md-3">
            {{ $logs->links() }}
    </div>
</div>

@endsection
