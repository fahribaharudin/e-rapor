@extends('admin._layout')

@section('content')
	
	@include('admin._navbar')
	
	<!-- Page Content -->
    <div id="page-content-wrapper">
        <div class="container-fluid" id="UserCreate">
            <div class="row">  
				<div class="page-header"><h1>Buat User Baru</h1></div>
				<ol class="breadcrumb">
					<li><a href="{{ route('admin') }}">Administrator Dashboard</a></li>
					<li><a href="{{ route('admin.users.index') }}">Data User</a></li>
					<li class="active">Buat User Baru</li>
				</ol>
           		<div class="panel panel-default">
					<div class="panel-body">
						<form class="form-horizontal"method="POST" action="{{ route('admin.users.store') }}">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">

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
									<label for="level" class="col-sm-2 control-label">Level: </label>
									<div class="col-sm-4">
										<select name="level" id="level" class="form-control">
											<option value="admin">Administrator</option>
											<option value="walas">Wali Kelas</option>
											<option value="guru">Guru Mapel</option>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label for="nama" class="col-sm-2 control-label">Nama Lengkap</label>
									<div class="col-sm-9" id="namaField">
										{{-- <input type="text" name="nama" id="nama" class="form-control" placeholder="Nama Lengkap"> --}}
									</div>
								</div>
								<div class="form-group">
									<label for="username" class="col-sm-2 control-label">Username</label>
									<div class="col-sm-9" id="namaField">
										<input type="text" name="username" id="username" class="form-control" placeholder="Username Baru">
									</div>
								</div>
								<div class="form-group">
									<label for="password" class="col-sm-2 control-label">Password</label>
									<div class="col-sm-9" id="namaField">
										<input type="password" name="password" id="password" class="form-control" placeholder="Password Baru">
									</div>
								</div>
							</fieldset>
							<div class="form-group">
								<label for="" class="col-sm-2 control-label"></label>
								<div class="col-sm-4">
									<button class="btn btn-success" type="submit">Simpan</button>
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