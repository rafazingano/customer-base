@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <main class="col-sm-12 ml-sm-auto col-md-12 pt-3" role="main">
      <h1>Criar um novo post para o blog<a href="{{ route('blogs.index') }}" class="btn btn-success float-right"> 
              << Voltar
            </a></h1>            
        {!! Form::open(['route' => 'blogs.store', 'files' => true]) !!}
			@include('blogs.partials.form')
		{!! Form::close() !!}			
    </main>
  </div>
</div>
@endsection