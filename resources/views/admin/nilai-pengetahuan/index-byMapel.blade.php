@extends('_layout')

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
	
	@include('admin._navbar')
	
	<div class="container-wide">
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="page-header">
					<h2>
						Data Nilai Pengetahuan 
						<small>
							Mapel: {{ $mapel->child->nama_mapel }} 
							(Kelas: {{ $kelas->nama_kelas }} 
							tingkat: {{ $kelas->tingkat_kelas }} - semester {{ $kelas->semester }})
							<a href="{{ route('admin.nilai-pengetahuan.index') }}" class="btn btn-success btn-xs">Ganti</a>
						</small>
					</h2>
				</div>
				<ol class="breadcrumb">
					<li><a href="{{ route('admin') }}">Administrator Dashboard</a></li>
					<li><a href="{{ route('admin.nilai-pengetahuan.index') }}">Data Nilai Pengetahuan</a></li>
					<li class="active">Mapel: {{ $mapel->child->nama_mapel }}</li>
				</ol>
				<hr>
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
								<th colspan="3">Teknik Penilaian</th>
								<th colspan="2">Nilai Pengetahuan</th>
							</tr>
							<tr>
								<th>Tertulis</th>
								<th>Observasi</th>
								<th>Penugasan</th>
								<th>Angka</th>
								<th>Predikat</th>
							</tr>
						</thead>

						@include('admin.nilai-pengetahuan._tbody-index-byMapel')
					
					</table>
				</div>
			</div>
		</div>
	</div>

@endsection