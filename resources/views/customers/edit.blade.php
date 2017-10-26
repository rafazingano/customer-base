@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <main class="col-sm-12 ml-sm-auto col-md-12 pt-3" role="main">
      <h1>
        Editar o cliente {{ $customer->razao_social }} de {{ $campaign->title }} 
        <a href="{{ route('campaigns.customers.index', $campaign->id) }}" class="btn btn-primary float-right">Voltar</a>
        <div style="clear: both;"></div>
      </h1>            
        {!! Form::model($customer, ['method' => 'PUT', 'route' => ['customers.update', $customer->id], 'files' => true]) !!}
  			    @include('customers.partials.form')
  			{!! Form::close() !!}			
        <hr>
        @include('customers.partials.files', ['files' => $customer->files])
        <hr>
    </main>
  </div>
</div>
@endsection