<div class="form-row">
	<div class="form-group col-md-4">
		{!! Form::label('title', 'Campanha', ['class' => '']); !!}
		{!! Form::text('title', null, ['class' => "form-control", 'placeholder' => "Campanha"]) !!}
	</div>
	<div class="form-group col-md-2">
	{!! Form::label('data', 'Data Inicio', ['class' => '']); !!}
	{!! Form::text('data', null, ['class' => "form-control datetimepicker", 'placeholder' => "Data Inicio"]) !!}
	</div>
	<div class="form-group col-md-4">
	{!! Form::label('users[]', 'Cliente', ['class' => '']); !!}
	{!! Form::select('users[]', $users, null, ['class' => "form-control"]) !!} 
	</div>
</div>
{!! Form::submit('Enviar', ['class' => 'btn btn-primary']) !!}