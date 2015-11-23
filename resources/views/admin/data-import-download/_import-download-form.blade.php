<td>{{ $no }}</td>
<td>{{ $title }}</td>
<td>
	<strong>Download:</strong>
	<a href="{{ $export_path }}" class="btn btn-warning btn-xs">
		Excel <span class="glyphicon glyphicon-th"></span>
	</a> 
	<button class="btn btn-primary btn-xs" disabled>
		Access <span class="glyphicon glyphicon-list-alt"></span>
	</button>
	<button class="btn btn-danger btn-xs" disabled>
		PDF <span class="glyphicon glyphicon-list-alt"></span>
	</button>
</td>
<td>
	<form action="{{ $upload_path }}" enctype="multipart/form-data" method="POST">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<input 
			type="file" 
			name="imported_data" 
			id="" 
			class="col-xs-8" 
			required {{ $upload_path == '#' ? 'disabled' : '' }}
		>
		<div class="col-sm-1">
			<button 
				type="submit" 
				class="btn btn-success btn-xs" 
				{{ $upload_path == '#' ? 'disabled' : '' }}
			>
				Upload <span class="glyphicon glyphicon-open"></span>
			</button>
		</div>
	</form>
</td>