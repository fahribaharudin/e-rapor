@extends('guru._layout')

@section('style')
	<style type="text/css">
		.table thead th {
			text-align: center;
		}
		.table tbody td:first-child {
			text-align: center;
		}
		.kelompok-col {
			text-align: left !important;
			font-weight: bold;
		}
	</style>
@endsection

@section('content')
	
	@include('guru._navbar')

	<div class="container">
		<div class="page-header">
			<h1>Daftar Mata Pelajaran <small>Kelas: {{ Auth::user()->owner->kelas[0]->nama_kelas }}</small></h1>
		</div>
		<ol class="breadcrumb">
			<li><a href="{{ route('guru') }}">Guru Dashboard</a></li>
			<li><a href="{{ route('guru.kelas.index') }}">Kelas: {{ Auth::user()->owner->kelas[0]->nama_kelas }}</a></li>
			<li class="active">Daftar Mata Pelajaran</li>
		</ol>
		<div class="panel panel-default">
			<div class="table-responsive">
				<table class="table table-bordered">
					
					{{-- Table head was included as the view partial --}}
					@include('guru.mapel._mapel_table_head')
					
					<tbody>

						{{-- Create incremental number as i --}}
						<?php $i = 1; ?>

						{{-- All mapel where kelompok = A --}}
						@foreach ($mapels as $mapel) 
							@if ($mapel->kelompok == 'A')
								<tr><td colspan="16" class="kelompok-col">Kelompok A (Wajib)</td></tr>
								@foreach ($mapels as $mapel)
									@if ($mapel->kelompok == 'A')
										@include('guru.mapel._mapel_table_row', $mapel)
										<?php $i++ ?>
									@endif
								@endforeach
								<?php break; ?>
							@endif
						@endforeach

						{{-- All mapel where kelompok = B --}}
						@foreach ($mapels as $mapel) 
							@if ($mapel->kelompok == 'B')
								<tr><td colspan="16" class="kelompok-col">Kelompok B (Wajib)</td></tr>
								@foreach ($mapels as $mapel)
									@if ($mapel->kelompok == 'B')
										@include('guru.mapel._mapel_table_row', $mapel)
										<?php $i++ ?>
									@endif
								@endforeach
								<tr><td colspan="16" class="kelompok-col">Kelompok C (Kejuruan)</td></tr>
								<?php break; ?>
							@endif
						@endforeach

						{{-- All mapel where kelompok = C1 --}}
						@foreach ($mapels as $mapel) 
							@if ($mapel->kelompok == 'C1')
								<tr><td colspan="16" class="kelompok-col">C1. Dasar Bidang Keahlian</td></tr>
								@foreach ($mapels as $mapel)
									@if ($mapel->kelompok == 'C1')
										@include('guru.mapel._mapel_table_row', $mapel)
										<?php $i++ ?>
									@endif
								@endforeach
								<?php break; ?>
							@endif
						@endforeach

						{{-- All mapel where kelompok = C2 --}}
						@foreach ($mapels as $mapel) 
							@if ($mapel->kelompok == 'C2')
								<tr><td colspan="16" class="kelompok-col">C2. Dasar Program Keahlian</td></tr>
								@foreach ($mapels as $mapel)
									@if ($mapel->kelompok == 'C2')
										@include('guru.mapel._mapel_table_row', $mapel)
										<?php $i++ ?>
									@endif
								@endforeach
								<?php break; ?>
							@endif
						@endforeach

						{{-- All mapel where kelompok = C3 --}}
						@foreach ($mapels as $mapel) 
							@if ($mapel->kelompok == 'C3')
								<tr><td colspan="16" class="kelompok-col">C3. Paket Keahlian</td></tr>
								@foreach ($mapels as $mapel)
									@if ($mapel->kelompok == 'C3')
										@include('guru.mapel._mapel_table_row', $mapel)
										<?php $i++ ?>
									@endif
								@endforeach
								<?php break; ?>
							@endif
						@endforeach
						
					</tbody>
				</table>
			</div>
		</div>
	</div>

@endsection