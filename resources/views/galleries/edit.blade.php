@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <main class="col-sm-12 ml-sm-auto col-md-12 pt-3" role="main">
      <h1>Editar um Guia de execução {{ $gallery->title }} <a href="{{ route('campaigns.galleries.index', $campaign->id) }}" class="btn btn-success float-right"> 
              << Voltar
            </a></h1>            
        {!! Form::model($gallery, ['method' => 'PUT', 'route' => ['galleries.update', $gallery->id], 'files' => true]) !!}
		    @include('galleries.partials.form')
		{!! Form::close() !!}
		<hr>
		@include('galleries.partials.images', ['images' => $gallery->images])
    </main>
  </div>
</div>
@endsection