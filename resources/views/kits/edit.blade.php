@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <main class="col-sm-12 ml-sm-auto col-md-12 pt-3" role="main">
      <h1>Editar o Enxoval {{ $kit->title }}<a href="{{ route('campaigns.kits.index', $campaign->id) }}" class="btn btn-success float-right"> 
              << Voltar
            </a></h1>         
        {!! Form::model($kit, ['method' => 'PUT', 'route' => ['kits.update', $kit->id]]) !!}
		    @include('kits.partials.form')
		{!! Form::close() !!}
		<hr>
		@if(isset($kit->items))
		<h4>Listagem de itens do enxoval</h4>
		@foreach($kit->items()->whereNull('kit_item_id')->get() as $item)
			<div class="row">
				<div class="col-md-4">
					<b><a href="#" data-toggle="modal" data-target="#Modal-{{ $item->id }}">{{ $item->title }}</a></b>: {{ $item->content }} ({{ $kit->items()->where(['kit_item_id' => $item->id])->sum('amount') }}) 
					@role('administrator')
						<a href="#" class=""  data-toggle="modal" data-target="#Modal-{{ $item->id }}-item" title="Importar excel de produtos"><i class="fa fa-arrow-down" aria-hidden="true"></i></a>
						{!! Form::model($item, ['method' => 'DELETE', 'route' => ['kitItems.destroy', $item->id]]) !!}
							<button type="submit" class="btn btn-secondary btn-sm" onclick="return confirm('Tem certeza que deseja excluir?')" style="color: red; position: absolute;top: 0;right: 0; background: transparent;border:0;" title="Deletar">
								X
							</button>
						{!! Form::close() !!}
					@endrole
					<hr>
				</div>
			</div>

			<!-- Modal -->
			<div class="modal fade" id="Modal-{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="ModalLabel-{{ $item->id }}" aria-hidden="true">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">
			    	<form method='POST' action='{{ route("kitsitems.updatemany") }}'>
    					<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

				      <div class="modal-header">
				        <h5 class="modal-title" id="ModalLabel-{{ $item->id }}">Clientes </h5>
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          <span aria-hidden="true">&times;</span>
				        </button>
				      </div>
				      <div class="modal-body ">
				      	
				      	<div class="container-fluid modal-customers">
				      		<div class="row">
							      <div class="col-md-2">Loja</div>
							      <div class="col-md-4">Quantidade</div>
							      <div class="col-md-6">Descrição</div>
							    </div>
							    <hr>
				      		@foreach($kit->items()->where(['kit_item_id' => $item->id])->get() as $kititem)
				        	
					        	<div class="row">
							      <div class="col-md-2 loja-title">
							      	{{ $kititem->customer->loja }}
							      </div>
							      <div class="col-md-4">
							      	<input class="form-control" placeholder="Quantidade do Item" name="items[{{ $kititem->id }}][amount]" type="text" value="{{ $kititem->amount }}"> 
							      </div>
							      <div class="col-md-6">
							      	<input class="form-control" placeholder="Descrição" name="items[{{ $kititem->id }}][content]" type="text" value="{{ $kititem->content }}">
							      </div>
							    </div>

					        @endforeach					    
						</div>
								        
				      </div>
				      <div class="modal-footer">	
				      @role(['administrator'])			      	
				        <button type="submit" class="btn btn-primary">Salvar</button>
				        @endrole
				        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
				      </div>
			      </form>
			    </div>
			  </div>
			</div>

			<!-- Modal import-->
			<div class="modal fade" id="Modal-{{ $item->id }}-item" tabindex="-1" role="dialog" aria-labelledby="ModalLabel-{{ $item->id }}-item" aria-hidden="true">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">
			    	{!! Form::open(['route' => 'kititems.import.post', 'files' => true]) !!}
	
			    		<input type="hidden" name="kit_item_id" value="{{ $item->id }}">
				      <div class="modal-header">
				        <h5 class="modal-title" id="ModalLabel-{{ $item->id }}-item">Produtos Import </h5>
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          <span aria-hidden="true">&times;</span>
				        </button>
				      </div>
				      <div class="modal-body">

						<h1>{{ $item->title }}</h1>           
				   
			    			{!! Form::label('file', 'Arquivo', ['class' => '']); !!}
			    			{!! Form::file('file', ['class' => "form-control", 'placeholder' => "Arquivo"]) !!}				    					
				        <hr>

				      </div>
				      @role(['administrator'])
				      <div class="modal-footer">		
				      @role(['administrator'])		      	
				        <button type="submit" class="btn btn-primary">Enviar</button>
				        @endrole
				        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
				      </div>
				      @endrole
			      {!! Form::close() !!}
			    </div>
			  </div>
			</div>

		@endforeach
		@endif
	</main>
    </main>
  </div>
</div>
@endsection