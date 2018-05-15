@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    <a href="{{ URL::to('/timesheets') }}" class="list-group-item list-group-item-action ">Time Sheet</a>            
                    @if (isset(Auth::user()->tester) && Auth::user()->tester)                    
                        <a href="{{ URL::to('/qa_users') }}" class="list-group-item list-group-item-action ">Q.A Forms</a>            
                        <a href="{{ URL::to('/employee_application') }}" class="list-group-item list-group-item-action ">Employee Application</a>            
                        <a href="{{ URL::to('/form_prestart') }}" class="list-group-item list-group-item-action ">Prestart</a>                                                                                                            
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
