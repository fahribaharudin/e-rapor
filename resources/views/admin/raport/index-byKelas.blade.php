@extends('_layout')

@section('content')
	
	@include('admin._navbar')

	<div class="container-wide">
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="page-header">
					<h2>Laporan Pencapaian Kompetensi Peserta Didik</h2>
				</div>
				<ol class="breadcrumb">
					<li><a href="{{ route('admin') }}">Administrator Dashboard</a></li>
					<li><a href="{{ route('admin.raport.index') }}">Lihat Rapor</a></li>
					<li class="active">Kelas: {{ $kelas->nama_kelas }}</li>
				</ol>
				<hr>
				<div class="table-responsive">
					<table class="table">
						<thead>
							<tr>
								<th>#</th>
								<th>Nama Siswa</th>
								<th>NIS</th>
								<th>Semester</th>
								<th>Paket Keahlian</th>
								<th>Rapor</th>
							</tr>
						</thead>
						<tbody>
							@if (count($kelas->siswa) != 0) 
								<?php $i = 1 ?>
								@foreach ($kelas->siswa as $siswa)
									<tr>
										<td>{{ $i++ }}</td>
										<td>{{ $siswa->nama }}</td>
										<td>{{ $siswa->nis }}</td>
										<td>{{ $kelas->semester }}</td>
										<td>{{ $siswa->paketKeahlian->nama }}</td>
										<td><a href="{{ route('admin.raport.indexBySiswa', [$kelas->id, $kelas->semester, $siswa->id]) }}"><span class="glyphicon glyphicon-book">&nbsp;</span>Lihat Rapor </a></td>
									</tr>
								@endforeach
							@else 
								<tr>
									<td colspan="6">
										<div class="alert alert-warning">
											<p><strong>Maaf, </strong> Sepertinya belum ada siswa di kelas ini.</p>
										</div>
									</td>
								</tr>
							@endif
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

@endsection