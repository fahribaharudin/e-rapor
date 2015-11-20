@extends('admin._layout')

@section('content')
	
	@include('admin._navbar')
	
	<!-- Page Content -->
    <div id="page-content-wrapper">
        <div class="container-fluid">
            <div class="row">   
                <div class="page-header">
					<h1>Data Paket Keahlian</h1>
                </div>
				<ol class="breadcrumb">
					<li><a href="{{ route('admin') }}">Administrator Dashboard</a></li>
					<li class="active">Data Paket Keahlian</li>
				</ol>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="table-responsive">
							<table class="table">
								<thead>
									<tr>
										<th class="col-sm-1">#</th><th>Nama Paket Keahlian</th><th>Program Keahlian</th><th>Bidang Keahlian</th><th>Edit</th><th>Hapus</th>
									</tr>
								</thead>
								<tbody>
									<?php $i = 1 ?>
									@foreach ($paketKeahlian->toArray() as $paket)
										<tr>
											<td>{{ $i++ }}</td>
											<td>{{ $paket['nama'] }}</td>
											<td>{{ $paket['program_keahlian']['nama'] }}</td>
											<td>{{ $paket['bidang_keahlian']['nama'] }}</td>
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

@section('script')
	<script type="text/javascript">
		$('.table').dataTable();
	</script>
@endsection