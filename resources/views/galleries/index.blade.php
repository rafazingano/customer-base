@extends('layouts.app')

@section('content')
<div class="container">
      <div class="row">
        <main class="col-sm-12 ml-sm-auto col-md-12 pt-3" role="main">
          <h1>Listagem de Guias de execução 
          	@role('administrator')
          	<a href="{{ route('campaigns.galleries.create', $campaign->id) }}" class="btn btn-success float-right"> 
              Adicionar
            </a>
          	@endrole
          </h1>
            @include('galleries.partials.datatable', ['galleries' => $galleries])
            <hr>
        </main>
      </div>
    </div>
@endsection
