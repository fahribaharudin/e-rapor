@extends('_layout')

@section('content')
	
	@include('admin._navbar')

	<div class="container-wide">
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="page-header">
					<h2>DATA PAKET KEAHLIAN</h2>
				</div>
				<ol class="breadcrumb">
					<li><a href="{{ route('admin') }}">Administrator Dashboard</a></li>
					<li class="active">Data Paket Keahlian</li>
				</ol>
				<hr>
				<div class="table-responsive">
					<table class="table">
						<thead>
							<tr>
								<th>#</th><th>Nama Paket Keahlian</th><th>Program Keahlian</th><th>Bidang Keahlian</th><th>Edit</th><th>Hapus</th>
							</tr>
						</thead>
						<tbody>
							<?php $i = 1 ?>
							@foreach ($paketKeahlian->toArray() as $paket)
								<tr>
									<td>{{ $i++ }}</td>
									<td>{{ $paket['nama'] }}</td>
									<td>{{ $paket['program_keahlian']['nama'] }}</td>
									<td>{{ $paket['bidang_keahlian']['nama'] }}</td>
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