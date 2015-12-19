@extends('guru._layout')

@section('content')
	
	@include('guru._navbar')

	<div class="container">
		<div class="page-header">
			<h1>Informasi Kelas</h1>
		</div>
		<ol class="breadcrumb">
			<li><a href="{{ route('guru') }}">Guru Dashboard</a></li>
			<li class="active">Informasi Kelas</li>
		</ol>
		<div class="panel panel-default">
			<div class="panel-body">
				<br>
				<form class="form-horizontal">
					<div class="form-group">
						<label for="nama_kelas" class="col-sm-2 control-label">Nama Kelas</label>
						<div class="col-sm-6">
							<input type="email" class="form-control" id="nama_kelas" placeholder="Email" value="{{ $kelas->nama_kelas }}" readonly="">
						</div>
					</div>
					<div class="form-group">
						<label for="paket_keahlian" class="col-sm-2 control-label">Paket Keahlian</label>
						<div class="col-sm-6">
							<input type="email" class="form-control" id="paket_keahlian" placeholder="Email" value="{{ $kelas->paketKeahlian->nama }}" readonly="">
						</div>
					</div>
					<div class="form-group">
						<label for="tingkat_kelas" class="col-sm-2 control-label">Tingkat Kelas</label>
						<div class="col-sm-4">
							<input type="email" class="form-control" id="tingkat_kelas" placeholder="Email" value="{{ $kelas->tingkat_kelas }}" readonly="">
						</div>
					</div>
					<div class="form-group">
						<label for="jumlah_siswa" class="col-sm-2 control-label">Jumlah Siswa</label>
						<div class="col-sm-4">
							<input type="email" class="form-control" id="jumlah_siswa" placeholder="Email" value="{{ count($kelas->siswa) }}" readonly="">
						</div>
					</div>
					<div class="form-group">
						<label for="wali_kelas" class="col-sm-2 control-label">Wali Kelas</label>
						<div class="col-sm-6">
							<input type="email" class="form-control" id="wali_kelas" placeholder="Email" value="{{ $kelas->waliKelas->nama }}" readonly="">
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>

@endsection