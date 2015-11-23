@extends('admin._layout')

@section('style')
	<style type="text/css">
		.table td:first-child, .table th:first-child {
			/*padding-left: 50px;*/
		}
 		.table th:nth-child(n+4) {
			padding-left: 25px;
		}
		.table th:last-child {
			padding-left: 10px;
		}
	</style>
@endsection

@section('content')
	
	@include('admin._navbar')
	
	<!-- Page Content -->
    <div id="page-content-wrapper">
        <div class="container-fluid">
            <div class="row">   
                <div class="page-header">
					<h1>Import / Download Data</h1>
                </div>
				<ol class="breadcrumb">
					<li><a href="{{ route('admin') }}">Administrator Dashboard</a></li>
					<li class="active">Import & Download Data</li>
				</ol>

				@if (Session::has('message')) 
					<div class="alert alert-success">
						<p>{{ Session::get('message') }}</p>
					</div>
				@endif

                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="table-responsive">
							<table class="table">
								<thead>
									<tr>
										<th>#</th>
										<th>Keterangan</th>
										<th>Backup / Export Data</th>
										<th>Upload Data</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td colspan="5" class="text-info">
											<strong>Data I: Akademik</strong>
										</td>
									</tr>
									<tr>
										@include('admin.data-import-download._import-download-form', [
											'no' => 1, 
											'title' => 'Data Akademik', 
											'export_path' => route('admin.data.export.akademik'), 
											'upload_path' => route('admin.data.import.akademik')
										])
									</tr>
									<tr>
										@include('admin.data-import-download._import-download-form', [
											'no' => 2, 
											'title' => 'Data Siswa Per Kelas', 
											'export_path' => route('admin.data.export.siswa'),
											'upload_path' => route('admin.data.import.siswa'), 
										]) 
									</tr>
									<tr>
										<td colspan="5" class="text-info">
											<strong>Data II: Mata Pelajaran</strong>
										</td>
									</tr>
									<tr>
										@include('admin.data-import-download._import-download-form', [
											'no' => 3, 
											'title' => 'Mata Pelajaran dan Kompetensinya', 
											'export_path' => '#',
											'upload_path' => '#', 
										])
									</tr>
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