@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    <a href="{{ URL::to('/timesheets') }}" class="list-group-item list-group-item-action ">Time Sheet</a>            
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
