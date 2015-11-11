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
						Data Nilai Keterampilan
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
					<li><a href="{{ route('admin.nilai-keterampilan.index') }}">Data Nilai Keterampilan</a></li>
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
								<th colspan="7">Mata Pelajaran - {{ $mapel->child->nama_mapel }}</th>
								<th rowspan="3">Edit</th>
								<th rowspan="3">Hapus</th>
							</tr>
							<tr>
								<th colspan="5">Teknik Penilaian</th>
								<th colspan="2">Nilai Pengetahuan</th>
							</tr>
							<tr>
								<th>Praktik</th>
								<th>Projek</th>
								<th>Produk</th>
								<th>Porto Folio</th>
								<th>Tertulis</th>
								<th>Angka</th>
								<th>Predikat</th>
							</tr>
						</thead>

						@include('admin.nilai-keterampilan._tbody-index-byMapel')

					</table>
				</div>
			</div>
		</div>
	</div>

@endsection