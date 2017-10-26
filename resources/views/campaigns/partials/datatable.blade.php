<table class="table table-striped datatable">
  <thead>
    <tr>
        <th>Data Inicio</th>
        <th>Campanha</th>
        <th>Cliente</th>
        <th>#</th>
    </tr>
  </thead>
  <tfoot>
    <tr>
        <th>Data Inicio</th>
        <th>Campanha</th>        
        <th>Cliente</th>
        <th>#</th>
    </tr>
  </tfoot>
  <tbody>
    @foreach($campaigns as $c)
    <tr>
      <td>{{ $c->data->format('d/m/y') }}</td>
      <td>{{ $c->title }}</td>      
      <td>
        @foreach($c->users as $user)
          {{ $user->name }}
        @endforeach
      </td>
      <td>
        <div class="btn-group float-right" role="group" aria-label="Basic example">
          <a href="{{ route('campaigns.customers.index', $c->id) }}" class="btn btn-success btn-sm btn-image" title="Ver"><i class="fa fa-eye" aria-hidden="true"></i></a>
          @role('administrator')
          <a href="{{ route('campaigns.edit', $c->id) }}" class="btn btn-primary btn-sm btn-image"  title="Editar"><i class="fa fa-pencil" aria-hidden="true"></i></a>
          <a href="{{ route('customers.export', $c->id) }}" class="btn btn-primary btn-sm btn-image" title="Exportar para excel"><i class="fa fa-arrow-up" aria-hidden="true"></i></a>
          <a href="{{ route('customers.import', $c->id) }}" class="btn btn-primary btn-sm btn-image" title="Importar o excel"><i class="fa fa-arrow-down" aria-hidden="true"></i></a>
          {!! Form::model($c, ['method' => 'DELETE', 'route' => ['campaigns.destroy', $c->id]]) !!}
          <button type="submit" class="btn btn-secondary btn-sm btn-image" onclick="return confirm('Tem certeza que deseja excluir?')"  title="Deletar"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
          {!! Form::close() !!}   
          @endrole
        </div>        
      </td>
    </tr>
    @endforeach
  </tbody>
</table>