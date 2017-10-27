{!! Form::hidden('campaign_id', $campaign->id) !!} 
@role(['promoter'])
{!! Form::hidden('razao_social', $campaign->razao_social) !!}
@endif
<div class="form-row">
	<div class="form-group col-md-12">
		<h2>Logística</h2>
		<hr>
	</div>

	<div class="form-group col-md-4">
		{!! Form::label('status_id', 'Status', ['class' => '']) !!}
		{!! Form::select('status_id', $status, null, ['class' => "form-control"]) !!} 
		{!! Form::label('data', 'Data', ['class' => '']) !!}
		{!! Form::text('data', isset($customer->data)? $customer->data->format('Y-m-d') : null, ['class' => "form-control datetimepicker", 'placeholder' => "Data"]) !!}
		{!! Form::label('recebido_por', 'Recebido por', ['class' => '']) !!}
		{!! Form::text('recebido_por', null, ['class' => "form-control", 'placeholder' => "Recebido por"]) !!}
		@role(['administrator'])
		{!! Form::label('kit_id', 'Kit', ['class' => '']) !!}
		{!! Form::select('kit_id', $kits, null, ['class' => "form-control"])  !!} 
		@endrole
		</div>
		@role(['administrator'])
	<div class="form-group col-md-4">
		{!! Form::label('promoter_id', 'Promotor', ['class' => '']) !!}
		{!! Form::select('promoter_id', $promoters, null, ['class' => "form-control"]) !!} 
		{!! Form::label('roteiro', 'Roteiro', ['class' => '']) !!}
		{!! Form::text('roteiro', null, ['class' => "form-control", 'placeholder' => "Roteiro"]) !!}
		{!! Form::label('distancia', 'Distancia', ['class' => '']) !!}
		{!! Form::text('distancia', null, ['class' => "form-control", 'placeholder' => "Distancia"]) !!} 	
		</div>
		@endrole
	<div class="form-group col-md-4">
		{!! Form::label('desconformidade', 'Desconformidade', ['class' => '']) !!}
		{!! Form::textarea('desconformidade', null, ['class' => "form-control", 'placeholder' => "Desconformidade"]) !!}
		</div>

</div>
@role(['administrator'])
<div class="form-row">
	<div class="form-group col-md-12">
		<h2>Cadastro</h2>
		<hr>
	</div>
	
	<div class="form-group col-md-4">
		{!! Form::label('loja', 'Loja', ['class' => '']); !!}
		{!! Form::text('loja', null, ['class' => "form-control", 'placeholder' => "Loja"]) !!}
		{!! Form::label('razao_social', 'Razão Social', ['class' => '']); !!}
		{!! Form::text('razao_social', null, ['class' => "form-control", 'placeholder' => "Razão Social"]) !!}
		{!! Form::label('contato', 'Contato', ['class' => '']); !!}
		{!! Form::text('contato', null, ['class' => "form-control", 'placeholder' => "Contato"]) !!}
		{!! Form::label('cnpj', 'CNPJ', ['class' => '']); !!}
		{!! Form::text('cnpj', null, ['class' => "form-control", 'placeholder' => "CNPJ"]) !!}
		{!! Form::label('ie', 'IE', ['class' => '']); !!}
		{!! Form::text('ie', null, ['class' => "form-control", 'placeholder' => "IE"]) !!}
	</div>
	<div class="form-group col-md-4">
		{!! Form::label('endereco', 'Endereço', ['class' => '']); !!}
		{!! Form::text('endereco', null, ['class' => "form-control", 'placeholder' => "Endereço"]) !!}
		{!! Form::label('bairro', 'Bairro', ['class' => '']); !!}
		{!! Form::text('bairro', null, ['class' => "form-control", 'placeholder' => "Bairro"]) !!}
		{!! Form::label('cep', 'CEP', ['class' => '']); !!}
		{!! Form::text('cep', null, ['class' => "form-control", 'placeholder' => "CEP"]) !!}
		
		{!! Form::label('cidade', 'Cidade', ['class' => '']); !!}
		{!! Form::text('cidade', null, ['class' => "form-control", 'placeholder' => "Cidade"]) !!}
		{!! Form::label('uf', 'UF', ['class' => '']); !!}
		{!! Form::text('uf', null, ['class' => "form-control", 'placeholder' => "UF"]) !!}
	</div>
	<div class="form-group col-md-4">
		{!! Form::label('fone_1', 'Fone 1', ['class' => '']); !!}
		{!! Form::text('fone_1', null, ['class' => "form-control", 'placeholder' => "Fone 1"]) !!}
		{!! Form::label('fone_2', 'Fone 2', ['class' => '']); !!}
		{!! Form::text('fone_2', null, ['class' => "form-control", 'placeholder' => "Fone 2"]) !!}
		{!! Form::label('email', 'Email', ['class' => '']); !!}
		{!! Form::text('email', null, ['class' => "form-control", 'placeholder' => "Email"]) !!}
	</div>
</div>

<div class="form-row">
	<div class="form-group col-md-12">
		<h2>Feedback</h2>
		<hr>
	</div>
	<div class="form-group col-md-4">
		{!! Form::label('data_2', 'Data 2', ['class' => '']); !!}
		{!! Form::text('data_2', isset($customer->data_2)? $customer->data_2->format('Y-m-d') : null, ['class' => "form-control datetimepicker", 'placeholder' => "Data 2"]) !!}
		{!! Form::checkbox('concluido', 1) !!}
		{!! Form::label('concluido', 'Concluido', ['class' => '']); !!}
	</div>
	<div class="form-group col-md-8">
		{!! Form::label('feedback', 'Feedback', ['class' => '']); !!}
		{!! Form::textarea('feedback', null, ['class' => "form-control", 'placeholder' => "Feedback"]) !!}
	</div>
</div>
@endrole
@role(['promoter'])
{{ Form::hidden('data_2', '') }}
@endrole
<div class="form-row">
	<div class="form-group col-md-12">
		<h2>Arquivos</h2>
		<hr>
	</div>
<div class="form-group col-md-12">
		{!! Form::file('files[]', ['class' => "form-control", 'placeholder' => "Arquivos", 'multiple' => 'multiple']) !!}
	</div>
</div>
{!! Form::submit('Enviar', ['class' => 'btn btn-primary']) !!}