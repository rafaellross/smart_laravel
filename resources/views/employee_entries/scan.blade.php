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

      #camera {
        width: 100vw;
      }

      #camera video {
        width: 100%;

        height: 200px;
      }

    </style>

  </head>

  <body>

    <h1 class="text-center" style="font-family: "Whitney A", "Whitney B", sans-serif;">SCAN EMPLOYEE ID</h1>

    <div id="camera">

      <video id="preview"></video>

    </div>
    <hr/>

    <div class="container">

        <div id="employee" class="col-xs-12 col-sm-12 col-lg-12 col-md-12"></div>

        <hr>

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

      let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });

      let scannedEmployees = [];

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

              let employee = JSON.parse(content);

              beepOk.play();

              if (!findObjectByKey(scannedEmployees, 'id', employee.id)) {

                  scannedEmployees.push(JSON.parse(content));

                  renderEmployees(scannedEmployees);

              }

        } catch (e) {

          beepError.play();

          alert("Code wasn't recognised!");

        }

      });


      function playSound() {

            var sound = document.getElementById("audio");

            sound.play();

      }

      function findObjectByKey(array, key, value) {

          for (var i = 0; i < array.length; i++) {

              if (array[i][key] === value) {

                  return key;

              }
          }

          return false;

      }

      function renderEmployees(selecteds){

        let div = document.querySelector('#employee');

        div.innerHTML = "";

        selecteds.forEach(function(employee){

          div.innerHTML += employeeRow(employee);

        });

      }

      function employeeRow(employee){
        return `<div id="emp-2" class="active select-employee card ">
            <div class="select-employee card-header" role="tab" id="heading-undefined">
              <div class="row">
                <div class="col-md-11 col-lg-11">
                  <h6>`+employee.name+`</h6>
                </div>
                <div class="col-md-1 col-lg-1 float-right" style="padding-left: 0px; display: block">
                  <button id="`+employee.id+`" class="btn btn-danger btn-select" style="" onclick="deleteEmployee(`+employee.id+`)">Delete</button>
                </div>
                </div>
            </div>
          </div>`;

      }

      function deleteEmployee(key){

        var result = confirm("Are you sure you want unselect this employee?");

        if (result == true) {

          scannedEmployees.splice(key, 1);

          renderEmployees(scannedEmployees);

        }

      }

      function debug(){
        console.log(scannedEmployees);
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

      $("#btn-continue").click(function() {

        if (scannedEmployees.length > 0) {

          window.location = "create/" + scannedEmployees.join(",");
          
        }
      });


    </script>
  </body>
</html>
