<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DPM SAEP</title>
    <link rel="shortcut icon" href="{{{ asset('/assets/img/icon.png') }}}">
    <link href="{{url('/assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{url('/assets/fontawesome/css/all.min.css')}}" rel="stylesheet">
    <link href="{{url('/assets/css/mdb.min.css')}}" rel="stylesheet">
    <link href="{{url('/assets/css/style.css')}}" rel="stylesheet">
</head>
<body class="hidden-sn black-skin">
    <header>
        <nav class="navbar fixed-top navbar-toggleable-md navbar-expand-lg double-nav">
            <div class="breadcrumb-dn mr-auto">
              <p>Sistem Asesmen dan Evaluasi Proker</p>
            </div>
            <ul class="nav navbar-nav nav-flex-icons ml-auto">
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
                  aria-haspopup="true" aria-expanded="false">
                  <i class="fa fa-user"></i> <span class="clearfix d-none d-sm-inline-block"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="{{url('login')}}">Login</a>
                </div>
              </li>
            </ul>
        </nav>
    </header>
    <main class="container-fluid">
        <div class="container">
            <div class="row">
               <div class="card">
                   <div class="card-body">
                       <h4 class="card-title">Cek Cek</h4>
                       <p class="card-text">Berhasil Masuk {{base_path('Tagun.png')}}</p>
                   </div>
               </div>
            </div>
        </div>
    </main>
</body>
<script src="{{url('/assets/js/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{url('/assets/js/popper.min.js')}}"></script>
<script type="text/javascript" src="{{url('/assets/js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{url('/assets/fontawesome/js/all.min.js')}}"></script>
<script type="text/javascript" src="{{url('/assets/js/mdb.min.js')}}"></script>
</html>
