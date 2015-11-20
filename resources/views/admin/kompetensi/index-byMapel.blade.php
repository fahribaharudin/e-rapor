@extends('admin._layout')

@section('content')
	
	@include('admin._navbar')
	
	<!-- Page Content -->
    <div id="page-content-wrapper">
        <div class="container-fluid">
            <div class="row">   
                <div class="page-header">
					<h1>
						Data Kompetensi Dasar
						<small class="text-muted">
							(Mata Pelajaran: {{ $mapel['child']['nama_mapel'] }} - {{ $mapel['paket_keahlian']['nama'] }}, 
							<a href="{{ route('admin.kompetensi-dasar.index') }}" class="btn btn-success btn-xs">Ganti</a>)
						</small>
					</h1>
                </div>
				<ol class="breadcrumb">
					<li><a href="{{ route('admin') }}">Administrator Dashboard</a></li>
					<li><a href="{{ route('admin.kompetensi-dasar.index') }}">Data Kompetensi Dasar</a></li>
					<li class="active">Mapel: {{ $mapel['child']['nama_mapel'] }}</li>
				</ol>
                <div class="panel panel-default">
                    <div class="panel-body">
						<div class="table-responsive">
							<table class="table">
								<thead>
									<tr>
										<th>#</th><th>Nama Kompetensi Dasar</th><th>Semester</th><th>Edit</th><th>Delete</th>
									</tr>
								</thead>
								<tbody>
									<?php $i = 1 ?>
									@foreach ($mapel['kompetensi_dasar'] as $kompetensi_dasar)
										<tr>
											<td>{{ $i++ }}</td>
											<td>{{ $kompetensi_dasar['nama_kompetensi'] }}</td>
											<td>{{ $kompetensi_dasar['semester'] }}</td>
											<td><a href="#"><b class="glyphicon glyphicon-pencil"></b></a></td>
											<td><a href="#"><b class="glyphicon glyphicon-trash"></b></a></td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /#page-content-wrapper -->

@endsection
