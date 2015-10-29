@extends('_layout')

@section('content')
	
	@include('admin._navbar')

	<div class="container-wide">
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="page-header">
					<h2>DATA SISWA</h2>
				</div>
				<ol class="breadcrumb">
					<li><a href="{{ route('admin') }}">Administrator Dashboard</a></li>
					<li class="active">Data Siswa</li>
				</ol>
				
				<div class="table-responsive">
					<table class="table">
						<thead>
							<tr>
								<th>#</th><th>NIS</th><th>NISN</th><th>Nama</th><th>Paket Keahlian</th>
								<th>Tempat Lahir</th><th>Tanggal Lahir</th><th>Jenis Kelamin</th>
								<th>Edit</th><th>Hapus</th>
							</tr>
						</thead>
						<tbody>
							<?php $i = 1 ?>
							@foreach ($semuaSiswa->toArray() as $siswa)		
								<tr>
									<td>{{ $i++ }}</td>
									<td>{{ $siswa['nis'] }}</td>
									<td>{{ $siswa['nisn'] }}</td>
									<td>{{ $siswa['nama'] }}</td>
									<td>{{ $siswa['paket_keahlian']['nama'] }}</td>
									<td>{{ $siswa['tempat_lahir'] }}</td>
									<td>{{ $siswa['tanggal_lahir'] }}</td>
									<td>{{ $siswa['jenis_kelamin'] == 'L' ? 'Laki - laki' : 'Perempuan' }}</td>
									<td><a href="#"><b class="glyphicon glyphicon-pencil"></b></a></td>
									<td><a href="#"><b class="glyphicon glyphicon-trash"></b></a></td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>

			</div>
		</div>
	</div>

@endsection

@section('script')
	<script type="text/javascript">
		$('.table').dataTable();
	</script>
@endsection