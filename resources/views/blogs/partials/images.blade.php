<div class="row"> 
@foreach($images as $image)
	<div class="col-md-4"> 
		<a href="{{ asset('storage/blogs/' . $image->image) }}" data-fancybox="gallery" target="_blank" style="margin-bottom: 10px;display: block">
			<img src="{{ asset('storage/blogs/' . $image->image) }}" class="img-fluid">
		</a>
		@role('administrator')
			{!! Form::model($image, ['method' => 'DELETE', 'route' => ['blogImages.destroy', $image->id]]) !!}
			<button type="submit" class="btn btn-secondary btn-sm" onclick="return confirm('Tem certeza que deseja excluir?')" style="position: absolute;top: 0;left: 0; background: transparent;border:0;">
				<img src="{{ asset('assets/images/destroy.png') }}">
			</button>
			{!! Form::close() !!}		
		@endrole
	</div>
@endforeach
</div>