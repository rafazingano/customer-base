@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <main class="col-sm-12 ml-sm-auto col-md-12 pt-3" role="main">
      <h1>Importar clientes do XML</h1>            
        {!! Form::open(['route' => 'customers.import.post', 'files' => true]) !!}
          {!! Form::hidden('campaign_id', $campaign_id) !!}
    			{!! Form::label('file', 'Arquivo', ['class' => '']); !!}
    			{!! Form::file('file', ['class' => "form-control", 'placeholder' => "Arquivo"]) !!}
    			{!! Form::submit('Enviar') !!}
    		{!! Form::close() !!}			
        <hr>
    </main>
  </div>
</div>
@endsection