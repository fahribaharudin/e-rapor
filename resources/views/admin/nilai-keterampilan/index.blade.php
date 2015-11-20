@extends('admin._layout')

@section('content')

	@include('admin._navbar')
	
	<!-- Page Content -->
    <div id="page-content-wrapper">
        <div class="container-fluid" id="NilaiKeterampilanIndex">
            <div class="row">   
                <div class="page-header">
					<h1>Data Nilai Keterampilan</h1>
                </div>
				<ol class="breadcrumb">
					<li><a href="{{ route('admin') }}">Administrator Dashboard</a></li>
					<li class="active">Data Nilai Keterampilan</li>
				</ol>
                <div class="panel panel-default">
                    <div class="panel-body">
						<table class="table" id="NilaiKeterampilanNavigation">
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
							        <td id="ShowNilaiKeterampilan">
							        	<a href="#" disabled class="btn btn-primary">Tampilkan</a>
									</td>
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