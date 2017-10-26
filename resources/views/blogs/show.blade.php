@extends('layouts.app')

@section('content')
<div class="container blog-index">
      <div class="row">
        <main class="col-sm-12 ml-sm-auto col-md-12 pt-3" role="main">
          <h1>Blog 
          	@role('administrator')
          	<a href="{{ route('blogs.index') }}" class="btn btn-success float-right"> 
              << Voltar
            </a>
          	@endrole
          </h1>
              <div class="row">
                <div class="col-md-12">
                  <div style="
                  background: url({{ asset('storage/blogs/' . $blog->image) }}) no-repeat center center fixed; 
                  -webkit-background-size: cover;
                  -moz-background-size: cover;
                  -o-background-size: cover;
                  background-size: cover; 
                  height: 300px; 
                  width: 100%;"> </div> 
                  <h2 class="title"> {{ $blog->title }}</h2>

                  <article>
                    {{ $blog->content }}
                  </article>
                  <hr>
                  @include('blogs.partials.images', ['images' => $blog->images])
                  <p class="created">Criado em {{ $blog->created_at->format('d/m/Y') }}</p>
                </div>
              </div>
              <hr>
        </main>
      </div>
    </div>
@endsection
