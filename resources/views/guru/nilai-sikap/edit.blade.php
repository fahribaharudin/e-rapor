@extends('guru._layout')

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

	@include('guru._navbar')
	
	<div class="container">
        <div class="page-header">
			<h1>Edit Nilai Sikap</h1>
        </div>
		<ol class="breadcrumb">
			<li><a href="{{ route('guru') }}">Guru Dashboard</a></li>
			<li><a href="{{ route('guru.mapel.nilai-sikap') }}">Data Nilai sikap</a></li>
			<li><a href="{{ route('guru.mapel.nilai-sikap.index', [$mapel->id, $siswa->kelas->id, $siswa->semester]) }}">{{ $mapel->child->nama_mapel }}</a></li>
			<li class="active">Siswa: {{ $siswa->nama }}</li>
		</ol>
		<div class="panel panel-default">
			<div class="panel-body">
				@include('guru.nilai-sikap._header-page-meta')
						
				<form method="POST" action="{{ route('guru.mapel.nilai-sikap.update', [$mapel->id, $siswa->kelas->id, $siswa->semester, $siswa->id ]) }}">
					
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<input type="hidden" name="_method" value="PUT">
					<input type="hidden" name="siswa_id" value="{{ $siswa->id }}">
					<input type="hidden" name="mapel_id" value="{{ $mapel->id }}">
					<input type="hidden" name="kelas_id" value="{{ $siswa->kelas->id }}">
					<input type="hidden" name="semester" value="{{ $siswa->semester }}">

					@include('guru.nilai-sikap._form-fields')
					
				</form>
			</div>
		</div>
	</div>

@endsection