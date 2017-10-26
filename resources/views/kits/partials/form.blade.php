{!! Form::hidden('user_id', Auth::id()) !!}
{!! Form::hidden('campaign_id', $campaign->id) !!}
<div class="form-row kit-form">

	<div class="form-group col-md-6">
		{!! Form::label('title', 'Titulo', ['class' => '']); !!}
		{!! Form::text('title', null, ['class' => "form-control", 'placeholder' => "Titulo"]) !!}
	</div>
	<div class="form-group col-md-6">
		{!! Form::label('content', 'Descrição', ['class' => '']); !!}
		{!! Form::text('content', null, ['class' => "form-control", 'placeholder' => "Descrição"]) !!}
	</div>
	<div class="form-group col-md-12">
		<div class="form-row itens">
			<!--div class="form-group col-md-4 form-items-add">
				{!! Form::text('items[0][title]', null, ['class' => "form-control", 'placeholder' => "Item"]) !!}
				{!! Form::text('items[0][content]', null, ['class' => "form-control", 'placeholder' => "Valor"]) !!}
			</div-->
		</div>
	</div>
</div>


{!! Form::button('adicionar produto ao enxoval', ['class' => 'btn btn-primary add_itens ']) !!}
{!! Form::submit('Enviar', ['class' => 'btn btn-primary']) !!}