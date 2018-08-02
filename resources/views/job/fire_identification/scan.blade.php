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

    <script type="text/javascript" src="{{ asset('js/instascan.min.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">

    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css">



    <style type="text/css">
/*
      #camera {
        width: 100vw;
      }

      #camera video {
        width: 100%;

        height: 370px;
      }
*/
    </style>

  </head>

  <body>



    <div class="container">
        <div class="col-12">
 <h1 class="text-center" style="font-family: "Whitney A", "Whitney B", sans-serif;">SCAN PENETRATION TAG</h1>

    <div id="camera">

      <video class="offset-md-3 col-md-6 bg-light" id="preview"></video>

    </div>
    <hr/>
        </div>

        <div class="card" style="">
        <div class="card-body">
            <h5 class="card-title">Project</h5>
            <h6 class="card-subtitle mb-2 text-muted" id="project"></h6>

            <hr/>

            <h5 class="card-title">Penetration Number</h5>
            <h6 class="card-subtitle mb-2 text-muted" id="fire_number"></h6>

            <hr/>

            <h5 class="card-title">Fire Seal Reference</h5>
            <h6 class="card-subtitle mb-2 text-muted" id="fire_seal_ref"></h6>

            <hr/>

            <h5 class="card-title">Fire Resistance Level (FRL)</h5>
            <h6 class="card-subtitle mb-2 text-muted" id="fire_resist_level"></h6>

            <hr/>

            <h5 class="card-title">Manufacturer of Fire Stopping System</h5>
            <h6 class="card-subtitle mb-2 text-muted" id="manufacturer"></h6>

        </div>
        </div>
        <hr>

        <div class="row">

          <div class="col-xs-12 col-sm-12 col-lg-6 col-md-6">
                <button id="`+employee.id+`" class="btn btn-danger btn-lg btn-block" style="" onclick="_clear()">Clear</button>
          </div>

          <div class="col-xs-12 col-sm-12 col-lg-6 col-md-6">
            <a id="btnCancel" href="{{ URL::to('/') }}" class="btn btn-secondary btn-lg btn-block">Cancel</a>
          </div>
          <div class="col-xs-12 col-sm-12 col-lg-6 col-md-6">

            <button id="btn-continue" class="btn btn-primary btn-lg btn-block" onclick="_continue()">Continue</button>

          </div>
        </div>
    </div>

    <script type="text/javascript">

      let scanner = new Instascan.Scanner({ video: document.getElementById('preview'), mirror: false });

      let selected = null;

      let beepOk = new Audio('https://www.soundjay.com/button/beep-01a.wav');

      beepOk.muted = true;

      beepOk.play().then(()=>{

        beepOk.pause(),

        beepOk.muted = false

      });


      let beepError = new Audio('https://www.soundjay.com/button/beep-03.wav');

      beepError.muted = true;

      beepError.play().then(()=>{

        beepError.pause(),

        beepError.muted = false

      });


      scanner.addListener('scan', function (content) {
       try {

              let fireSeal = JSON.parse(content);

              beepOk.play();

              document.getElementById('project').innerHTML = fireSeal.project;
              document.getElementById('fire_number').innerHTML = fireSeal.fire_number;

              document.getElementById('fire_seal_ref').innerHTML = fireSeal.fire_seal_ref;
              document.getElementById('fire_resist_level').innerHTML = fireSeal.fire_resist_level;
              document.getElementById('fire_resist_level').innerHTML = fireSeal.fire_resist_level;
              document.getElementById('manufacturer').innerHTML = fireSeal.manufacturer;
              selected = fireSeal.id;
              alert("QR Code loaded!");


        } catch (e) {

          beepError.play();
          alert("Code wasn't recognised!");

        }

      });



      function _clear(){
          document.getElementById('project').innerHTML = "";
          document.getElementById('fire_number').innerHTML = "";
          document.getElementById('fire_seal_ref').innerHTML = "";
          document.getElementById('fire_resist_level').innerHTML = "";
          document.getElementById('fire_resist_level').innerHTML = "";
          document.getElementById('manufacturer').innerHTML = "";
          selected = null;

      }


      Instascan.Camera.getCameras().then(function (cameras) {

        if (cameras.length > 0) {

          //Check if there is 2 cameras
          if (cameras.length > 1) {

            scanner.start(cameras[1]);

          } else {

            scanner.start(cameras[0]);
          }


        } else {

          console.error('No cameras found.');
          alert('No cameras found.');

        }

      }).catch(function (e) {

        console.error(e);

      });

      function _continue() {

        if (selected === null) {

          alert("Please, scan tag to continue" + selected);


        } else {
          window.location = "./edit/" + selected;
        }
      };


    </script>
  </body>
</html>
