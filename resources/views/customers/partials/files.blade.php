<div class="row"> 
@foreach($files as $f)
	<div class="col-md-2"> 
		@if(in_array(pathinfo($f->name, PATHINFO_EXTENSION), ['jpeg', 'jpg', 'png', 'gif', 'bmp']))
			<a href="{{ asset('storage/uploads/' . $f->name) }}" data-fancybox="gallery" target="_blank" style="margin-bottom: 10px;display: block">
				<img src="{{ asset('storage/uploads/' . $f->name) }}" class="img-fluid">
			</a>
		@else
			<a href="{{ asset('storage/uploads/' . $f->name) }}" target="_blank" style="margin-bottom: 10px;display: block">
				<img src="{{ asset('assets/images/file.png') }}" class="img-fluid">
			</a>
		@endif
		@role('administrator')
		{!! Form::model($f, ['method' => 'DELETE', 'route' => ['files.destroy', $f->id]]) !!}
		<button type="submit" class="btn btn-secondary btn-sm" onclick="return confirm('Tem certeza que deseja excluir?')" style="position: absolute;top: 0;right: 0; background: transparent;border:0;">
		<img src="{{ asset('assets/images/delete.png') }}">
		</button>
		{!! Form::close() !!}		
		@endrole
	</div>
@endforeach
</div>