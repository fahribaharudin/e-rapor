@extends('guru._layout')

@section('content')
	
	@include('guru._navbar')

	<div class="container" id="GuruNilaiPengetahuanIndex">
		
		<div class="page-header">
			<h1>Nilai Pengetahuan</h1>
		</div>

		<ol class="breadcrumb">
			<li><a href="{{ route('guru') }}">Guru Dashboard</a></li>
			<li class="active">Cari nilai pengetahuan</li>
		</ol>

		@if (count(Auth::user()->owner->mapel) == 0)
			<div class="alert alert-warning">
				<p>
					<strong>Maaf, </strong> 
					Sepertinya anda belum memiliki mata pelajaran, 
					sepertinya mata pelajaran yang anda ampu belum masuk ke sistem. 
					Silahkan hubungi administrator atau TU.
				</p>
			</div>
		@else
			<div class="panel panel-default">
				<div class="panel-body">
					<table class="table" id="NilaiPengetahuanNavigation">
						<tbody>
							<tr class="active">
								<td colspan="2"><h4>CARI NILAI BERDASARKAN:</h4></td>
							</tr>
							<tr class=""> 
						        <td><b>Mata Pelajaran </b></td> 
						        <td>
						        	<select class="input-sm" name="kelas" id="MapelDropdown">    
										
						            </select>
								</td>
							</tr>
							<tr class=""> 
						        <td><b>Kelas </b></td> 
						        <td>
						        	<select class="input-sm" name="kelas" id="KelasDropdown">    
						            </select>
								</td>
							</tr>
							<tr class=""> 
						        <td>&nbsp;</td> 
						        <td id="ShowNilaiPengetahuanGuruButton">
						        	<a href="#" disabled class="btn btn-primary">Tampilkan</a>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			
		@endif

	</div>

@endsection