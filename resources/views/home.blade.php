@extends('layouts.app')

@section('content')
<div class="container-fluid">
      <div class="row">
        <div class="col-sm-2  ml-sm-auto col-md-2">
          <ul class="list-group">
            <li class="list-group-item list-group-item-success">{{ $customers->where('status', 'ATIVADO')->count() }} Ativado</li>
            <li class="list-group-item list-group-item-warning">{{ $customers->where('status', 'PARCIAL')->count() }} Parcial</li>
            <li class="list-group-item list-group-item-danger">{{ $customers->where('status', 'NÃO ATIVADO')->count() }} Não Ativado</li>
            <li class="list-group-item list-group-item-primary">{{ $customers->where('status', 'AGUARDANDO')->count() }} Aguardando</li>
          </ul>
        </div>
        <main class="col-sm-10 ml-sm-auto col-md-10 pt-3" role="main">
          <h1>Listagem de clientes
          	@role('administrator')
          	<a href="{{ route('customers.create') }}" class="btn btn-success float-right">Adicionar</a>
          	@endrole
          </h1>
            @include('customers.partials.datatable', ['users' => $customers])
            <hr>
        </main>
      </div>
    </div>
@endsection
