<header>
    <div id="slide-out" class="side-nav">
      <ul class="custom-scrollbar">
        <li>
          <div class="logo-wrapper waves-light" style="height:175px">
            <a href="#"><img src="{{url('/assets/img/icon.png')}}" class="img-fluid flex-center"></a>
          </div>
        </li>
        <li>
          <ul class="collapsible collapsible-accordion">
            <li><a class="collapsible-header waves-effect" href="{{route('dashboard')}}"><i class="fas fa-chalkboard-teacher mr-2"></i> Dashboard</a></li>
            <li><a class="collapsible-header waves-effect" href="{{route('kegiatan')}}"><i class="fas fa-calendar-alt mr-2"></i> Program Kerja BEM</a></li>
            <li><a class="collapsible-header waves-effect arrow-r"><i class="fas fa-check-square mr-2"></i> Berita Acara Pengawasan<i class="fas fa-angle-down rotate-icon"></i></a>
              <div class="collapsible-body">
                <ul>
                  <li><a href="{{route('indikator')}}" class="waves-effect">Indikator BAP</a>
                  </li>
                  <li><a href="{{route('bap')}}" class="waves-effect">Semua BAP</a>
                  </li>
                </ul>
              </div>
            </li>
            <li><a class="collapsible-header waves-effect arrow-r"><i class="fas fa-cogs mr-2"></i> Kustomisasi<i class="fas fa-angle-down rotate-icon"></i></a>
                <div class="collapsible-body">
                  <ul>
                    <li><a href="{{route('indikator')}}" class="waves-effect">Divisi BEM</a>
                    </li>
                    <li><a href="{{route('bap')}}" class="waves-effect">Pengaturan</a>
                    </li>
                  </ul>
                </div>
            </li>
            <li><a class="collapsible-header waves-effect" href="{{route('file')}}"><i class="fas fa-pencil-alt mr-2"></i> Debug</a></li>
            <li><a class="collapsible-header waves-effect" href="{{route('exportFile')}}"><i class="fas fa-newspaper mr-2"></i> File Dummy</a></li>
          </ul>
        </li>
      </ul>
      <div class="mask-strong"></div>
    </div>
    <nav class="navbar fixed-top navbar-toggleable-md navbar-expand-lg double-nav">
      <div class="float-left">
        <a href="#" data-activates="slide-out" class="button-collapse"><i class="fa fa-bars"></i></a>
      </div>
      <div class="breadcrumb-dn mr-auto">
        <p> <img class="img-fluid mr-3" src="{{url('/assets/img/icon.png')}}" alt="" style="width: 35px"> Sistem Asesmen dan Evaluasi Proker</p>
      </div>
      <ul class="nav navbar-nav nav-flex-icons ml-auto">
        <li class="nav-item">
          <a class="nav-link"><i class="fa fa-bell"></i> <span class="clearfix d-none d-sm-inline-block">Notification</span></a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-user"></i> <span class="clearfix d-none d-sm-inline-block">{{Auth::user()->nama}}</span>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="{{url('logout')}}">Logout</a>
          </div>
        </li>
      </ul>
    </nav>
</header>
