@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <main class="col-sm-12 ml-sm-auto col-md-12 pt-3" role="main">           
        <div class="jumbotron">
          <h1 class="">{{ $gallery->title }} <a href="{{ route('campaigns.galleries.index', $gallery->campaign->id) }}" class="btn btn-success float-right"> 
              << Voltar
            </a></h1>
          <hr class="my-4">          
          <p>
            @include('galleries.partials.images', ['images' => $gallery->images])
          </p>
          <hr>
          <div class="row">
            <div class="col-md-6 col-sm-6">
            Criado em {{ $gallery->created_at->format('d/m/Y') }}
            </div>
            <div class="col-md-6 col-sm-6">
            Editado pela última vez em {{ $gallery->updated_at->format('d/m/Y') }}
            </div>
          </div>
        </div>
        <hr>
    </main>
  </div>
</div>
@endsection