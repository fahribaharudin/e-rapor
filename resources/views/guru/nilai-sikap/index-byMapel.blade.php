@extends('guru._layout', ['toggled' => true])

@section('style')
	<style type="text/css">
		.table thead th {
			text-align: center;
		}
		.table tbody td:first-child {
			text-align: center;
		}
	</style>
@endsection

@section('content')
	
	@include('guru._navbar')

	<div class="container">
        <div class="page-header">
			<h1>
				Data Nilai Sikap 
				<small>
					Mapel: {{ $mapel->child->nama_mapel }} 
					(Kelas: {{ $kelas->nama_kelas }} 
					tingkat: {{ $kelas->tingkat_kelas }} - semester {{ $kelas->semester }})
					<a href="{{ route('guru.mapel.nilai-sikap') }}" class="btn btn-success btn-xs">Ganti</a>
				</small>
			</h1>
        </div>
		<ol class="breadcrumb">
			<li><a href="{{ route('guru') }}">Dashboard Guru</a></li>
			<li><a href="{{ route('guru.mapel.nilai-sikap') }}">Data Nilai sikap</a></li>
			<li class="active">Mapel: {{ $mapel->child->nama_mapel }}</li>
		</ol>
		<div class="panel panel-default">

		<div class="table-responsive">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th rowspan="3">#</th>
						<th rowspan="3">NIS</th>
						<th rowspan="3">Nama Siswa</th>
						<th rowspan="3">Kelas</th>
						<th rowspan="3">Semester</th>
						<th colspan="5">Mata Pelajaran - {{ $mapel->child->nama_mapel }}</th>
						<th rowspan="3">Edit</th>
						<th rowspan="3">Hapus</th>
					</tr>
					<tr>
						<th colspan="4">Teknik Penilaian</th>
						<th rowspan="2">Nilai Sikap</th>
					</tr>
					<tr>
						<th>Observasi</th>
						<th>Penilaian Diri</th>
						<th>Penilaian Sebaya</th>
						<th>Jurnal</th>
					</tr>
				</thead>

				@include('guru.nilai-sikap._tbody-index-byMapel')
			
			</table>

		</div>
	</div>
	
@endsection