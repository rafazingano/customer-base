<div class="row"> 
@foreach($images as $image)
	<div class="col-md-4"> 
			<a href="{{ asset('storage/galleries/' . $image->image) }}" data-fancybox="gallery" target="_blank" style="margin-bottom: 10px;display: block">
				<img src="{{ asset('storage/galleries/' . $image->image) }}" class="img-fluid">
			</a>
			<h4>{{ $image->title }}</h4>
			<p>{{ $image->content }}</p>
		@role('administrator')
			<a href="#" data-toggle="modal" data-target="#Modal_{{ $image->id }}" style="position: absolute;top: 0;right: 0; background: transparent;border:0;">
				<img src="{{ asset('assets/images/edit.png') }}">
			</a>

			<!-- Modal -->
			<div class="modal fade" id="Modal_{{ $image->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">
			    	{!! Form::model($image, ['method' => 'PUT', 'route' => ['galleryImages.update', $image->id]]) !!}
				      <div class="modal-header">
				        <h5 class="modal-title" id="exampleModalLabel">{{ $image->title }}</h5>
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          <span aria-hidden="true">&times;</span>
				        </button>
				      </div>
				      <div class="modal-body">
				        <div class="form-row">
				        	<div class="form-group col-md-12">
								{!! Form::text('title', null, ['class' => "form-control", 'placeholder' => "Titulo"]) !!}
							</div>
							<div class="form-group col-md-12">
								{!! Form::textarea('content', null, ['class' => "form-control", 'placeholder' => "Conteudo"]) !!}
							</div>
						</div>
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
				        <button type="submit" class="btn btn-primary">Salvar</button>
				      </div>
			      	{!! Form::close() !!}
			    </div>
			  </div>
			</div>

			{!! Form::model($image, ['method' => 'DELETE', 'route' => ['galleryImages.destroy', $image->id]]) !!}
			<button type="submit" class="btn btn-secondary btn-sm" onclick="return confirm('Tem certeza que deseja excluir?')" style="position: absolute;top: 0;left: 0; background: transparent;border:0;">
				<img src="{{ asset('assets/images/destroy.png') }}">
			</button>
			{!! Form::close() !!}		
		@endrole
	</div>
@endforeach
</div>