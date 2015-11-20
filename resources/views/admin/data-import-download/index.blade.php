@extends('admin._layout', ['toggled' => true])

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
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="table-responsive">
							<table class="table">
								<thead>
									<tr>
										<th>#</th>
										<th>Keterangan</th>
										<th>Draft Import Data (Download)</th>
										<th>Upload Data</th>
										<th>Backup Data</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td colspan="5" class="text-info">
											<strong>Data I: Guru & Siswa</strong>
										</td>
									</tr>
									<tr>
										@include('admin.data-import-download._import-download-form', ['no' => 1, 'upload_path' => route('admin.data.import.guru'), 'title' => 'Data Guru', 'excel' => route('admin.data.export.guru')])
									</tr>
									<tr>
										@include('admin.data-import-download._import-download-form', ['no' => 2, 'upload_path' => '#', 'title' => 'Data Siswa Per Kelas', 'excel' => '#'])
									</tr>
									<tr>
										<td colspan="5" class="text-info">
											<strong>Data II: Mata Pelajaran</strong>
										</td>
									</tr>
									<tr>
										@include('admin.data-import-download._import-download-form', ['no' => 3, 'upload_path' => '#', 'title' => 'Mata Pelajaran dan Kompetensinya', 'excel' => '#'])
									</tr>
									<tr>
										<td colspan="5" class="text-info">
											<strong>Data III: Nilai Siswa Per Mata Pelajaran</strong>
										</td>
									</tr>
									<tr>
										@include('admin.data-import-download._import-download-form', ['no' => 4, 'upload_path' => '#', 'title' => 'Nilai Pengetahuan', 'excel' => '#'])
									</tr>
									<tr>
										@include('admin.data-import-download._import-download-form', ['no' => 5, 'upload_path' => '#', 'title' => 'Nilai Keterampilan', 'excel' => '#'])
									</tr>
									<tr>
										@include('admin.data-import-download._import-download-form', ['no' => 6, 'upload_path' => '#', 'title' => 'Nilai Sikap', 'excel' => '#'])
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