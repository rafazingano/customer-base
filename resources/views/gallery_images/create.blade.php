@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <main class="col-sm-12 ml-sm-auto col-md-12 pt-3" role="main">
      <h1>Adicionar uma nova imagem</h1>            
        {!! Form::open(['route' => 'galleries.store']) !!}
			@include('galleries.partials.form')
		{!! Form::close() !!}			
    </main>
  </div>
</div>
@endsection