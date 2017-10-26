@extends('layouts.app')

@section('content')
<div class="container">
      <div class="row">
        <main class="col-sm-12 ml-sm-auto col-md-12 pt-3" role="main">
          <h1>Listagem de campanhas 
          	@role('administrator')
          	<a href="{{ route('campaigns.create') }}" class="btn btn-success float-right"> 
              Adicionar
            </a>
          	@endrole
          </h1>
            @include('campaigns.partials.datatable', ['campaigns' => $campaigns])
            <hr>
        </main>
      </div>
    </div>
@endsection
