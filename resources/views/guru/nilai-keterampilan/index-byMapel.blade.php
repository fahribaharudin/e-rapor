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
				Data Nilai Keterampilan
				<small>
					Mapel: {{ $mapel->child->nama_mapel }} 
					(Kelas: {{ $kelas->nama_kelas }} 
					tingkat: {{ $kelas->tingkat_kelas }} - semester {{ $kelas->semester }})
					<a href="{{ route('guru.mapel.nilai-keterampilan') }}" class="btn btn-success btn-xs">Ganti</a>
				</small>
			</h1>
        </div>
		<ol class="breadcrumb">
			<li><a href="{{ route('guru') }}">Administrator Dashboard</a></li>
			<li><a href="{{ route('guru.mapel.nilai-keterampilan') }}">Data Nilai Keterampilan</a></li>
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
							<th rowspan="3" class="col-sm-1">Kelas</th>
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
							<th class="col-sm-1">Praktik</th>
							<th class="col-sm-1">Projek</th>
							<th class="col-sm-1">Produk</th>
							<th class="col-sm-1">Porto Folio</th>
							<th class="col-sm-1">Tertulis</th>
							<th>Angka</th>
							<th>Predikat</th>
						</tr>
					</thead>

					@include('guru.nilai-keterampilan._tbody-index-byMapel')

				</table>
			</div>
        </div>
	</div>
	
@endsection