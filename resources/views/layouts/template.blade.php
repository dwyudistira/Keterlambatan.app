<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Rekapitulasi App</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<style>
      body {
        background-color: #EEF5FF;
      }
</style>
<body>
  <nav class="navbar bg-body-tertiary fixed-top" style="box-shadow: 2px 4px 2px 1px rgba(0, 0, 0, 0.1);">
  <div class="container-fluid">
    <i class="fa fa-house">
      <a class="navbar-brand" href="#">Rekam keterlambatan</a>
    </i>
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
      <div class="offcanvas-header">
        <i class="fa fa-house">
          <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Rekam Keterlambatan</h5>
        </i>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
          @if(Auth::check())
            @if(Auth::user()->role == "admin")
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{ route('home.page') }}">Dashboard</a>
          </li>          
              <li class="nav-item dropdown">
                <li class="nav-item">
                  <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Data Master
                  </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="{{ route('rayon.home') }}">Data Rayon</a></li>
                  <li><a class="dropdown-item" href="{{ route('rombel.home') }}">Data Rombel</a></li>
                  <li><a class="dropdown-item" href="{{ route('student.home') }}">Data Siswa</a></li>
                  <li><a class="dropdown-item" href="{{ route('user.home') }}">Data User</a></li>
                </ul>
              </li>
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{ route('late.home') }}">Data Keterlambatan</a>
              </li>
              @endif
              
              @if(Auth::user()->role == "ps")
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{ route('Ps.role.home') }}">Dashboard</a>
              </li> 
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{ route('Ps.role.dataSiswa') }}">Data Siswa</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{ route('Ps.role.dataLate') }} ">Data Keterlambatan</a>
              </li>
              @endif
              <a class="nav-link" href="{{ route('logout') }}" role="button">
                Log Out
              </a>
          @endif

        </ul>
      </div>
    </div>   
  </div>
</nav>
  <div class="container mt-5">
    @yield('content')
  </div>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>
</html>
