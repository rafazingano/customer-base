@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <main class="col-sm-12 ml-sm-auto col-md-12 pt-3" role="main">
      <h1>Editar a campanha {{ $campaign->title }}</h1>            
        {!! Form::model($campaign, ['method' => 'PUT', 'route' => ['campaigns.update', $campaign->id]]) !!}
  			    @include('campaigns.partials.form')
  			{!! Form::close() !!}
    </main>
  </div>
</div>
@endsection