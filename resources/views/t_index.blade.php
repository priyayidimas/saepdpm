<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DPM SAEP &middot; @yield('title')</title>
    <link rel="shortcut icon" href="{{{ asset('/assets/img/icon.png') }}}">
    <link href="{{url('/assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{url('/assets/fontawesome/css/all.min.css')}}" rel="stylesheet">
    <link href="{{url('/assets/css/mdb.min.css')}}" rel="stylesheet">
    <link href="{{url('/assets/css/style.css')}}" rel="stylesheet">
    <style>
        .navbar {
            z-index: 1040;
        }
        .side-nav {
            margin-top: 47px !important;
        }
        .double-nav .breadcrumb-dn p {
            color: #fff;
        }
    </style>
    @yield('head')
</head>
<body class="fixed-sn black-skin">
  @include('navigation')
  <main>
    <div class="container-fluid">
      @yield('content')
    </div>
  </main>
</body>
<script src="{{url('/assets/js/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{url('/assets/js/popper.min.js')}}"></script>
<script type="text/javascript" src="{{url('/assets/js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{url('/assets/fontawesome/js/all.min.js')}}"></script>
<script type="text/javascript" src="{{url('/assets/js/mdb.min.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function () {
        new WOW().init();

        $(".button-collapse").sideNav({
            breakpoint: 1200
        });
        var sideNavScrollbar = document.querySelector('.custom-scrollbar');
        var ps = new PerfectScrollbar(sideNavScrollbar);

        @if(session('msg'))
            toastr["{{session('color')}}"]("{{session('msg')}}");
        @endif

        $('.mdb-select').materialSelect();
        $("#mdb-lightbox-ui").load("assets/css/mdb-addons/mdb-lightbox-ui.html");
    });
</script>
@yield('script')
</html>
