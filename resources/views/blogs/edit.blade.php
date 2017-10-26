@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <main class="col-sm-12 ml-sm-auto col-md-12 pt-3" role="main">
      <h1>Editar o post {{ $blog->title }}<a href="{{ route('blogs.index') }}" class="btn btn-success float-right"> 
              << Voltar
            </a></h1> 
      	<div style="background: url({{ asset('storage/blogs/' . $blog->image) }}) no-repeat center center fixed; 
                  -webkit-background-size: cover;
                  -moz-background-size: cover;
                  -o-background-size: cover;
                  background-size: cover; 
                  height: 300px; 
                  width: 100%;"> </div>        
        {!! Form::model($blog, ['method' => 'PUT', 'route' => ['blogs.update', $blog->id], 'files' => true]) !!}
		    @include('blogs.partials.form')
		{!! Form::close() !!}
		<hr>
		@include('blogs.partials.images', ['images' => $blog->images])
    </main>
  </div>
</div>
@endsection