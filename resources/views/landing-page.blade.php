@extends('_layout')

@section('content')
	
	@include('_navbar')

	<div class="container">

		<div class="panel panel-default text-center">
			<div class="panel-body">
				<div class="page-header">
					<h1>E-RAPOR SMKN 1 WONOSOBO</h1>
				</div>
				<p class="text-info">
					e-Rapor merupakan aplikasi untuk menyajikan laporan pencapaian kompetensi peserta didik Sekolah Menengah Kejuruan (SMK). 
				</p>
				<br>
				<p>
					<a href="{{ route('auth.login') }}" class="btn btn-primary">Login Sistem</a>
				</p>
				<br>
				<p>
					<a href="https://twitter.com/fahribaharudin" class="text-muted">&copy; 2015 - Mahasiswa Magang</a>
				</p>
			</div>
		</div>
	</div>

@endsection