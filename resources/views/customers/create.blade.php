@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <main class="col-sm-12 ml-sm-auto col-md-12 pt-3" role="main">
      <h1>Criar um novo cliente para {{ $campaign->title }}</h1>            
        {!! Form::open(['route' => 'customers.store', 'files' => true]) !!}
  			    @include('customers.partials.form')
  			{!! Form::close() !!}			
        <hr>
    </main>
  </div>
</div>
@endsection