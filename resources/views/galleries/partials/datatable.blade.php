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
          <a href="{{ route('galleries.show', $g->id) }}" class="btn btn-success btn-sm btn-image"><i class="fa fa-eye" aria-hidden="true"></i></a>
          @role('administrator')
          <a href="{{ route('campaigns.galleries.edit', ['campaign' => $campaign->id, 'id' => $g->id]) }}" class="btn btn-primary btn-sm btn-image"><i class="fa fa-pencil" aria-hidden="true"></i></a>
          {!! Form::model($g, ['method' => 'DELETE', 'route' => ['galleries.destroy', $g->id]]) !!}
          <button type="submit" class="btn btn-secondary btn-sm btn-image" onclick="return confirm('Tem certeza que deseja excluir?')"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
          {!! Form::close() !!}   
          @endrole
        </div>        
      </td>
    </tr>
    @endforeach
  </tbody>
</table>