@extends('guru._layout')

@section('style')
	
	<style type="text/css">
		.table td:first-child, .table td:nth-child(2), .table td:nth-child(3) {
			font-weight: bold;
		}
	</style>

@endsection

@section('content')
	
	@include('guru._navbar')

	<div class="container">
		<div class="page-header">
			<h1>Daftar Siswa Kelas</h1>
		</div>
		<ol class="breadcrumb">
			<li><a href="{{ route('guru') }}">Guru Dashboard</a></li>
			<li><a href="{{ route('guru.kelas.index') }}">Kelas: {{ Auth::user()->owner->kelas[0]->nama_kelas }}</a></li>
			<li class="active">Daftar siswa kelas</li>
		</ol>
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table">
						<thead>
							<tr>
								<th>#</th>
								<th>Nis</th>
								<th>Nisn</th>
								<th>Nama</th>
								<th>Tempat Lahir</th>
								<th>Tanggal Lahir</th>
								<th>Alamat</th>
								<th>Edit</th>
								<th>Hapus</th>
								<th>Detail</th>
							</tr>
						</thead>
						<tbody>
							<?php $i = 1; ?>
							@foreach ($siswaKelas as $siswa)
								<tr>
									<td>{{ $i++ }}</td>
									<td>{{ $siswa->nis }}</td>
									<td>{{ $siswa->nisn }}</td>
									<td>{{ $siswa->nama }}</td>
									<td>{{ $siswa->tempat_lahir }}</td>
									<td>{{ $siswa->tanggal_lahir }}</td>
									<td>{{ $siswa->alamat_siswa }}</td>
									<td class="text-center"><a href="#"><b class="glyphicon glyphicon-pencil"></b></a></td>
									<td class="text-center"><a href="#"><b class="glyphicon glyphicon-trash"></b></a></td>
									<td class="text-center"><a href="#"><b class="glyphicon glyphicon-align-justify"></b></a></td>
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