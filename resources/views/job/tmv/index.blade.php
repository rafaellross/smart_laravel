@extends('layouts.app')

@section('content')

<div class="container">
    <h2 style="text-align: center;">TMV's | {{strtoupper(App\Job::find($job)->description)}}  ({{count($tmvs)}})</h2>
    <hr/>
    <div class="form-group row">
        <div class="col-md-10 col-lg-10 col-10">
        <div class="btn-group">
            <a href="{{ URL::to('/tmv/' . $job . '/create') }}" class="btn btn-primary">Create New</a>
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
                <th scope="col">Room Number</th>
                <th scope="col">Location</th>
                <th scope="col">Type of Valve</th>


                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>

    @foreach ($tmvs as $tmv)
                  <tr>
                        <th>
                            <input type="checkbox" id="chkRow-{{ $tmv->id }}">
                        </th>
                        <td>{{ $tmv->id }}</td>
                        <td>{{ $tmv->room_number }}</td>
                        <td>{{ $tmv->location }}</td>
                        <td>{{ $tmv->type_valve }}</td>


                        <td></td>
                        <td style="text-align: center;">
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Actions
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="{{action('TmvController@edit', $tmv->id)}}">Edit</a>
                                    <a class="dropdown-item" href="{{ $tmv->job_id . '/action/'. $tmv->id .'/report'}}">View</a>

                                    <a class="dropdown-item" href="{{ 'tmv_log/'. $tmv->id }}">Log</a>
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
            {{ $tmvs->links() }}
    </div>
</div>

@endsection
