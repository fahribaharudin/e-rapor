@extends('_layout')

@section('content')
	
	@include('_navbar')

	<div class="container-wide">
		<div class="panel panel-default text-center">
			<div class="panel-body">
				<div class="page-header">
					<h2>E-RAPOR SMKN 1 WONOSOBO</h2>
				</div>
				<p>
					e-Rapor merupakan aplikasi untuk menyajikan laporan pencapaian kompetensi peserta didik Sekolah Menengah Kejuruan (SMK). 
				</p>
				<br>
				<p>
					<a href="{{ route('auth.login') }}" class="btn btn-default">Login Disini</a>
				</p>
				<br>
				<p>
					<a href="https://twitter.com/fahribaharudin" class="text-muted">&copy; 2015 - Mahasiswa Magang</a>
				</p>
			</div>
		</div>
	</div>

@endsection