{!! Form::hidden('user_id', Auth::id()) !!}
<div class="form-row">
	<div class="form-group col-md-12">
		{!! Form::label('title', 'Titulo', ['class' => '']); !!}
		{!! Form::text('title', null, ['class' => "form-control", 'placeholder' => "Titulo"]) !!}
	</div>
</div>
<div class="form-row">
	<div class="form-group col-md-12">
		{!! Form::label('content', 'Conteudo', ['class' => '']); !!}
		{!! Form::textarea('content', null, ['class' => "form-control", 'placeholder' => "Conteudo"]) !!}
	</div>
</div>
<div class="form-row">
	<div class="form-group col-md-6">
		{!! Form::label('image', 'Imagem principal', ['class' => '']); !!}
		{!! Form::file('image', ['class' => "form-control", 'placeholder' => "Imagem principal"]) !!}
	</div>
	<div class="form-group col-md-6">
		{!! Form::label('images[]', 'Galeria', ['class' => '']); !!}
		{!! Form::file('images[]', ['class' => "form-control", 'placeholder' => "Galeria", 'multiple' => 'multiple']) !!}
	</div>
</div>
{!! Form::submit('Enviar', ['class' => 'btn btn-primary']) !!}