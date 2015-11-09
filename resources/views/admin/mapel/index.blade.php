@extends('_layout')

@section('content')
	
	@include('admin._navbar')

	<div class="container-wide" id="MapelIndex">
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="page-header">
					<h2>DATA MATA PELAJARAN</h2>
				</div>
				<ol class="breadcrumb">
					<li><a href="{{ route('admin') }}">Administrator Dashboard</a></li>
					<li class="active">Data Mata Pelajaran</li>
				</ol>
				<hr>
				<table class="table" id="mapelSelectorModule">
					<tbody>
						<tr class="active">
							<td colspan="2"><h3>CARI MAPEL BERDASARKAN:</h3></td>
						</tr>
						<tr class=""> 
					        <td><b>Bidang Keahlian </b></td> 
					        <td>
					        	<select class="input-sm" name="bidang" id="bidangDropdown">    
					                {{-- <option value="">Pilih Bidang Keahlian : </option> --}}
					            </select>
							</td>
						</tr>
						<tr class=""> 
					        <td><b>Program Keahlian </b></td> 
					        <td>
					        	<select class="input-sm" name="program" id="programDropdown" style="display: none">    
					                
					            </select>
							</td>
						</tr>
						<tr class=""> 
					        <td><b>Paket Keahlian </b></td> 
					        <td>
					        	<select class="input-sm" name="paket" id="paketDropdown" style="display: none">    
					                
					            </select>
							</td>
						</tr>
						<tr class="">
							<td></td>
							<td id="tampilkanButton"><a href="#" class="btn btn-primary" disabled>Tampilkan</a></td>
						</tr>
					</tbody>
				</table>
			</div>	
		</div>
	</div>

@endsection