@extends('_layout')

@section('style')

	<style type="text/css">
		.table-meta .table td:first-child {
			font-weight: bold;
		}
	</style>

@endsection

@section('content')
	
	@include('admin._navbar')

	<div class="container-wide">
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="page-header">
					<h2>Daftar Nilai Rapor Siswa</h2>
				</div>
				<ol class="breadcrumb">
					<li><a href="{{ route('admin') }}">Administrator Dashboard</a></li>
					<li><a href="{{ route('admin.raport.index') }}">Lihat Rapor</a></li>
					<li><a href="{{ route('admin.raport.index') }}">Kelas: {{ $kelas->nama_kelas }}</a></li>
					<li class="active">Siswa: {{ $siswa->nama }}</li>
				</ol>
				<hr>
				<br>
				<div class="table-responsive">
					<table width="100%" class="row table-meta">
						<tr>
							<td class="col-sm-6">
								<table class="table">
									<tr><td class="col-sm-4">Nama Peserta Didik</td><td>:</td><td>{{ $siswa->nama }}</td></tr>
									<tr><td>Bidang Studi Keahlian</td><td>:</td><td>{{ $siswa->paketKeahlian->programKeahlian->bidangKeahlian->nama }}</td></tr>
									<tr><td>Tahun Pelajaran</td><td>:</td><td>{{ 2012 }}</td></tr>
								</table>
							</td>
							<td class="col-sm-6">
								<table class="table">
									<tr><td class="col-sm-4">NIS / NISN</td><td>:</td><td>{{ $siswa->nis }} / {{ $siswa->nisn }}</td></tr>
									<tr><td>Kompetensi Keahlian</td><td>:</td><td>{{ $siswa->paketKeahlian->nama }}</td></tr>
									<tr><td>Kelas / Semester / Tingkat</td><td>:</td><td>{{ $kelas->nama_kelas }} / Semester: {{ $kelas->semester }} / Tingkat: {{ $kelas->tingkat_kelas }}</td></tr>
								</table>
							</td>
						</tr>
					</table>
					<br>
					<table class="table table-bordered">
						<thead>
							<tr>
								<th rowspan="2" class="text-center">No</th>
								<th rowspan="2">Mata Pelajaran</th>
								<th colspan="2" class="text-center">Nilai</th>
								<th colspan="2" class="text-center">Sikap Spiritual dan Sosial</th>
							</tr>
							<tr>
								<th class="text-center col-sm-1">Pengetahuan</th>
								<th class="text-center col-sm-1">Keterampilan</th>
								<th class="text-center col-sm-1">Dalam Mapel</th>
								<th class="text-center">Antar Mapel</th>
							</tr>
						</thead>
						<tbody>

							{{-- Mapel Kelompok A --}}
							@foreach ($siswa->paketKeahlian->mapel as $mapel)
								@if (in_array($kelas->semester, explode(',', $mapel->semester)))
									@if ($mapel->kelompok == 'A')
										<tr><td colspan="6" class="kelompok-col"><strong>Kelompok A (Wajib)</strong></td></tr>
										<?php $i = 1 ?>
										@foreach($siswa->paketKeahlian->mapel()->where('kelompok', '=', 'A')->with('child')->get() as $mapel)
											@include('admin.raport._raport-table-row')
											<?php $i++ ?>
										@endforeach
										<?php break; ?>
									@endif
								@endif
							@endforeach
							
							
							{{-- Mapel Kelompok B --}}
							@foreach ($siswa->paketKeahlian->mapel as $mapel)
								@if (in_array($kelas->semester, explode(',', $mapel->semester)))
									@if ($mapel->kelompok == 'B')
										<tr><td colspan="6" class="kelompok-col"><strong>Kelompok B (Wajib)</strong></td></tr>
										<?php $i = 1 ?>
										@foreach($siswa->paketKeahlian->mapel()->where('kelompok', '=', 'B')->with('child')->get() as $mapel)
											@include('admin.raport._raport-table-row')
											<?php $i++ ?>
										@endforeach
										<?php break; ?>
									@endif
								@endif
							@endforeach
							
							<tr><td colspan="6" class="kelompok-col"><strong>Kelompok C (Peminatan)</strong></td></tr>
							
							{{-- Mapel Kelompok C1 --}}
							@foreach ($siswa->paketKeahlian->mapel as $mapel)
								@if (in_array($kelas->semester, explode(',', $mapel->semester)))
									@if ($mapel->kelompok == 'C1')
										<tr><td class="text-center"><strong>I</strong></td><td colspan="5" class="kelompok-col"><strong>Dasar Bidang Keahlian : {{ $siswa->paketKeahlian->programKeahlian->bidangKeahlian->nama }}</strong></td></tr>
										<?php $i = 1 ?>
										@foreach($siswa->paketKeahlian->mapel()->where('kelompok', '=', 'C1')->with('child')->get() as $mapel)
											@include('admin.raport._raport-table-row')
											<?php $i++ ?>
										@endforeach
										<?php break; ?>
									@endif
								@endif
							@endforeach
							
							{{-- Mapel Kelompok C2 --}}
							@foreach ($siswa->paketKeahlian->mapel as $mapel)
								@if (in_array($kelas->semester, explode(',', $mapel->semester)))
									@if ($mapel->kelompok == 'C2')
										<tr><td class="text-center"><strong>II</strong></td><td colspan="5" class="kelompok-col"><strong>Dasar Program Keahlian : {{ $siswa->paketKeahlian->programKeahlian->nama }}</strong></td></tr>
										<?php $i = 1 ?>
									 	@foreach($siswa->paketKeahlian->mapel()->where('kelompok', '=', 'C2')->with('child')->get() as $mapel)
										 	@include('admin.raport._raport-table-row')
										 	<?php $i++ ?>
										@endforeach
										<?php break; ?>
									@endif
								@endif
							@endforeach
							
							
							{{-- Mapel Kelompok C3 --}}
							@foreach ($siswa->paketKeahlian->mapel as $mapel)
								@if (in_array($kelas->semester, explode(',', $mapel->semester)))
									@if ($mapel->kelompok == 'C3')
										<tr><td class="text-center"><strong>III</strong></td><td colspan="5" class="kelompok-col"><strong>Paket Keahlian : {{ $siswa->paketKeahlian->nama }}</strong></td></tr>
										<?php $i = 1 ?>
										@foreach($siswa->paketKeahlian->mapel()->where('kelompok', '=', 'C3')->with('child')->get() as $mapel)
											@include('admin.raport._raport-table-row')
											<?php $i++ ?>
											<?php $i++ ?>
										@endforeach
										<?php break; ?>
									@endif
								@endif
							@endforeach
							
							
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

@endsection