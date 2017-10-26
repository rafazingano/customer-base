@extends('layouts.app')

@section('content')
<div class="container blog-index">
      <div class="row">
        <main class="col-sm-12 ml-sm-auto col-md-12 pt-3" role="main">
          <h1>Blog 
          	@role('administrator')
          	<a href="{{ route('blogs.create') }}" class="btn btn-success float-right"> 
              Adicionar
            </a>
          	@endrole
          </h1>
            @foreach($blogs as $blog)
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
                  <h2 class="title"><a href="{{ route('blogs.show', $blog->id) }}"> {{ $blog->title }}</a></h2>

                  <article>
                    {{ str_limit($blog->content, 300) }}
                  </article>
                  <p class="created">Criado em {{ $blog->created_at->format('d/m/Y') }}</p>
                  @role('administrator')
                  <a href="{{ route('blogs.edit', $blog->id) }}" style="position: absolute;top: 0;right: 0; background: transparent;border:0;">
                    <img src="{{ asset('assets/images/edit.png') }}">
                  </a>
                  {!! Form::model($blog, ['method' => 'DELETE', 'route' => ['blogs.destroy', $blog->id]]) !!}
                    <button type="submit" class="btn btn-secondary btn-sm" onclick="return confirm('Tem certeza que deseja excluir?')" style="position: absolute;top: 40px;padding: 0;right: 0; background: transparent;border:0;">
                      <img src="{{ asset('assets/images/destroy.png') }}">
                    </button>
                    {!! Form::close() !!}   
                  @endrole
                </div>
              </div>
              <hr>
            @endforeach

            {{ $blogs->links() }}

        </main>
      </div>
    </div>
@endsection
