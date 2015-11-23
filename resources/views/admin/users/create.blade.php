@extends('admin._layout')

@section('content')
	
	@include('admin._navbar')
	
	<!-- Page Content -->
    <div id="page-content-wrapper">
        <div class="container-fluid">
            <div class="row">  
				<div class="page-header"><h1>Buat User Baru</h1></div>
				<ol class="breadcrumb">
					<li><a href="{{ route('admin') }}">Administrator Dashboard</a></li>
					<li><a href="{{ route('admin.users.index') }}">Data User</a></li>
					<li class="active">Buat User Baru</li>
				</ol>
           		<div class="panel panel-default">
					<div class="panel-body">
						<form class="form-horizontal"method="POST">
							@if (count($errors) > 0)
							    <div class="alert alert-danger">
							        <ul>
							            @foreach ($errors->all() as $error)
							                <li>{{ $error }}</li>
							            @endforeach
							        </ul>
							    </div>
							@endif
							<fieldset>
								<div class="row">
									<div class="col-sm-2"></div>
									<div class="col-sm-9">
										<legend class="text-info">Informasi User Baru</legend>
									</div>
								</div>
								<div class="form-group">
									<label for="input_semester" class="col-sm-2 control-label">Nama Lengkap</label>
									<div class="col-sm-9">
										<input type="text" name="nama" id="nama" class="form-control" placeholder="Nama Lengkap">
									</div>
								</div>
							</fieldset>
							<div class="form-group">
								<label for="" class="col-sm-2 control-label"></label>
								<div class="col-sm-4">
									<button class="btn btn-primary" type="submit">Update</button>
								</div>
							</div>
						</form>
					</div>
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