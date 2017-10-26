@extends('layouts.app')

@section('content')
<div class="container-fluid">
      <div class="row">
        
        <div class="col-sm-2  ml-sm-auto col-md-2">
@role(['administrator', 'client'])
          <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
          <script type="text/javascript">

                // Load the Visualization API and the corechart package.
                google.charts.load('current', {'packages':['corechart']});

                // Set a callback to run when the Google Visualization API is loaded.
                google.charts.setOnLoadCallback(drawChart);

                // Callback that creates and populates a data table,
                // instantiates the pie chart, passes in the data and
                // draws it.
                function drawChart() {

                  // Create the data table.
                  var data = new google.visualization.DataTable();
                  data.addColumn('string', 'Topping');
                  data.addColumn('number', 'Slices');
                  data.addRows([
                    ['Ativado', {{ $customer_ativado }}],
                    ['Parcial', {{ $customer_parcial }}],
                    ['Aguardando', {{ $customer_aguardando }}],
                    ['Recusado', {{ $customer_recusado }}],
                    ['Entregue', {{ $customer_entregue }}],
                    ['Despachado', {{ $customer_despachado }}]
                  ]);

                  // Set chart options
                  var options = {
                    is3D: true, 
                    legend: 'none', 
                    pieSliceText: 'value',
                    colors:['green','yellow', 'blue', 'red', 'grey', 'orange'],
                    pieSliceTextStyle: {color: 'transparent', fontName: 'Arial', fontSize: '0px'}
                  };

                  // Instantiate and draw our chart, passing in some options.
                  var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
                  chart.draw(data, options);
                }
          </script>
          <div id="chart_div"  style="width: 100%; height: 300px;"></div>

          <ul class="list-group">
            @if($customer_ativado > 0)
            <li class="list-group-item list-group-item-success">{{ $customer_ativado }} Ativado</li>
            @endif
            @if($customer_parcial > 0)
            <li class="list-group-item list-group-item-yellow">{{ $customer_parcial }} Parcial</li>
            @endif
            @if($customer_recusado > 0)
            <li class="list-group-item list-group-item-danger">{{ $customer_recusado }} Recusado</li>
            @endif
            @if($customer_aguardando > 0)
            <li class="list-group-item list-group-item-primary">{{ $customer_aguardando }} Aguardando</li>
            @endif
            @if($customer_entregue > 0)
            <li class="list-group-item list-group-item-grey">{{ $customer_entregue }} Entregue</li>
            @endif
            @if($customer_despachado > 0)
            <li class="list-group-item list-group-item-warning">{{ $customer_despachado }} Despachado</li>
            @endif
          </ul>

          <hr>
          
          {!! Form::open(['route' => ['campaigns.customers.index', $campaign->id], 'method' => 'GET']) !!}
          <div class="form-row align-items-center">
          <div class="col-md-9">
            {!! Form::select('promoter_id', $promotores, null, ['class' => "form-control", 'placeholder' => 'Todos Promotores']) !!}
          </div><div class="col-auto">
            {!! Form::submit('OK', ['class' => 'btn btn-primary']) !!}
          </div>
        </div>
          {!! Form::close() !!} 
@endrole
        </div>
        

        <main class="col-sm-10 ml-sm-auto col-md-10 pt-2" role="main">
          <h1>{{ $campaign->title }} / Listagem de clientes 
          	@role(['administrator', 'client'])      

          	<a href="{{ route('campaigns.customers.create', $campaign->id) }}" class="btn btn-success float-right">Adicionar</a>

            <a class="btn btn-success float-right" href="{{ route('campaigns.galleries.index', $campaign->id) }}" style="margin-right: 10px">Guia de execução</a>

            <a class="btn btn-success float-right" href="{{ route('campaigns.kits.index', $campaign->id) }}" style="margin-right: 10px">Enxoval PDV</a>

          	@endrole

            <a href="{{ route('campaigns.index') }}" class="btn btn-success float-right" style="    margin-right: 10px"> 
              << Voltar
            </a>
          </h1>
            @include('customers.partials.datatable', ['customers' => $customers])
            <hr>
        </main>
      </div>
    </div>
@endsection
