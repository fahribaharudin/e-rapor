@extends('admin._layout')

@section('content')
	
	@include('admin._navbar')

	<!-- Page Content -->
    <div id="page-content-wrapper">
        <div class="container-fluid" id="MapelEdit">
            <div class="row">   
                <div class="page-header">
					<h1>Edit Data Mata Pelajaran <small>(Mapel: {{ $mapel->child->nama_mapel }})</small></h1>
                </div>
				<ol class="breadcrumb">
					<li><a href="{{ route('admin') }}">Administrator Dashboard</a></li>
					<li><a href="{{ route('admin.mapel.index') }}">Data Mata Pelajaran</a></li>
					<li><a href="{{ route('admin.mapel.paket.index', $mapel->paketKeahlian->id) }}">{{ $mapel->paketKeahlian->nama }}</a></li>
					<li class="active"><strong>Edit:</strong> {{ $mapel->child->nama_mapel }}</li>
				</ol>
				
				<div class="panel panel-default">
					<div class="panel-body">
						@include('admin.mapel._edit-form')
					</div>
				</div>

            </div>
        </div>
    </div>
    <!-- /#page-content-wrapper -->

@endsection