@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header">Company Files</div>
                <div class="card-body">


                    @foreach ($companies as $company)
                        <a href="{{ URL::to('/myob/employees?guid=') . $company->Id }}" class="list-group-item list-group-item-action ">{{$company->Name}}</a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
