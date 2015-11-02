@extends('_layout')

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
	
	@include('admin._navbar')

	<div class="container-wide">
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="page-header">
					<h2>
						DATA MATA PELAJARAN 
						<small class="text-muted">
							(Paket Keahlian: {{ $mapelByPaket->paket_keahlian->nama }}, 
							<a href="{{ route('admin.mapel.index') }}" class="btn btn-success btn-xs">Ganti</a>)
						</small>
					</h2>
				</div>
				<ol class="breadcrumb">
					<li><a href="{{ route('admin') }}">Administrator Dashboard</a></li>
					<li><a href="{{ route('admin.mapel.index') }}">Data Mata Pelajaran</a></li>
					<li class="active">{{ $mapelByPaket->paket_keahlian->nama }}</li>
				</ol>
				<hr>
				<div class="table-responsive">
					<table class="table table-bordered">
						
						{{-- Table head was included as the view partial --}}
						@include('admin.mapel._mapel_table_head')
						
						<tbody>

							{{-- Create incremental number as i --}}
							<?php $i = 1; ?>

							{{-- All mapel where kelompok = A --}}
							@foreach ($mapelByPaket as $mapel) 
								@if ($mapel->kelompok == 'A')
									<tr><td colspan="16" class="kelompok-col">Kelompok A (Wajib)</td></tr>
									@foreach ($mapelByPaket as $mapel)
										@if ($mapel->kelompok == 'A')
											@include('admin.mapel._mapel_table_row', $mapel)
											<?php $i++ ?>
										@endif
									@endforeach
									<?php break; ?>
								@endif
							@endforeach

							{{-- All mapel where kelompok = B --}}
							@foreach ($mapelByPaket as $mapel) 
								@if ($mapel->kelompok == 'B')
									<tr><td colspan="16" class="kelompok-col">Kelompok B (Wajib)</td></tr>
									@foreach ($mapelByPaket as $mapel)
										@if ($mapel->kelompok == 'B')
											@include('admin.mapel._mapel_table_row', $mapel)
											<?php $i++ ?>
										@endif
									@endforeach
									<tr><td colspan="16" class="kelompok-col">Kelompok C (Kejuruan)</td></tr>
									<?php break; ?>
								@endif
							@endforeach

							{{-- All mapel where kelompok = C1 --}}
							@foreach ($mapelByPaket as $mapel) 
								@if ($mapel->kelompok == 'C1')
									<tr><td colspan="16" class="kelompok-col">C1. Dasar Bidang Keahlian</td></tr>
									@foreach ($mapelByPaket as $mapel)
										@if ($mapel->kelompok == 'C1')
											@include('admin.mapel._mapel_table_row', $mapel)
											<?php $i++ ?>
										@endif
									@endforeach
									<?php break; ?>
								@endif
							@endforeach

							{{-- All mapel where kelompok = C2 --}}
							@foreach ($mapelByPaket as $mapel) 
								@if ($mapel->kelompok == 'C2')
									<tr><td colspan="16" class="kelompok-col">C2. Dasar Program Keahlian</td></tr>
									@foreach ($mapelByPaket as $mapel)
										@if ($mapel->kelompok == 'C2')
											@include('admin.mapel._mapel_table_row', $mapel)
											<?php $i++ ?>
										@endif
									@endforeach
									<?php break; ?>
								@endif
							@endforeach

							{{-- All mapel where kelompok = C3 --}}
							@foreach ($mapelByPaket as $mapel) 
								@if ($mapel->kelompok == 'C3')
									<tr><td colspan="16" class="kelompok-col">C3. Paket Keahlian</td></tr>
									@foreach ($mapelByPaket as $mapel)
										@if ($mapel->kelompok == 'C3')
											@include('admin.mapel._mapel_table_row', $mapel)
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
	</div>
	
@endsection