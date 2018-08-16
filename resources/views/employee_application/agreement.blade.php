<!DOCTYPE html>

<html>

  <head>

    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

    <link rel="shortcut icon" href="{{{ asset('img/brand.ico') }}}">

    <link rel="apple-touch-icon" href="{{ asset('img/brand.ico') }}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ 'Administration - Smart Plumbing Solutions' }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
          $('#submit_application').addClass('disabled');
          $('#modalLoading').modal({backdrop: 'static', keyboard: false});

          setTimeout(function(){ $('#modalLoading').modal('hide'); alert('Please, review and confirm your information!')}, 15000);


          if($('#chk_policy').is(':checked')) {
            $('#submit_application').removeClass('disabled');
          }

          $(document).on('click', '#chk_policy', function(event) {
            if(this.checked) {
                $('#submit_application').removeClass('disabled');
            } else {
                $('#submit_application').addClass('disabled');
            }
          });

          $('#submit_application').click(function(event) {
            if(!confirm("Do you confirm submission?")) {
              event.preventDefault();
            }
          });




        });
</script>

    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">






  </head>

  <body>
    <div class="container">
      <div class="embed-responsive embed-responsive-21by9">
        <iframe src = "{{asset('js/ViewerJS')}}/#../../employee_application/action/{{$id}}/print" class="embed-responsive-item" height='568' allowfullscreen webkitallowfullscreen></iframe>
      </div>
        <br>
        <!-- Actions Card-->
        <div class="card shadow" id="actions">
            <h5 class="card-header">Declaration</h5>
            <div class="card-body">
                <!-- Start Card -->
                <div class="form-row">
                  <div class="col-md-12 mb-3">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" class="custom-control-input" id="chk_policy" value="accept">
                      <label class="custom-control-label" for="chk_policy">
                        I <i>{{strtoupper($application->first_name) . " " .  strtoupper($application->last_name)}}</i>, declare that the information I have given is true and correct.
                      </label>
                    </div>
                  </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-row">
                        <div class="col-md-5 col-12 mb-3">
                            <a id="submit_application" href="{{ URL::to('/employee_application/' . $id . '/agreement') }}" class="btn btn-warning">Submit</a>
                            <a href="{{ URL::to('/employee_application') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </div>
                    <!-- End Card -->
                </div>
            </div>
        </div>

    </div>

    <div id="modalLoading" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalLoading" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content" style="width: 48px">
                <span class="fa fa-spinner fa-spin fa-3x"></span>
            </div>
        </div>
    </div>

</body>


</html>
