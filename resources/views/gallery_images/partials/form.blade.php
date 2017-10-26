<div class="form-row">
	<div class="form-group col-md-6">
		{!! Form::label('title', 'Titulo', ['class' => '']); !!}
		{!! Form::text('title', null, ['class' => "form-control", 'placeholder' => "Titulo"]) !!}
	</div>
	<div class="form-group col-md-6">
		{!! Form::label('category_id', 'Categoria', ['class' => '']); !!}
		{!! Form::select('category_id', $categories, null, ['class' => "form-control"]) !!} 
	</div>
</div>
<div class="form-row">
	<div class="form-group col-md-12">
		{!! Form::label('files[]', 'Arquivos', ['class' => '']); !!}
		{!! Form::file('files[]', ['class' => "form-control", 'placeholder' => "Arquivos", 'multiple' => 'multiple']) !!}
	</div>
</div>
<div class="form-row">
	<div class="form-group col-md-12">
		{!! Form::label('desconformidade', 'Desconformidade', ['class' => '']); !!}
		{!! Form::textarea('desconformidade', null, ['class' => "form-control", 'placeholder' => "Desconformidade"]) !!}
	</div>
</div>
{!! Form::submit('Enviar', ['class' => 'btn btn-primary']) !!}