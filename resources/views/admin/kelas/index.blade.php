@extends('admin._layout')

@section('content')
	
	@include('admin._navbar')
	
	<!-- Page Content -->
    <div id="page-content-wrapper">
        <div class="container-fluid">
            <div class="row">   
                <div class="page-header">
					<h1>Data Kelas</h1>
                </div>
                <ol class="breadcrumb">
					<li><a href="{{ route('admin') }}">Administrator Dashboard</a></li>
					<li class="active">Data Kelas</li>
				</ol>
                <div class="panel panel-default">
                    <div class="panel-body">
						<div class="table-responsive">
							<table class="table">
								<thead>
									<tr>
										<th class="col-sm-1">#</th>
										<th>Nama Kelas</th><th>Tingkat Kelas</th><th>Paket Keahlian</th>
										<th>Wali Kelas</th><th>Edit</th><th>Hapus</th>
									</tr>
								</thead>
								<tbody>
									<?php $i = 1 ?>
									@foreach ($semuaKelas->toArray() as $kelas)
										<tr>
											<td>{{ $i++ }}</td>
											<td>{{ $kelas['nama_kelas'] }}</td>
											<td>{{ $kelas['tingkat_kelas'] }}</td>
											<td>{{ $kelas['paket_keahlian']['nama'] }}</td>
											<td>{{ $kelas['wali_kelas']['nama'] }}</td>
											<td><a href="#"><b class="glyphicon glyphicon-pencil"></b></a></td>
											<td><a href="#"><b class="glyphicon glyphicon-trash"></b></a></td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
                    </div>
                </div>
                <!-- /.panel-default -->
            </div>
        </div>
    </div>
    <!-- /#page-content-wrapper -->

@endsection

@section('script')
	<script type="text/javascript">
		$('.table').dataTable();
	</script>
@endsection