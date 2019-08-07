<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="img/apple-icon.png">
  <link rel="icon" type="image/png" href="img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <title>Generate</title>
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">

  <!-- CSS Files -->
  <link href="css/material-dashboard.css?v=2.1.1" rel="stylesheet" />
</head>

<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-color="purple" data-background-color="white" data-image="img/sidebar-1.jpg">
      <div class="logo">
        <a class="simple-text logo-normal">
          Panel
        </a>
      </div>
      <div class="sidebar-wrapper" data-color="white">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="{{route('dashboard')}}">
              <i class="material-icons">dashboard</i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="{{route('generate')}}">
              <i class="material-icons">code</i>
              <p>Generate QR Code</p>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="{{route('database')}}">
              <i class="material-icons">data_usage</i>
              <p>DataBase</p>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="./typography.html">
              <i class="material-icons">library_books</i>
              <p>Others</p>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <p class="navbar-brand">Generate</p>
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
                  <a class="dropdown-item" href="#">Profile</a>
                  <a class="dropdown-item" href="#">Settings</a>
                  <div class="dropdown-divider"></div>
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
          <div class="row">
            <!-- Single Generate -->
            <div class="col-xl-1 col-lg-1 col-md-1 col-sm-1 "></div>
            <div class="col-xl-5 col-lg-5 col-md-5 col-sm-5 ">
              <div class="card">
                <h3 class="text-muted text-center">
                  Single Generate
                </h3>
                <form action="{{ route('generate.StoreFirst') }}" method="post">
                  <div class="row" style="margin:20px 20px 0px 20px">
                    {{ csrf_field() }}
                    <div class="col-md-4">
                      <p for="CustomCodeGenerate" class="text-center text-nowrap">Pre-Text</p>
                      <input type="text" id="Pre-Text1" class="form-control" name="Pre-Text1" />
                      @if ($errors->has('Pre-Text1'))
                      <p class="text-danger text-center">{{ $errors->first('Pre-Text1') }}</p>
                      @endif
                    </div>
                    <div class="col-md-4">
                      <p class="text-center text-nowrap">Number</p>
                      <input type="text" class="form-control" name="SingleNumberGenerator" class="submit-button" />
                      @if ($errors->has('SingleNumberGenerator'))
                      <p class="text-danger text-center">{{ $errors->first('SingleNumberGenerator') }}</p>
                      @endif
                    </div>
                    <div class="col-md-4 text-center">
                      <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                          <p class="text-center">Sent</p>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-lg-12">
                          <span class="button-checkbox">
                            <button type="button" class="btn btn-sm btn-default" data-color="primary" style="margin-top: -5px;">
                              <i class="state-icon glyphicon glyphicon-check"></i>
                              <i class="material-icons">
                                check
                              </i> 
                              <input type="checkbox" class="invisible" style="position: absolute;" name="CheckBoxValue" checked>
                            </button>
                          </span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 col-xl-6">
                      <p class="writeinfo" style="margin:25px 20px 30px 30px">
                        @if($CheckRecords == 0)
                        <b>Last Generated Code:</b> NoRecord
                        @else
                        <b>Last Generated Code:</b> {{$CodesRequest}}
                        @endif
                      </p>
                    </div>
                    <div class="col-md-6 col-xl-6">
                      <button type="submit" class="btn btn-primary pull-right " style="margin:20px 20px 20px 20px">
                        Submit
                      </button>
                    </div>
                  </div>
                </form>
                <!--End random Generate-->
              </div>
            </div>
            <!-- Single Generate End -->
            <!-- Random Generate-->
            <div class="col-xl-5 col-lg-5 col-md-5 col-sm-5 ">
              <div class="card">
                <h3 class="text-muted text-center">
                  Multiple Generate
                </h3>
                <form action="{{ route('generate.StoreSecond') }}" method="post">
                  <div class="row" style="margin:20px 20px 0px 20px">
                    {{ csrf_field() }}
                    <div class="col-md-4">
                      <p class="text-center text-nowrap">Pre-Text</p>
                      <input type="text" class="form-control" name="Pre-Text2" />
                      @if ($errors->has('Pre-Text2'))
                      <p class="text-danger text-center">{{ $errors->first('Pre-Text2') }}</p>
                      @endif
                    </div>

                    <div class="col-md-4">
                      <p class="text-center text-nowrap">Number</p>
                      <input type="text" class="form-control" name="MultipleNumberGenerator" class="submit-button" />
                      @if ($errors->has('MultipleNumberGenerator'))
                      <p class="text-danger text-center">{{ $errors->first('MultipleNumberGenerator') }}</p>
                      @endif
                    </div>

                    <div class="col-md-4">
                      <p class="text-center text-nowrap">How Many</p>
                      <input type="text" class="form-control" name="How_Many" class="submit-button" />
                      @if ($errors->has('How_Many'))
                      <p class="text-danger text-center">{{ $errors->first('How_Many') }}</p>
                      @endif
                    </div>
                  </div>
                  <button type="submit" class="btn btn-primary pull-right" style="margin:20px 20px 20px 20px">Submit</button>
                </form>
                <!--End random Generate-->
              </div>
            </div>
            <!-- Random Genrate End -->
            <div class="col-xl-1 col-lg-1 col-md-1 col-sm-1 "></div>
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


</body>

<script>
  $(function() {
    $('.button-checkbox').each(function() {

      // Settings
      var $widget = $(this),
        $button = $widget.find('button'),
        $checkbox = $widget.find('input:checkbox'),
        color = $button.data('color'),
        settings = {
          on: {
            icon: 'glyphicon glyphicon-check'
          },
          off: {
            icon: 'glyphicon glyphicon-unchecked'
          }
        };

      // Event Handlers
      $button.on('click', function() {
        $checkbox.prop('checked', !$checkbox.is(':checked'));
        $checkbox.triggerHandler('change');
        updateDisplay();
      });
      $checkbox.on('change', function() {
        updateDisplay();
      });

      // Actions
      function updateDisplay() {
        var isChecked = $checkbox.is(':checked');

        // Set the button's state
        $button.data('state', (isChecked) ? "on" : "off");

        // Set the button's icon
        $button.find('.state-icon')
          .removeClass()
          .addClass('state-icon ' + settings[$button.data('state')].icon);

        // Update the button's color
        if (isChecked) {
          $button
            .removeClass('btn-default')
            .addClass('btn-' + color + ' active');
        } else {
          $button
            .removeClass('btn-' + color + ' active')
            .addClass('btn-default');
        }
      }

      // Initialization
      function init() {

        updateDisplay();

        // Inject the icon if applicable
        if ($button.find('.state-icon').length == 0) {
          $button.prepend('<i class="state-icon ' + settings[$button.data('state')].icon + '"></i> ');
        }
      }
      init();
    });
  });
</script>

</html>