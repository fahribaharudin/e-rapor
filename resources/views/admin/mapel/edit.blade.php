@extends('_layout')

@section('content')
	
	@include('admin._navbar')

	<div class="container-wide" id="MapelEdit">
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="page-header">
					<h2>Edit Data Mata Pelajaran <small>(Mapel: {{ $mapel->child->nama_mapel }})</small></h2>
				</div>
				<ol class="breadcrumb">
					<li><a href="{{ route('admin') }}">Administrator Dashboard</a></li>
					<li><a href="{{ route('admin.mapel.index') }}">Data Mata Pelajaran</a></li>
					<li><a href="{{ route('admin.mapel.paket.index', $mapel->paketKeahlian->id) }}">{{ $mapel->paketKeahlian->nama }}</a></li>
					<li class="active"><strong>Edit:</strong> {{ $mapel->child->nama_mapel }}</li>
				</ol>
				<hr>

				@include('admin.mapel._edit-form')

			</div>
		</div>
	</div>

@endsection