@extends('_layout')

@section('style')
	<style type="text/css">
		.table-responsive > .table thead th {
			text-align: center;
		}
		.table-responsive > .table tbody td:first-child {
			text-align: center;
		}
	</style>
@endsection

@section('content')

	@include('admin._navbar')
	
	<div class="container-wide" id="NilaiPengetahuanIndex">
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="page-header">
					<h2>Edit Nilai Keterampilan</h2>
				</div>
				<ol class="breadcrumb">
					<li><a href="{{ route('admin') }}">Administrator Dashboard</a></li>
					<li><a href="{{ route('admin.nilai-keterampilan.index') }}">Data Nilai keterampilan</a></li>
					<li><a href="{{ route('admin.nilai-keterampilan.index-byMapel', [$mapel->id, $siswa->kelas->id, $siswa->semester]) }}">{{ $mapel->child->nama_mapel }}</a></li>
					<li class="active">Siswa: {{ $siswa->nama }}</li>

				</ol>
				<hr>
				
				@include('admin.nilai-keterampilan._header-page-meta')
				
				<form method="POST" action="{{ route('admin.nilai-keterampilan.update', [$mapel->id, $siswa->kelas->id, $siswa->semester, $siswa->id ]) }}">
					
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<input type="hidden" name="_method" value="PUT">
					<input type="hidden" name="siswa_id" value="{{ $siswa->id }}">
					<input type="hidden" name="mapel_id" value="{{ $mapel->id }}">
					<input type="hidden" name="kelas_id" value="{{ $siswa->kelas->id }}">
					<input type="hidden" name="semester" value="{{ $siswa->semester }}">

					@include('admin.nilai-keterampilan._form-fields')
					
				</form>

			</div>
		</div>
	</div>

@endsection