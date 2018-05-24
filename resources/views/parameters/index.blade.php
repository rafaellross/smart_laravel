@extends('layouts.app')

@section('content')

<div class="container">
    <h2 style="text-align: center;">Parameters</h2>
    <hr/>
    <div class="form-group row">
        <div class="col-md-12 col-lg-12 col-12">
            <a href="{{ URL::to('/parameters/create') }}" class="btn btn-primary">Create New</a>
        </div>

    </div>
    <table class="table table-hover table-responsive-sm table-striped">
        <thead>
            <tr>
                <th scope="col"><input type="checkbox" id="chkRow"></th>
                <th scope="col">#</th>
                <th scope="col">Business Name</th>
                <th scope="col">ABN</th>
                <th scope="col">Address</th>
            </tr>
        </thead>
        <tbody>
    @foreach ($parameters as $parameter)
                  <tr>
                        <th>
                            <input type="checkbox" id="chkRow-{{ $parameter->id }}">
                        </th>
                        <td>{{ $parameter->id }}</td>
                        <td>{{ $parameter->business_name }}</td>
                        <td>{{ $parameter->abn }}</td>
                        <td>{{ $parameter->business_address }}</td>
                        <td></td>
                        <td style="text-align: center;">
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Actions
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="{{action('ParametersController@edit', $parameter->id)}}">Edit</a>                                    
                                </div>
                            </div>
                        </td>
                  </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
