<table class="table table-striped datatable">
  <thead>
    <tr>
        <th>Loja</th>
        <th>Status</th>
        <th>Data</th>
        <th>Razão Social</th>     
        <th>Cidade</th>
        <th>UF</th>
        <th>Promotor</th>
        <th>Feedback</th>
        <th></th>
    </tr>
  </thead>
  <tfoot>
    <tr>
        <th>Loja</th>
        <th>Status</th>
        <th>Data</th>
        <th>Razão Social</th>     
        <th>Cidade</th>
        <th>UF</th>
        <th>Promotor</th>
        <th>Feedback</th>
        <th></th>
    </tr>
  </tfoot>
  <tbody>
    @foreach($customers as $c)
    <tr>
      <td><a href="{{ route('customers.show', $c->id) }}" >{{ $c->loja }}</a></td>
      <td class="background-{{ str_slug($c->status->title) }}"><a href="{{ route('customers.show', $c->id) }}" >{{ $c->status->title }}</a></td>
      <td>
          <a href="{{ route('customers.show', $c->id) }}" >{{ isset($c->data)? $c->data->format('d/m/Y') : 'Sem data' }}</a>
      </td>
      <td><a href="{{ route('customers.show', $c->id) }}" >{{ $c->razao_social }}</a></td>
      <td><a href="{{ route('customers.show', $c->id) }}" >{{ $c->cidade }}</a></td>
      <td><a href="{{ route('customers.show', $c->id) }}" >{{ $c->uf }}</a></td>
      <td><a href="{{ route('customers.show', $c->id) }}" >{{ $c->promoter->name }}</a></td>
      <td><a href="{{ route('customers.show', $c->id) }}" >{{ isset($c->concluido_data)? 'Concluído' : 'Em aberto' }} </a></td>
      <td>
        <div class="btn-group float-right" role="group" aria-label="Basic example">
          <a href="{{ route('customers.show', $c->id) }}" class="btn btn-success btn-sm btn-image"  title="Ver"><i class="fa fa-eye" aria-hidden="true"></i></a>
          @role(['administrator', 'promoter'])
          <a href="{{ route('campaigns.customers.edit', ['campaign' => $c->campaign_id, 'id' => $c->id]) }}" class="btn btn-primary btn-sm btn-image"  title="Editar"><i class="fa fa-pencil" aria-hidden="true"></i></a>
          @endrole
          @role('administrator')
          {!! Form::model($c, ['method' => 'DELETE', 'route' => ['customers.destroy', $c->id]]) !!}
          <button type="submit" class="btn btn-secondary btn-sm btn-image" onclick="return confirm('Tem certeza que deseja excluir?')"  title="Deletar"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
          {!! Form::close() !!}   
          @endrole
        </div>        
      </td>
    </tr>
    @endforeach
  </tbody>
</table>