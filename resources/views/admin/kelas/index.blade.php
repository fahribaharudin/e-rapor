@extends('_layout')

@section('content')
	
	@include('admin._navbar')

	<div class="container-wide">
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="page-header">
					<h2>DATA KELAS</h2>
				</div>
				<ol class="breadcrumb">
					<li><a href="{{ route('admin') }}">Administrator Dashboard</a></li>
					<li class="active">Data Kelas</li>
				</ol>
				<hr>
				<div class="table-responsive">
					<table class="table">
						<thead>
							<tr>
								<th>#</th><th>Nama Kelas</th><th>Tingkat Kelas</th><th>Paket Keahlian</th>
								<th>Wali Kelas</th><th>Edit</th><th>Hapus</th>
							</tr>
						</thead>
						<tbody>
							<?php $i = 1 ?>
							@foreach ($semuaKelas->toArray() as $kelas)
								<tr>
									<td>{{ $i++ }}</td>
									<td>{{ $kelas['nama_kelas'] }}</td>
									<td>{{ $kelas['tingkat_kelas'] }}</td>
									<td>{{ $kelas['paket_keahlian']['nama'] }}</td>
									<td>{{ $kelas['wali_kelas']['nama'] }}</td>
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