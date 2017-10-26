<table class="table table-striped datatable">
  <thead>
    <tr>
        <th>Titulo</th>
        <th>#</th>
    </tr>
  </thead>
  <tfoot>
    <tr>
        <th>Titulo</th>
        <th>#</th>
    </tr>
  </tfoot>
  <tbody>
    @foreach($galleries as $g)
    <tr>
      <td>{{ $g->title }}</td>
      <td>
        <div class="btn-group float-right" role="group" aria-label="Basic example">
          <a href="{{ route('galleries.customers.index', $g->id) }}" class="btn btn-success btn-sm">Ver</a>
          @role('administrator')
          <a href="{{ route('galleries.edit', $g->id) }}" class="btn btn-primary btn-sm">Editar</a>
          {!! Form::model($g, ['method' => 'DELETE', 'route' => ['galeries.destroy', $g->id]]) !!}
          <button type="submit" class="btn btn-secondary btn-sm" onclick="return confirm('Tem certeza que deseja excluir?')">Deletar</button>
          {!! Form::close() !!}   
          @endrole
        </div>        
      </td>
    </tr>
    @endforeach
  </tbody>
</table>