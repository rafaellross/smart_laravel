@extends('layouts.app')

@section('content')

<div class="ontainer-fluid">
    <h2 style="text-align: center;">FIRE MATRIX </h2>
    <hr/>
    <div class="form-group row">
        <div class="col-md-10 col-lg-10 col-10">
        <div class="btn-group">
            <a href="{{ URL::to('/fire_matrix/create') }}" class="btn btn-primary">Create New</a>
        </div>
            <button class="btn btn-danger mobile" id="btnDelete">Delete Selected(s)</button>
            <div class="btn-group">
                <button class="btn btn-info mobile" type="button" id="printMatrix">
                Print Selected(s)
                </button>
            </div>
            

        </div>
        


    </div>
    <table class="table-hover table table-striped table-bordered">
        <thead>
            <tr class="text-center">
                <th scope="col"><input type="checkbox" id="chkRow"></th>
                <th scope="col" colspan="2">#</th>
                <th scope="col" colspan="4">Reference</th>
                <th scope="col">Fire Stopping System</th>                                                
                <th scope="col" colspan="4">Service Type</th>
                <th scope="col">Wall or Slab Type</th>                  
                <th scope="col">Dt. Test Report</th>                
                <th scope="col"></th>                
            </tr>
        </thead>
        <tbody>

    @foreach ($matrices as $matrix)
                  <tr>
                        <th>
                            <input type="checkbox" id="chkRow-{{ $matrix->id }}">
                        </th>
                        <td class="text-center" colspan="2">{{ $matrix->id }}</td>
                        <td class="text-center" colspan="4">{{ $matrix->reference }}</td>
                        <td>{{ $matrix->fire_stop_sys}}</td>
                        <td class="text-justify" colspan="4">{{ $matrix->service_type }}</td>
                        <td>{{ $matrix->wall_type}}</td>
                        
                        <td>{{ Carbon::parse($matrix->test_dt)->format('d/m/Y')}}</td>                                                
                        <td style="text-align: center;">
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Actions
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="{{action('FireMatrixController@edit', $matrix->id)}}">Edit</a>
                                    <buttton class="dropdown-item delete" id="{{$matrix->id}}">Delete</buttton>
                                </div>
                            </div>
                        </td>                        
                  </tr>
            @endforeach
        </tbody>
    </table>

</div>


@endsection
