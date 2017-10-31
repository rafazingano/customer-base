@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <main class="col-sm-12 ml-sm-auto col-md-12 pt-3" role="main">
      <h1 class="">
        {{ $customer->razao_social }}
        <a href="{{ route('campaigns.customers.index', $customer->campaign_id) }}" class="btn btn-success float-right"> 
          << Voltar
        </a>
      </h1>
      <div class="form-row">
        <div class="form-group col-md-12">
          <h2>Logística</h2>
          <hr>
        </div>

          <div class="form-group col-md-4">
            <b>Status:</b>
            {{ $customer->status->title }} 
            <br>
            <b>Data:</b>
            {{ isset($customer->data)? $customer->data->format('Y-m-d') : 'Sem Data' }} 
            <br>
            <b>Recebido por:</b>
            {{ $customer->recebido_por }} 
            <br>
            <b>Kit:</b>
            {{ isset($customer->kit->title)? $customer->kit->title : 'Sem Kit'  }}
          </div>
          <div class="form-group col-md-4">
            <b>Promotor:</b>
            {{ $customer->promoter->name }}
            <br>
            <b>Roteiro:</b>
            {{ $customer->roteiro }}
            <br>
            <b>Distancia:</b>
            {{ $customer->distancia }}
          </div>
          <div class="form-group col-md-4">
            <b>Desconformidade:</b>
            {{ $customer->desconformidade }} 
          </div>

      </div>
      <div class="form-row">
        <div class="form-group col-md-12">
          <h2>Cadastro</h2>
          <hr>
        </div>
 
          <div class="form-group col-md-4">
            <b>Loja:</b>
            {{ $customer->loja }}
            <br>
            <b>Razão Social:</b>
            {{ $customer->razao_social }}
            <br>
            <b>Contato:</b>
            {{ $customer->contato }}
            <br>
            <b>CNPJ:</b>
            {{ $customer->cnpj }}
            <br>
            <b>IE:</b>
            {{ $customer->ie }}
          </div>
          <div class="form-group col-md-4">
            <b>Endereço:</b>
            {{ $customer->endereco }}
             <br>
            <b>Bairro:</b>
            {{ $customer->bairro }}
             <br>
            <b>CEP:</b>
            {{ $customer->cep }}
             <br>
            <b>Cidade:</b>
            {{ $customer->cidade }}
             <br>
            <b>UF:</b>
            {{ $customer->uf }}
          </div>
          <div class="form-group col-md-4">
            <b>Fone:</b>
            {{ $customer->fone_1 }}
            <br>
            <b>Fone:</b>
            {{ $customer->fone_2 }}
            <br>
            <b>Email:</b>
            {{ $customer->email }}
          </div>

          <div class="form-group col-md-12">
            <h2>Produtos</h2>
            <div class="row"> 
            @foreach($customer->kit_items as $ki)
             <div class=" col-md-3">
              {{ $ki->title }}: {{ $ki->amount }} - {{ $ki->content }}
            </div>
            @endforeach
          </div>
          </div>
  
      </div>
      <div class="form-row">
        <div class="form-group col-md-12">
        <h2>Feedback</h2>
        <hr>
      </div>
      <div class="form-group col-md-4">
        <b>Data:</b>
        {{ isset($customer->concluido_data)? $customer->concluido_data->format('Y-m-d') : 'Sem Data' }}
        </div>
        <div class="form-group col-md-8">
        <b>Feedback:</b>
        {{ $customer->feedback }}
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-12">
          <h2>Arquivos</h2>
          <hr>
        </div>
      <div class="form-group col-md-12">
        <p>
          @include('customers.partials.files', ['files' => $customer->files])
        </p>
        </div>
      </div>
    </main>
  </div>
</div>
@endsection