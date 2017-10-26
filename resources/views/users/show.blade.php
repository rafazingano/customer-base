@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <main class="col-sm-12 ml-sm-auto col-md-12 pt-3" role="main">
      <h1>Usuário {{ $user->name }} <a href="{{ route('users.index') }}" class="btn btn-success float-right"> 
              << Voltar
            </a></h1>            
        <div class="jumbotron">
          <h1 class="display-3">{{ $user->name }}</h1>
          <p class="lead">{{ $user->email }}</p>
          <hr class="my-4">
          <p>
            Criado em {{ $user->created_at->format('d/m/Y') }}
            <br>
            Editado pela última vez em {{ $user->updated_at->format('d/m/Y') }}
          </p>
          <p class="lead"> 
            {!! Form::model($user, ['method' => 'DELETE', 'route' => ['users.destroy', $user->id]]) !!}
            <a class="btn btn-primary btn-lg" href="{{ route('users.edit', $users->id) }}" role="button">Editar</a>
            <button type="submit" class="btn btn-secondary">Deletar</button>
            {!! Form::close() !!} 
          </p>
        </div>
        <hr>
    </main>
  </div>
</div>
@endsection