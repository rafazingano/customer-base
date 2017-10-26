@extends('layouts.app')

@section('content')
<div class="container">
      <div class="row">
        <main class="col-sm-12 ml-sm-auto col-md-12 pt-3" role="main">
          <h1>Listagem de usuários <a href="{{ route('users.create') }}" class="btn btn-success float-right">Adicionar</a></h1>
            @include('users.partials.datatable', ['users' => $users])
            <hr>
        </main>
      </div>
    </div>
@endsection
