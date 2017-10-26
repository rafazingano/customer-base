<div class="form-group">
{!! Form::label('role[]', 'Grupo', ['class' => '']); !!}
{!! Form::select('role[]', $roles, isset($user)? $user->roles()->pluck('id') : null, ['class' => "form-control"])!!}
</div>

<div class="form-group">
{!! Form::label('name', 'Nome', ['class' => '']); !!}
{!! Form::text('name', null, ['class' => "form-control", 'placeholder' => "Nome"]) !!}
</div>

<div class="form-group">
{!! Form::label('email', 'E-Mail', ['class' => '']); !!}
{!! Form::text('email', null, ['class' => "form-control", 'placeholder' => "E-mail"]) !!}
</div>

<div class="form-group">
{!! Form::label('password', 'Senha', ['class' => '']); !!}
{!! Form::password('password', ['class' => "form-control", 'placeholder' => "Senha"]) !!}
</div>

{!! Form::submit('Enviar') !!}