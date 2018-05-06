@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
		<input class="form-control form-control-lg" type="text" placeholder="Search Employee" id="search">
		</div>
		<div class="row">
		<button type="button" class="btn btn-info btn-lg btn-block" id="btnSearch">Search</button>
		</div>
		<hr>
		<div id="employee" class="col-xs-12 col-sm-12 col-lg-12 col-md-12"></div>				
		<hr>
		<div id="selecteds" class="col-xs-12 col-sm-12 col-lg-12 col-md-12">
			<h4>Selecteds <span id="countSelecteds">(0)</span>:</h4>
		</div>				
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-lg-6 col-md-6">
				<a id="btnCancel" href="./" class="btn btn-secondary btn-lg btn-block">Cancel</a>	
			</div>				
			<div class="col-xs-12 col-sm-12 col-lg-6 col-md-6">
				<button id="btn-continue" class="btn btn-primary btn-lg btn-block">Continue</button>			
			</div>
		</div>
	</div>
	<script type="text/javascript">
	</script>


@endsection