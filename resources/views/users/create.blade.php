@extends('layouts.app')

@section('content')
<div class="container">
      <div class="row">
        <main class="col-sm-12 ml-sm-auto col-md-12 pt-3" role="main">
          <h1>Criar um novo usuário <a href="{{ route('users.index') }}" class="btn btn-success float-right"> 
              << Voltar
            </a></h1>            
            {!! Form::open(['route' => 'users.store']) !!}
			    @include('users.partials.form')
			{!! Form::close() !!}			
            <hr>
        </main>
      </div>
    </div>
@endsection