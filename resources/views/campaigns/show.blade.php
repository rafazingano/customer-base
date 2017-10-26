@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <main class="col-sm-12 ml-sm-auto col-md-12 pt-3" role="main">
      <!--h1>Cliente {{ $customer->razao_social }}</h1-->            
        <div class="jumbotron">
          <h1 class="">{{ $customer->razao_social }} <a href="{{ route('campaigns.index') }}" class="btn btn-success float-right"> 
              << Voltar
            </a></h1>
          <!--p class="lead">{{ $customer->cnpj }}</p-->
          <hr class="my-4">          
          <div class="row">

            <div class="col-md-4 col-sm-4">
              <b>Status:</b>
              {{ $customer->status }} 
              <br>
              <b>Ativação:</b>
              {{ $customer->ativacao }} 
              <br>
              <b>Canal:</b>
              {{ $customer->canal }} 
              <br>
              <b>Razão Social:</b>
              {{ $customer->razao_social }} 
              <br>
              <b>CNPJ:</b>
              {{ $customer->cnpj }} 
              <br>
              <b>IE:</b>
              {{ $customer->ie }}
            </div>
            

            <div class="col-md-4 col-sm-4">
              <b>Endereço</b>
              {{ $customer->endereco }} 
              <br>
              <b>Bairro:</b>
              {{ $customer->bairro }}
              <br>
              <b>Cidade:</b>
              {{ $customer->cidade }}
              <br>
              <b>UF:</b>
              {{ $customer->uf }}
              <br>
              <b>Cep:</b>
              {{ $customer->cep }}
            </div>

            <div class="col-md-4 col-sm-4">
              <b>Desconformidade</b>
              {{ $customer->desconformidade }} 
              <br>
              <b>Promotor:</b>
              {{ $customer->promotor }}
              <br>
              <b>Kit:</b>
              {{ $customer->kit}}
            </div>

           
          </div>
          <hr>
          <p>
            @include('customers.partials.files', ['files' => $customer->files])
          </p>
          <hr>
          <p class="lead"> 
            @role('administrator')
            {!! Form::model($customer, ['method' => 'DELETE', 'route' => ['customers.destroy', $customer->id]]) !!}
            <a class="btn btn-primary" href="{{ route('customers.edit', $customer->id) }}" role="button">Editar</a>
            <button type="submit" class="btn btn-secondary">Deletar</button>
            {!! Form::close() !!} 
            @endrole
          </p>
          <hr>
          <div class="row">
            <div class="col-md-6 col-sm-6">
            Criado em {{ $customer->created_at->format('d/m/Y') }}
            </div>
            <div class="col-md-6 col-sm-6">
            Editado pela última vez em {{ $customer->updated_at->format('d/m/Y') }}
            </div>
          </div>
        </div>
        <hr>
    </main>
  </div>
</div>
@endsection