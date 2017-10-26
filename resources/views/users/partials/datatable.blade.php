<table class="table table-striped datatable">
  <thead>
    <tr>
        <th>Nome</th>
        <th>Email</th>
        <th>Grupo</th>
        <th>Criado</th>
        <th>Editado</th>
        <th></th>
    </tr>
  </thead>
  <tfoot>
    <tr>
        <th>Nome</th>
        <th>Email</th>
        <th>Grupo</th>
        <th>Criado</th>
        <th>Editado</th>
        <th></th>
    </tr>
  </tfoot>
  <tbody>
    @foreach($users as $user)
    <tr>
      <td>{{ $user->name }}</td>
      <td>{{ $user->email }}</td>
      <td>
        @foreach($user->roles as $role)
          <span>{{ $role->display_name }}</span>
        @endforeach
      </td>
      <td>{{ $user->created_at->format('d/m/Y') }}</td>
      <td>{{ $user->updated_at->format('d/m/Y')}}</td>
      <td>
        <div class="btn-group float-right" role="group" aria-label="Basic example">
          <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary btn-sm btn-image"><i class="fa fa-pencil" aria-hidden="true"></i></a>
          {!! Form::model($user, ['method' => 'DELETE', 'route' => ['users.destroy', $user->id]]) !!}
          <button type="submit" class="btn btn-secondary btn-sm btn-image" onclick="return confirm('Tem certeza que deseja excluir?')"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
          {!! Form::close() !!}   
        </div>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>