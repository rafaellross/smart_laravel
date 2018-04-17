@extends('layouts.app')

@section('content')

<div class="container">
    <h2 style="text-align: center;">Users</h2>
    <hr/>
    <div class="form-group row">
        <div class="col-md-12 col-lg-12 col-12">                 
            <a href="{{ URL::to('/users/create') }}" class="btn btn-primary">Create New</a>                
            <a href="#" class="btn btn-danger mobile" id="btnDelete">Delete Selected(s)</a>
        </div>

    </div> 
    <table class="table table-hover table-responsive-sm">
        <thead>
            <tr>
                <th scope="col"><input type="checkbox" id="chkRow"></th>          
                <th scope="col">User</th>
                <th scope="col">Date Created</th>
                <th scope="col">Administrator</th>      
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>            
    @foreach ($users as $user)
                  <tr>                    
                        <th>
                            <input type="checkbox" id="chkRow-{{ $user->id }}">
                        </th>
                        <td>{{ $user->username }}</td>
<<<<<<< HEAD
                        <td>{{ Carbon\Carbon::parse($user->created_at)->format('d/m/Y') }}</td>

=======
                        <td>{{  Carbon\Carbon::parse($user->created_at)->format('d/m/Y') }}</td>
>>>>>>> office
                        <td>{{$user->administrator ? "Yes" : "No"}}</td>
                        <td style="text-align: center;">
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Actions
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="{{action('UserController@edit', $user->id)}}">Edit</a>                    
                                    <form action="{{action('UserController@destroy', $user->id)}}" method="post">
                                        {{csrf_field()}}
                                        <input name="_method" type="hidden" value="DELETE">
                                        <button class="dropdown-item" type="submit">Delete</button>
                                     </form>                                                                        
                                </div>
                            </div>        
                        </td>                    
                  </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection