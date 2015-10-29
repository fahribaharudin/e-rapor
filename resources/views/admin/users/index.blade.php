@extends('_layout')

@section('content')
	
	@include('admin._navbar')

	<div class="container-wide">
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="page-header"><h2>DATA USER</h2></div>
				<ol class="breadcrumb">
					<li><a href="{{ route('admin') }}">Administrator Dashboard</a></li>
					<li class="active">Data User</li>
				</ol>
				<div class="table-responsive">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>#</th><th>Nama Lengkap</th><th>Username</th><th>level</th><th>Edit</th><th>Delete</th>
							</tr>
						</thead>
						<tbody>
							<?php $i = 1 ?>
							@foreach ($users->toArray() as $user)
								<tr>
									<td>{{ $i++ }}</td>
									<td>{{ $user['owner']['nama'] }}</td>
									<td>{{ $user['username'] }}</td>
									<td>{{ $user['level'] }}</td>
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

@endsection

@section('script')
	<script type="text/javascript">
		$('.table').dataTable();
	</script>
@endsection