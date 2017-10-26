@extends('layouts.app')

@section('content')
<div class="container">
      <div class="row">
        <main class="col-sm-12 ml-sm-auto col-md-12 pt-3" role="main">
          <h1>Enxoval da campanha {{ $campaign->title }}
          	@role(['administrator'])
          	<a href="{{ route('campaigns.kits.create',$campaign->id) }}" class="btn btn-success float-right"> 
              Adicionar
            </a>
             <a href="{{ route('campaigns.customers.index', $campaign->id) }}" class="btn btn-success float-right" style="    margin-right: 10px">Voltar</a>
          	@endrole
          </h1>
            @include('kits.partials.datatable')
            <hr>
        </main>
      </div>
    </div>
@endsection
