@extends('_layout')

@section('content')

	@include('admin._navbar')
	
	<div class="container-wide" id="NilaiPengetahuanIndex">
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="page-header">
					<h2>Data Nilai Pengetahuan</h2>
				</div>
				<ol class="breadcrumb">
					<li><a href="{{ route('admin') }}">Administrator Dashboard</a></li>
					<li class="active">Data Nilai Pengetahuan</li>
				</ol>
				<hr>
				<table class="table" id="NilaiPengetahuanNavigation">
					<tbody>
						<tr class="active">
							<td colspan="2"><h4>CARI NILAI BERDASARKAN:</h4></td>
						</tr>
						<tr class=""> 
					        <td><b>Kelas </b></td> 
					        <td>
					        	<select class="input-sm" name="kelas" id="KelasDropdown">    
									
					            </select>
							</td>
						</tr>
						<tr class=""> 
					        <td><b>Semester </b></td> 
					        <td>
					        	<select class="input-sm" name="kelas" id="SemesterDropdown" style="display: none">    
									
					            </select>
							</td>
						</tr>
						<tr class=""> 
					        <td><b>Mata Pelajaran </b></td> 
					        <td>
					        	<select class="input-sm" name="kelas" id="MapelDropdown" style="display: none">    
									
					            </select>
							</td>
						</tr>
						<tr class=""> 
					        <td>&nbsp;</td> 
					        <td id="ShowNilaiPengetahuanButton">
					        	<a href="#" disabled class="btn btn-primary">Tampilkan</a>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>

@endsection