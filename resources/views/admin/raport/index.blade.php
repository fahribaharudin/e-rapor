@extends('admin._layout')

@section('content')
	
	@include('admin._navbar')
	
	<!-- Page Content -->
    <div id="page-content-wrapper">
        <div class="container-fluid" id="RaportIndex">
            <div class="row">   
                <div class="page-header">
					<h1>Lihat Rapor Siswa</h1>
                </div>
				<ol class="breadcrumb">
					<li><a href="{{ route('admin') }}">Administrator Dashboard</a></li>
					<li class="active">Lihat Rapor</li>
				</ol>
                <div class="panel panel-default">
                    <div class="panel-body">
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
        </div>
    </div>
    <!-- /#page-content-wrapper -->

@endsection