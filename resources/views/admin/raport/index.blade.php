@extends('_layout')

@section('content')
	
	@include('admin._navbar')
	
	<div class="container-wide" id="RaportIndex">
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="page-header">
					<h2>Laporan Pencapaian Kompetensi Peserta Didik</h2>
				</div>
				<ol class="breadcrumb">
					<li><a href="{{ route('admin') }}">Administrator Dashboard</a></li>
					<li class="active">Lihat Rapor</li>
				</ol>
				<hr>
				<table class="table" id="">
					<tbody>
						<tr class="active">
							<td colspan="2"><h4>CARI KELAS</h4></td>
						</tr>
						<tr class=""> 
					        <td><b>Kelas </b></td> 
					        <td>
					        	<select class="input-sm" name="kelas" id="KelasDropdown">    
									{{--  --}}
					            </select>
							</td>
						</tr>
						<tr class=""> 
					        <td><b>Semester </b></td> 
					        <td>
					        	<select class="input-sm" name="semester" id="SemesterDropdown">    
									{{--  --}}
					            </select>
							</td>
						</tr>
						<tr class=""> 
					        <td>&nbsp;</td> 
					        <td id="ShowSiswaListFromRaportButtonn">
					        	<a href="#" class="btn btn-primary" disabled>Tampilkan</a>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>

@endsection