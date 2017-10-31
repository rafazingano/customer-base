 <!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{ asset('assets/favicon.ico') }}">
    <title>Algo Mais</title>
    <link href="{{ asset('assets/Bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/DataTables/datatables.min.css') }}"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.1.25/jquery.fancybox.min.css" />

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/datetimepicker/jquery.datetimepicker.min.css') }}"/>

    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/font-awesome/css/font-awesome.min.css') }}">

  </head>
  <body>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
      <a class="navbar-brand" href="{{ route('campaigns.index') }}">
        <img src="{{ asset('assets/images/LOGO_NOVO.PNG') }}" class="img-fluid" style="height: 30px;}">
      </a>

      <button class="navbar-toggler d-lg-none collapsed" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav mr-auto">
      </ul>
        <ul class="navbar-nav mt-2 mt-md-0">
        <!--li class="nav-item active">
          <a class="nav-link" href="{{ route('home') }}">Dashboard <span class="sr-only">(current)</span></a>
        </li-->
        <li class="nav-item">
          <a class="nav-link" href="{{ route('campaigns.index') }}">Campanhas</a>
        </li>

        @role('administrator')
        <li class="nav-item">
          <a class="nav-link" href="{{ route('users.index') }}">Usuários</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('blogs.index') }}">Blog</a>
        </li>
        <!--li class="nav-item">
          <a class="nav-link" href="{{ route('kits.index') }}">Enxoval PDV</a>
        </li-->
        <!--li class="nav-item">
          <a class="nav-link" href="{{ route('galleries.index') }}">Galeria</a>
        </li-->
        @endrole

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            {{ Auth::user()->name }}
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">

            <a class="dropdown-item" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();">
                Sair
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form> 
          </div>
        </li>
      </ul>
    </div>
    </nav>

    @if ($errors->any())
        <div class="alert alert-danger">
          <div class="container">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
          </div>
        </div>
    @endif
    @if (session('message'))
        <div class="alert alert-success">
          <div class="container">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            {{ session('message') }}
          </div>
        </div>
    @endif

     @yield('content')

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script type="text/javascript" src="{{ asset('assets/Jquery/jquery-3.2.1.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/Bootstrap/js/vendor/popper.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/Bootstrap/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/Bootstrap/js/ie10-viewport-bug-workaround.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/DataTables/datatables.min.js') }}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.1.25/jquery.fancybox.min.js"></script>  

    <script src="{{ asset('assets/datetimepicker/jquery.datetimepicker.full.min.js') }}"></script>

    <script type="text/javascript" type="text/javascript" src="{{ asset('assets/js/app.js') }}"></script>


    <script>
    $.datetimepicker.setLocale('pt-BR');
    $('.datetimepicker').datetimepicker({
      mask: true,
      format:'Y-m-d'
    });
  </script>


    @stack('scripts')

  </body>
</html>
