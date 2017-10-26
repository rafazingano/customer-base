@extends('layouts.app')

@section('content')
<div class="container">
      <div class="row">
        <main class="col-sm-12 ml-sm-auto col-md-12 pt-3" role="main">
          <h1>Editar o usuário {{ $user->name }} <a href="{{ route('users.index') }}" class="btn btn-success float-right"> 
              << Voltar
            </a></h1>            
            {!! Form::model($user, ['method' => 'PUT', 'route' => ['users.update', $user->id]]) !!}
      			    @include('users.partials.form')
      			{!! Form::close() !!}			
            <hr>
        </main>
      </div>
    </div>
@endsection