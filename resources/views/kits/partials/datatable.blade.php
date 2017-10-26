<table class="table table-striped datatable">
  <thead>
    <tr>
        <th>Titulo</th>
        <th>Descrição</th>
        <th>#</th>
    </tr>
  </thead>
  <tfoot>
    <tr>
        <th>Titulo</th>
        <th>Descrição</th>
        <th>#</th>
    </tr>
  </tfoot>
  <tbody>
    @foreach($kits as $k)
    <tr>
      <td>{{ $k->title }}</td>
      <td>{{ $k->content }}</td>
      <td>
        <div class="btn-group float-right" role="group" aria-label="Basic example">
          
          <a href="{{ route('campaigns.kits.edit', ['campaign' => $campaign->id, 'id' => $k->id]) }}" class="btn btn-primary btn-sm btn-image" title="Editar"><i class="fa fa-pencil" aria-hidden="true"></i></a>
          @role(['administrator'])
          {!! Form::model($k, ['method' => 'DELETE', 'route' => ['kits.destroy', $k->id]]) !!}
          <button type="submit" class="btn btn-secondary btn-sm btn-image" onclick="return confirm('Tem certeza que deseja excluir?')" title="Deletar"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
          {!! Form::close() !!}   
          @endrole
        </div>        
      </td>
    </tr>
    @endforeach
  </tbody>
</table>