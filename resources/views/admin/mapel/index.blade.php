@extends('admin._layout')

@section('content')
	
	@include('admin._navbar')

	<!-- Page Content -->
    <div id="page-content-wrapper">
        <div class="container-fluid" id="MapelIndex">
            <div class="row">   
                <div class="page-header">
					<h1>Data Mata Pelajaran</h1>
                </div>
				<ol class="breadcrumb">
					<li><a href="{{ route('admin') }}">Administrator Dashboard</a></li>
					<li class="active">Data Mata Pelajaran</li>
				</ol>
                <div class="panel panel-default">
                    <div class="panel-body">
						<table class="table" id="mapelSelectorModule">
							<tbody>
								<tr class="active"><td colspan="2"><h4>CARI MAPEL BERDASARKAN:</h4></td></tr>
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
        </div>
    </div>
    <!-- /#page-content-wrapper -->

@endsection