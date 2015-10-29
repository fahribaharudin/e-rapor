@extends('_layout')

@section('content')
	
	@include('_navbar')

	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="page-header">
						<h3 class="text-center">LOGIN SISTEM</h3>
					</div>
					<form action="{{ route('auth.login-post') }}" method="POST">
						<div class="form-group">
							<input type="text" name="username" id="" class="form-control" placeholder="Username">
						</div>
						<div class="form-group">
							<input type="password" name="password" id="" class="form-control" placeholder="Password">
						</div>
						<hr>
						<div class="form-group">
							<button type="submit" class="btn btn-primary btn-md">Login</button>
						</div>
						{{ csrf_field() }}
					</form>
				</div>
			</div>
		</div>
	</div>

@endsection