@extends('layouts.login')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4 ml-md-auto mr-md-auto">

            <div class="panel panel-default" style="background: #f0f0f0;padding: 20px;">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-2"></div>
                        <div class="col-8">
                            <img src="{{ asset('assets/images/img_logo positivacao.png') }}" class="img-fluid">
                        </div>
                        <div class="col-2"></div>
                    </div>

                    <form class="form-horizontal form-signin" method="POST" action="{{ route('login') }}" style="    margin-top: 20px">
                        {{ csrf_field() }}
                        
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-12 control-label">E-Mail</label>

                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-12 control-label">Senha</label>

                            <div class="col-md-12">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Lembre-Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary" style="border-color: #c93721; background: #c93721;">
                                    Entrar
                                </button>

                                <!--a class="btn btn-link" href="{{ route('password.request') }}">
                                    Forgot Your Password?
                                </a-->
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="navbar fixed-bottom navbar-expand navbar-dark bg-dark" style="height: 90px;
    padding: 30px;
    color: #fff;
    font-size: 14px;">
  <div class="container-fluid">
      <div class="row" style=" width: 100%;">
            <div class="col-6" style="padding: 4px 5px;">
                <img src="assets/images/logo-2.png" class="img-fluid" style="    margin-top: 4px;float:left; width: 180px;">
                <p style="margin-left: 10px;float:left; margin-bottom: 4px; padding-top: 0px;">Copyright  2017 - Algo mais gráfica e editora
                    <br>
                Todos os direitos reservados</p>
            </div>
            <div class="col-2" style="padding: 4px 5px;">
                <img src="assets/images/phone.png" class="img-fluid" style="    margin: 4px;height: 40px;float: left;">
                <p style="margin-bottom: 4px; padding-top: 0px;"><span style="font-size: 14px;">Fone (51)</span> <b>3222 2339</b></p>
            </div>
            <div class="col-4" style="padding: 4px 5px;">
                <img src="assets/images/map.png" class="img-fluid" style="    margin: 4px;height: 40px;float: left;">
                <p style="margin-bottom: 4px; padding-top: 0px;">Rua  Santos Dumount, nº 1101 São Geraldo</p>
                <p style="margin-bottom: 4px;">Cep 90230-241 - Porto Alegre,RS</p>
            </div>
        </div>
    </div>
</div>

@endsection