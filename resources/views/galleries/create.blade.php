@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <main class="col-sm-12 ml-sm-auto col-md-12 pt-3" role="main">
      <h1>Adicionar um novo Guia de execução <a href="{{ route('campaigns.galleries.index', $campaign->id) }}" class="btn btn-success float-right"> 
              << Voltar
            </a></h1>            
        {!! Form::open(['route' => 'galleries.store', 'files' => true]) !!}
			@include('galleries.partials.form')
		{!! Form::close() !!}			
    </main>
  </div>
</div>
@endsection