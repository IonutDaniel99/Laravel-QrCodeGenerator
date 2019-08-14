<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="img/apple-icon.png">
  <link rel="icon" type="image/png" href="img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>Database</title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <!-- CSS Files -->
  <link href="css/material-dashboard.css?v=2.1.1" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="demo/demo.css" rel="stylesheet" />
</head>

<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-color="green" data-background-color="black" data-image="img/sidebar-1.jpg">
      <div class="logo">
        <a class="simple-text logo-normal">
          Panel
        </a>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="{{route('dashboard')}}">
              <i class="material-icons">dashboard</i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('generate')}}">
              <i class="material-icons">code</i>
              <p>Generate QR Code</p>
            </a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="{{route('database')}}">
              <i class="material-icons">data_usage</i>
              <p>DataBase</p>
            </a>
          </li>
          @if(auth()->user()->roles =="owner")
          <li class="nav-item ">
            <a class="nav-link" href="{{ route('users.index') }}">
              <i class="material-icons">person</i>
              <p>User DataBase</p>
            </a>
          </li>
          @endif
        </ul>
      </div>
    </div>
    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <p class="navbar-brand">Database</p>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end">
            <ul class="navbar-nav">
              <li class="nav-item dropdown">
                <a class="nav-link" href="#pablo" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="material-icons">person</i>
                  <p class="d-lg-none d-md-block">
                    Account
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                  <a class="dropdown-item" href="{{ url('/logout') }}">Log out</a>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
      <div class="content">
        <div class="container-fluid">
          <div class="card">
            <div class="card-header bg-dark text-center">
              <p class="card-category text-white">Database</p>
            </div>
            <div class="card-body">
              <table class="table table-striped table-hover">
                <thead class="text-primary text-center thead-dark">
                  <th>ID</th>
                  <th>Codes</th>
                  <th>Create Date</th>
                  <th>Sent</th>
                  <th>Sent At</th>
                  <th>Used</th>
                  <th>Used At</th>
                  <th>Functions</th>
                </thead>
                <tbody>
                  @foreach($QrCodePagination as $qrcode)
                  <tr class="text-center">
                    <td>{{ $qrcode->id }}</td>
                    <td>{{ $qrcode->codes }}</td>
                    <td>{{ $qrcode->created_at }}</td>
                    <td>
                      @if($qrcode->sent === 1)
                      <b>
                        Yes
                      </b>
                      @else
                      <b>
                        No
                      </b>
                      @endif
                    </td>
                    <td>{{ $qrcode->sent_at }}</td>
                    <td>
                      @if($qrcode->used === 0)
                      <b>
                        Yes
                      </b>
                      @else
                      <b>
                        No
                      </b>
                      @endif
                    </td>
                    <td>{{ $qrcode->used_at }}</td>
                    <td>
                      <!--<a href='database/edit/{{$qrcode->id}}' class="material-icons">send</a>-->
                      @if($qrcode->sent == 0)
                      {{ csrf_field() }}
                      <a href='database/update/{{ $qrcode->id }}' method="POST" class="material-icons" name="changeStatus" value="No">check</a>
                      @else
                      <a href='database/update/{{ $qrcode->id }}' method="POST" class="material-icons" name="changeStatus" value="Yes">close</a>
                      @endif
                      <a href='#' class="material-icons" target="popup" onclick="window.open('database/view/{{$qrcode->codes}}','name','width=280,height=310')">remove_red_eye</a>
                      <a href='database/download/{{$qrcode->codes}}' class="material-icons">cloud_download</a>
                      @if(auth()->user()->roles =="owner" ||auth()->user()->roles =="admin")
                      <a href='database/delete/{{ $qrcode->id }}' class="material-icons">delete</a>
                      @endif
                    </td>
                  </tr>
                  @endforeach
                  {{$QrCodePagination -> links()}}
                </tbody>
              </table>
              @if(auth()->user()->roles =="owner" ||auth()->user()->roles =="admin")
              <a class="btn btn-danger" href="{{ url('/database/delete_all') }}">Delete All</a>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>

  <!--   Core JS Files   -->
  <script src="js/core/jquery.min.js"></script>
  <script src="js/core/popper.min.js"></script>
  <script src="js/core/bootstrap-material-design.min.js"></script>
  <script src="js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!-- Plugin for the momentJs  -->
  <script src="js/plugins/moment.min.js"></script>
  <!--  Plugin for Sweet Alert -->
  <script src="js/plugins/sweetalert2.js"></script>
  <!-- Forms Validations Plugin -->
  <script src="js/plugins/jquery.validate.min.js"></script>
  <!-- Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
  <script src="js/plugins/jquery.bootstrap-wizard.js"></script>
  <!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
  <script src="js/plugins/bootstrap-selectpicker.js"></script>
  <!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
  <script src="js/plugins/bootstrap-datetimepicker.min.js"></script>
  <!--  DataTables.net Plugin, full documentation here: https://datatables.net/  -->
  <script src="js/plugins/jquery.dataTables.min.js"></script>
  <!--	Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
  <script src="js/plugins/bootstrap-tagsinput.js"></script>
  <!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
  <script src="js/plugins/jasny-bootstrap.min.js"></script>
  <!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
  <script src="js/plugins/fullcalendar.min.js"></script>
  <!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
  <script src="js/plugins/jquery-jvectormap.js"></script>
  <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
  <script src="js/plugins/nouislider.min.js"></script>
  <!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support SweetAlert -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
  <!-- Library for adding dinamically elements -->
  <script src="js/plugins/arrive.min.js"></script>
  <!-- Chartist JS -->
  <script src="js/plugins/chartist.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="js/material-dashboard.js?v=2.1.1" type="text/javascript"></script>
  <!-- Material Dashboard DEMO methods, don't include it in your project! -->
  <script src="demo/demo.js"></script>

</body>


</html>